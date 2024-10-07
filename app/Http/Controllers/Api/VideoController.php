<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reel;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\AssignVideo;
use App\Models\Podcast;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function secondsToHMS($seconds)
    {
        $interval = CarbonInterval::seconds($seconds);

        return $interval->cascade()->format('%H:%I:%S');
    }

    public function hmsToSeconds($hms)
    {
        $interval = CarbonInterval::createFromFormat('H:i:s', $hms);

        return $interval->hours * 3600 + $interval->minutes * 60 + $interval->seconds;
    }

    private function getVimeoVideoId($videoUrl)
    {
        $pattern = '/(?:\/video\/|\/)(\d+)/';
        preg_match($pattern, $videoUrl, $matches);

        return isset($matches[1]) ? $matches[1] : null;
    }

    public function updateWatchedTime(Request $request)
    {
        // $email = session('email');
        $loginUser = $request->user();
        $userId = $loginUser->id;

        $videoId = $request->video_id;
        $videoType = $request->video_type;
        $watchedTime = $request->watched_time;

        $formattedDuration = $this->secondsToHMS($watchedTime);

        $endLength = AssignVideo::where('assigned_uid', $userId)
            ->where('video_type', $videoType)
            ->where('video_id', $videoId)
            ->value('total_length');

        $updatedWatchTime = AssignVideo::where('assigned_uid', $userId)
            ->where('video_type', $videoType)
            ->where('video_id', $videoId)
            ->value('watched_time');

        $assignUser = AssignVideo::where('assigned_uid', $userId)
            ->where('video_type', $videoType)
            ->where('video_id', $videoId)
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('end_date', '>', Carbon::now()->toDateString())
                        ->orWhere(function ($q) {
                            $q->where('end_date', '=', Carbon::now()->toDateString())
                                ->where('end_time', '>', Carbon::now()->format('H:i:s'));
                        });
                });
            })
            ->exists();

        if ($assignUser) {
            if ($this->hmsToSeconds($updatedWatchTime) != $this->hmsToSeconds($endLength)) {
                $previousWatchedTime = AssignVideo::where('video_id', $videoId)
                    ->where('video_type', $videoType)
                    ->where('assigned_uid', $userId)
                    ->value('watched_time');

                if ($watchedTime > $this->hmsToSeconds($previousWatchedTime)) {
                    AssignVideo::where('video_id', $videoId)
                        ->where('assigned_uid', $userId)
                        ->where('video_type', $videoType)
                        ->update([
                            'video_status' => 'inprogress',
                            'watched_time' => $formattedDuration
                        ]);

                    return response()->json(['message' => 'Watched time updated successfully']);
                }

                return response()->json(['message' => 'No need to update watched time']);
            }
        } else {
            return response()->json(['message' => 'UnAssigned watching Video']);
        }
    }

    public function handleVideoCompletion(Request $request)
    {
        // $email = session('email');
        $loginUser = $request->user();
        $userId = $loginUser->id;
        $videoId = $request->video_id;
        $videoType = $request->video_type;

        $watchedTime = AssignVideo::where('video_id', $videoId)
            ->where('video_type', $videoType)
            ->where('assigned_uid', $userId)
            ->value('watched_time');

        $endLength = AssignVideo::where('assigned_uid', $userId)
            ->where('video_type', $videoType)
            ->where('video_id', $videoId)
            ->value('total_length');

        $checkStatus = AssignVideo::where([
            'video_type' => $videoType,
            'video_id' => $videoId,
            'video_status' => 'inprogress'
        ])->first();

        if ($checkStatus) {
            if ($this->hmsToSeconds($watchedTime) === $this->hmsToSeconds($endLength)) {
                return response()->json([
                    'popup' => true,
                    'videoId' => $videoId,
                    'userId' => $userId,
                    'videoType' => $videoType,
                    'message' => 'Watch Time equals to total_length'
                ]);
            }
        } else {
            return response()->json(['message' => ' Video completed successfully']);
        }
    }

    public function saveSurveyForm(Request $request)
    {
        $videoId = $request->videoId;
        $userId = $request->userId;
        $videoType = $request->videoType;
        // dd($videoType);

        $rules = [
            'question1' => 'required',
            'question2' => 'required',
            'question3' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return [
                'status' => false,
                'message' => 'Validation failed',
                'data' => [],
                'errors' => $validator->errors()
            ];
        }

        $formData = [
            'question_1' => $request->question1,
            'question_2' => $request->question2,
            'question_3' => $request->question3
        ];

        $jsonData = json_encode($formData);

        $result = AssignVideo::where('assigned_uid', $userId)
            ->where('video_type', $videoType)
            ->where('video_id', $videoId)
            ->update([
                'survey_data' => $jsonData,
                'video_status' => 'completed'
            ]);

        if ($result) {
            return [
                'status' => true,
                'message' => 'Survery Form Submitted Successfully',
                'data' => [],
                'error' => []
            ];
        }

        return [
            'status' => false,
            'message' => 'Something went wrong',
            'data' => [],
            'error' => []
        ];
    }

    public function getTotalLength(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'video_id' => 'required|integer',
        ]);

        $videoType = $request->video_type;
        $videoId = $request->video_id;
        $assignVideo = AssignVideo::where([
            'video_type' => $videoType,
            'video_id' => $videoId,
            'assigned_uid' => $user->id
        ])->first();

        if (!$assignVideo) {
            return response()->json(['error' => 'Video not found'], 404);
        }

        $watchedTime = $this->hmsToSeconds($assignVideo->watched_time);
        $totalLength = $this->hmsToSeconds($assignVideo->total_length);

        return response()->json(['status' => true, 'totalLength' => $totalLength, 'watchedTime' => $watchedTime]);
    }

    public function storeWatchTime(Request $request)
    {
        $user = $request->user();
        $watchedTime = $request->watched_time;
        $videoId = $request->video_id;
        $videoType = $request->video_type;
        $totalLength = $request->total_length;

        $watchedVideo = AssignVideo::where('assigned_uid', $user->id)
            ->where('video_type', $videoType)
            ->where('video_id', $videoId)
            ->first();

        if ($watchedVideo) {
            if (is_null($watchedVideo->assigned_by)) {
                if ($watchedTime > $this->hmsToSeconds($watchedVideo->watched_time)) {
                    $watchedVideo->watched_time = $this->secondsToHMS($watchedTime);
                    $watchedVideo->save();
                    return [
                        'status' => true,
                        'message' => 'Watched time updated successfully',
                        'data' => [],
                        'errors' => []
                    ];
                } else {
                    return [
                        'status' => true,
                        'message' => 'No need to update watched time',
                        'data' => [],
                        'errors' => []
                    ];
                }
            }
        } else {
            $watchedVideo = new AssignVideo();
            $watchedVideo->assigned_uid = $user->id;
            $watchedVideo->video_type = $videoType;
            $watchedVideo->video_id = $videoId;
            $watchedVideo->watched_time = $this->secondsToHMS($watchedTime);
            $watchedVideo->total_length = $totalLength;
            $watchedVideo->video_status = 'inprogress';
            $watchedVideo->save();

            return [
                'status' => true,
                'message' => 'Videos Watched Duration Updated Successfully',
                'data' => [],
                'errors' => []
            ];
        }
    }
}
