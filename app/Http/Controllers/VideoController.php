<?php

namespace App\Http\Controllers;

use App\Models\AssignVideo;
use App\Models\Podcast;
use App\Models\Reel;
use App\Models\User;
use App\Models\UserRelation;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function getVideoDuration(Request $request)
    {
        $request->validate([
            'videoUrl' => 'required|url',
        ]);

        $videoUrl = $request->videoUrl;
        $videoId = $this->getVimeoVideoId($videoUrl);

        if (!$videoId) {
            return response()->json(['error' => 'Invalid Vimeo video URL'], 400);
        }

        // VIMEO ACCESS TOKEN
        $accessToken = '79ccb9e1902f4013a4f4347542305311';
        $duration = $this->fetchVideoDurationFromVimeo($videoId, $accessToken);

        return response()->json(['duration' => $duration]);
    }

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

    public function updateReelsVideoDurations()
    {
        $reels = Reel::all();

        $accessToken = '79ccb9e1902f4013a4f4347542305311';

        foreach ($reels as $reel) {

            if (!empty($reel->duration)) {
                continue;
            }

            $videoUrl = $reel->url;
            // dd($videoUrl);
            $videoId = $this->getVimeoVideoId($videoUrl);

            if (!$videoId) {
                continue;
            }

            $duration = $this->fetchVideoDurationFromVimeo($videoId, $accessToken);

            $reel->duration = $this->secondsToHMS($duration);
            $reel->save();
        }
    }

    public function updatePodcastVideoDurations()
    {
        $podcasts = Podcast::all();

        $accessToken = '79ccb9e1902f4013a4f4347542305311';

        foreach ($podcasts as $podcast) {

            if (!empty($podcast->duration)) {
                continue;
            }

            $videoUrl = $podcast->url;
            // dd($videoUrl);
            $videoId = $this->getVimeoVideoId($videoUrl);

            if (!$videoId) {
                continue;
            }

            $duration = $this->fetchVideoDurationFromVimeo($videoId, $accessToken);

            $podcast->duration = $this->secondsToHMS($duration);
            $podcast->save();
        }
    }

    private function getVimeoVideoId($videoUrl)
    {
        $pattern = '/(?:\/video\/|\/)(\d+)/';
        preg_match($pattern, $videoUrl, $matches);

        return isset($matches[1]) ? $matches[1] : null;
    }

    private function fetchVideoDurationFromVimeo($videoId, $accessToken)
    {
        $client = new Client();
        $response = $client->get("https://api.vimeo.com/videos/{$videoId}", [
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
            ],
            'verify' => false,
        ]);

        $data = json_decode($response->getBody(), true);

        return isset($data['duration']) ? $data['duration'] : null;
    }

    public function updateWatchedTime(Request $request)
    {
        $email = session('email');
        $loginUser = User::where('email', $email)->first();
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
        $email = session('email');
        $loginUser = User::where('email', $email)->first();
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
        $email = session('email');
        $user = User::where('email', $email)->first();

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

        return response()->json(['totalLength' => $totalLength, 'watchedTime' => $watchedTime]);
    }

    public function storeWatchTime(Request $request)
    {
        $watchedTime = $request->watched_time;
        $videoId = $request->video_id;
        $videoType = $request->video_type;
        $totalLength = $request->total_length;
        $email = session('email');

        $user = User::where('email', $email)->first();

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
