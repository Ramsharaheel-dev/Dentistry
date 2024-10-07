<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssignVideo;
use App\Models\Podcast;
use App\Models\Reel;
use App\Models\User;
use App\Notifications\VideoAssignedNotification;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignController extends Controller
{
    public function secondsToHMS($seconds)
    {
        $interval = CarbonInterval::seconds($seconds);

        return $interval->cascade()->format('%H:%I:%S');
    }

    private function getUserNames($userIds)
    {
        $userNames = User::whereIn('id', $userIds)->pluck('name', 'id')->toArray();
        return $userNames;
    }

    public function fetchSelectedItems(Request $request)
    {
        // Decode the JSON-encoded arrays from the request
        $selectedIds = json_decode($request->input('videoIds'), true);
        $videoTypes = json_decode($request->input('videoType'), true);

        // Validate the input to ensure they are arrays
        if (!is_array($selectedIds) || !is_array($videoTypes)) {
            return response()->json(['error' => 'Invalid parameters'], 400);
        }

        // Initialize an empty collection to store the results
        $videos = collect();

        // Fetch videos based on their types
        foreach ($videoTypes as $type) {
            if ($type == 'reel') {
                $videos = $videos->merge(Reel::whereIn('id', $selectedIds)->get());
            } else if ($type == 'podcast') {
                $videos = $videos->merge(Podcast::whereIn('id', $selectedIds)->get());
            }
        }

        // Fetch the logged-in user and their created users
        $loginUser = $request->user();
        if (!$loginUser) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $loginUserId = $loginUser->id;
        $users = User::where('created_by', $loginUserId)->get();

        // Check if videos are found
        if ($videos->isEmpty()) {
            return response()->json(['message' => 'No videos found for the selected IDs.']);
        }

        // Return the response with videos and users
        return response()->json(['status' => true, 'videos' => $videos, 'users' => $users]);
    }

    public function assignVideos(Request $request)
    {
        $videoIds = $request->input('videoIds');
        $userIds = $request->input('userIds');
        $videoDurations = $request->input('videoDurations');
        $videoType = $request->input('videoType');

        // Ensure arrays are correctly parsed from JSON strings if necessary
        if (is_string($videoIds)) {
            $videoIds = json_decode($videoIds, true);
        }
        if (is_string($userIds)) {
            $userIds = json_decode($userIds, true);
        }
        if (is_string($videoDurations)) {
            $videoDurations = json_decode($videoDurations, true);
        }

        $rules = [
            'deadlineDate' => 'required|date',
            'deadlineTime' => 'required|date_format:H:i:s',
            'videoIds' => 'required|array',
            'userIds' => 'required|array',
            'videoDurations' => 'required|array',
        ];

        $validator = Validator::make([
            'deadlineDate' => $request->input('deadlineDate'),
            'deadlineTime' => $request->input('deadlineTime'),
            'videoIds' => $videoIds,
            'userIds' => $userIds,
            'videoDurations' => $videoDurations,
        ], $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }

        $loginUser = $request->user();
        $loginUserId = $loginUser->id;

        $storeIds = [];
        $messages = [];

        foreach ($userIds as $userId) {
            $userStoreIds = [];
            $assignedUserVideos = [];

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
                    $assignedUserVideos[] = $videoId;
                }
                if (!$existingAssignment) {
                    $formattedDurationLength = $this->secondsToHMS($videoDurations[$key]);
                    $formattedDurationTime = $this->secondsToHMS(0);

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

                    $userStoreIds[] = $videoId;
                }
            }

            if (!empty($assignedUserVideos)) {
                $messages[] = "Videos already assigned to user with ID: $userId";
            }
            if (!empty($userStoreIds)) {
                $storeIds[$userId] = $userStoreIds;
            }
        }

        $userNames = $this->getUserNames(array_keys($storeIds));

        $response = [
            'status' => true,
            'message' => 'Videos assigned successfully',
            'data' => $storeIds,
            'userNames' => $userNames,
        ];

        if (!empty($messages)) {
            $response['messages'] = $messages;
        }

        return response()->json($response);
    }
}
