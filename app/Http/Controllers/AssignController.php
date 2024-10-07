<?php

namespace App\Http\Controllers;

use App\Models\AssignVideo;
use App\Models\Podcast;
use App\Models\Reel;
use App\Models\Subscription;
use App\Models\User;
use App\Notifications\VideoAssignedNotification;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AssignController extends Controller
{
    public function secondsToHMS($seconds)
    {
        $interval = CarbonInterval::seconds($seconds);

        return $interval->cascade()->format('%H:%I:%S');
    }

    public function fetchSelectedItems(Request $request)
    {
        $selectedIds = $request->videoIds;
        $videoType = $request->videoType;

        if (is_array($videoType)) {
            $videos = collect();
            foreach ($videoType as $type) {
                if ($type == 'reel') {
                    $videos = Reel::whereIn('id', $selectedIds)->get();
                } else {
                    $videos = Podcast::whereIn('id', $selectedIds)->get();
                }
            }
        } else {
            if ($videoType == 'reel') {
                $videos = Reel::whereIn('id', $selectedIds)->get();
            } else {
                $videos = Podcast::whereIn('id', $selectedIds)->get();
            }
        }

        $email = session('email');
        $loginUser = User::where('email', $email)->first();
        $loginUserId = $loginUser->id;

        $users = User::where('created_by', $loginUserId)->get();

        if ($videos->isEmpty()) {
            return response()->json(['message' => 'No videos found for the selected IDs.']);
        }

        return response()->json(['videos' => $videos, 'users' => $users]);
    }

    private function getUserNames($userIds)
    {
        $userNames = User::whereIn('id', $userIds)->pluck('name', 'id')->toArray();
        return $userNames;
    }

    public function assignVideos(Request $request)
    {
        $videoIds = $request->videoIds;
        $userIds = $request->userIds;
        $videoDurations = $request->videoDurations;
        $videoType = $request->videoType;

        $rules = [
            'deadlineDate' => 'required',
            'deadlineTime' => 'required',
            'videoIds' => 'required|array',
            'userIds' => 'required|array',
            'videoDurations' => 'required|array',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return [
                'status' => false,
                'message' => 'Must Fill the Deadline Fields',
                'data' => [],
                'errors' => $validator->errors()
            ];
        }

        if (!is_array($videoIds) || !is_array($userIds) || !is_array($videoDurations)) {
            return [
                'status' => false,
                'message' => 'Something Went Wrong!',
                'data' => [],
            ];
        }

        $email = session('email');
        $loginUser = User::where('email', $email)->first();
        $loginUserId = $loginUser->id;

        $storeIds = [];

        foreach ($userIds as $userId) {
            $userStoreIds = [];

            foreach ($videoIds as $key => $videoId) {
                $existingAssignment = AssignVideo::where([
                    'assigned_by' => $loginUserId,
                    'video_type' => $videoType,
                    'assigned_uid' => $userId,
                    'video_id' => $videoId,
                ])->exists();

                $completedVideo = AssignVideo::where([
                    'assigned_uid' => $userId,
                    'video_type' => $videoType,
                    'video_id' => $videoId,
                    'video_status' => 'completed',
                ])->exists();

                if ($existingAssignment || $completedVideo) {
                    $userStoreIds[] = $videoId;
                }
                if (!$existingAssignment) {
                    $formattedDurationLength = $this->secondsToHMS($videoDurations[$key]['durationInSeconds']);
                    $formattedDurationTime = $this->secondsToHMS('0');

                    $assignment = AssignVideo::create([
                        'assigned_by' => $loginUserId,
                        'assigned_uid' => $userId,
                        'video_type' => $videoType,
                        'video_id' => $videoId,
                        'watched_time' => $formattedDurationTime,
                        'total_length' => $formattedDurationLength,
                        'end_date' => $request->deadlineDate,
                        'end_time' => $request->deadlineTime,
                    ]);

                    $user = User::find($userId);
                    $user->notify(new VideoAssignedNotification($assignment));
                }
            }

            $storeIds[$userId] = $userStoreIds;
        }

        $userNames = $this->getUserNames(array_keys($storeIds));

        return [
            'status' => true,
            'message' => 'Videos assigned successfully',
            'data' => $storeIds,
            'userNames' => $userNames,
        ];
    }
}
