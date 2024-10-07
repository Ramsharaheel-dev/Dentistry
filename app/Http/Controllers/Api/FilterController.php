<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssignVideo;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    private function getVimeoAuthenticatedUrl($videoId)
    {
        $accessToken = env('VIMEO_ACCESS_tOKEN');

        $cacheKey = "vimeo_url_{$videoId}";

        // Check if the URL is already cached
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $client = new Client();
        try {
            $response = $client->get("https://api.vimeo.com/videos/{$videoId}", [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                ],
                'verify' => false,
            ]);

            $body = json_decode($response->getBody(), true);
            if ($response->getStatusCode() === 200) {
                $videoFiles = $body['files'];
                $authenticatedUrl = $videoFiles[0]['link'];

                Cache::put($cacheKey, $authenticatedUrl, 3600);

                return $authenticatedUrl;
            }
        } catch (\Exception $e) {
            return null;
        }
        return null;
    }

    private function getVimeoVideoId($videoUrl)
    {
        $pattern = '/(?:\/video\/|\/)(\d+)/';
        preg_match($pattern, $videoUrl, $matches);

        return isset($matches[1]) ? $matches[1] : null;
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

        if (isset($data['duration'])) {
            $durationInSeconds = $data['duration'];
            $formattedDuration = gmdate('H:i:s', $durationInSeconds);
            return $formattedDuration;
        }
    }
    public function filter(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        if ($request->has('contentType') && $request->has('nameOfHashtag')) {
            $contentType = $request->contentType;
            $contentTypeLower = strtolower($contentType);
            $hashtagValue = $request->nameOfHashtag;
            $activeMenu = $request->activeMenu;
            $privilege = $user->privilege;

            if ($hashtagValue == 'Webinar' && $privilege == 0) {
                $message = 'Upgrade your subscription to access this page';

                return response()->json([
                    'status' => false,
                    'message' => 'Permission Denied: ' . $message,
                    'contentType' => 'podcasts',
                ], 403);
            }

            $hashtags = DB::table('hashtags')->where('nameOfContentSection', $contentType)->get()->all();
            $hashtagId = '';

            foreach ($hashtags as $hashtag) {
                if ($hashtag->nameOfHashtag == $hashtagValue) {
                    $hashtagId = $hashtag->id;
                    break;
                }
            }

            $finalReels = DB::table($contentTypeLower)->where('hashtagId', $hashtagId)->get()->all();
            $reelIds = array_column($finalReels, 'id');

            $baseUrl = 'https://dentistryinanutshell.com/dian/public';

            if ($contentTypeLower === 'guidelines') {
                $thumbnailBaseUrl = 'https://dentistryinanutshell.com/dian/public/guidelines/';

                foreach ($finalReels as &$reel) {
                    if (isset($reel->thumbnailName)) {
                        $reel->thumbnailUrl = $thumbnailBaseUrl . $reel->thumbnailName;
                    }
                }
            }


            if ($contentTypeLower === 'businessandfinances') {
                $thumbnailBaseUrl = 'https://dentistryinanutshell.com/dev_test/dentistry/public/images/videos_thumbnails/';

                foreach ($finalReels as &$business) {
                    $videoId = $this->getVimeoVideoId($business->url);
                    if ($videoId) {
                        $business->url = $this->getVimeoAuthenticatedUrl($videoId);
                    }

                    $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

                    $business->thumbnailUrl = ($business->thumbnail != null && $business->thumbnail != '') ? $baseUrl . $business->thumbnail : null;
                    unset($business->thumbnail);
                }
            }
            if ($contentTypeLower === 'reels') {
                $thumbnailBaseUrl = 'https://dentistryinanutshell.com/dev_test/dentistry/public/images/videos_thumbnails/';

                foreach ($finalReels as &$video) {
                    $videoId = $this->getVimeoVideoId($video->url);
                    if ($videoId) {
                        $video->url = $this->getVimeoAuthenticatedUrl($videoId);
                    }

                    $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

                    $video->thumbnailUrl = ($video->thumbnail != null && $video->thumbnail != '') ? $baseUrl . $video->thumbnail : null;
                    unset($video->thumbnail);

                }
            }

            if ($contentTypeLower === 'workflows') {

                foreach ($finalReels as &$workflow) {

                    $baseUrlThumbnail = "https://www.dentistryinanutshell.com/dian/public/workFlows/{$hashtag->nameOfHashtag}/";
                    $baseUrlPdf = "https://www.dentistryinanutshell.com/dian/public/workFlows/{$hashtag->nameOfHashtag}/PDFs/";

                    $workflow->thumbnailUrl = ($workflow->thumbnailName != null && $workflow->thumbnailName != '') ? "{$baseUrlThumbnail}{$workflow->thumbnailName}" : null;

                    $workflow->url = ($workflow->url != null && $workflow->url != '') ? "{$baseUrlPdf}{$workflow->url}" : null;
                }
            }

            if ($contentTypeLower === 'healthandwellbeing') {

                foreach ($finalReels as &$welbeing) {
                    $videoId = $this->getVimeoVideoId($welbeing->url);
                    if ($videoId) {
                        $welbeing->url = $this->getVimeoAuthenticatedUrl($videoId);
                    }

                    $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

                    $welbeing->thumbnailUrl = ($welbeing->thumbnail != null && $welbeing->thumbnail != '') ? $baseUrl . $welbeing->thumbnail : null;
                    unset($welbeing->thumbnail);
                }
            }

            if ($contentTypeLower === 'students') {
                foreach ($finalReels as &$reel) {
                    if ($reel->name === 'pastPapers') {
                        $reel->thumbnailUrl = $baseUrl . '/student/past papers/' . $reel->thumbnailName;
                    } elseif ($reel->name === 'lectures') {
                        $reel->thumbnailUrl = $baseUrl . '/student/lectures/' . $reel->thumbnailName;
                    } elseif ($reel->name === 'Generic Notes') {
                        $reel->thumbnailUrl = $baseUrl . '/student/generic-notes/' . $reel->thumbnailName;
                    } elseif ($reel->name === 'images') {
                        $reel->thumbnailUrl = $baseUrl . '/student/images/' . $reel->thumbnailName;
                    } elseif ($reel->name === 'Videos') {
                        $videoId = $this->getVimeoVideoId($reel->url);
                        if ($videoId) {
                            $reel->url = $this->getVimeoAuthenticatedUrl($videoId);
                        }
                    } elseif ($reel->name === 'Wellbeing') {
                        $videoId = $this->getVimeoVideoId($reel->url);
                        if ($videoId) {
                            $reel->url = $this->getVimeoAuthenticatedUrl($videoId);
                        }

                        $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

                        $reel->thumbnailUrl = ($reel->thumbnailName != null && $reel->thumbnailName != '') ? $baseUrl . $reel->thumbnailName : null;
                        unset($reel->thumbnailName);
                    }
                }
            }

            if ($contentTypeLower === 'podcasts') {
                $thumbnailBaseUrl = 'https://dentistryinanutshell.com/dev_test/dentistry/public/images/videos_thumbnails/';

                foreach ($finalReels as &$podcast) {
                    $videoId = $this->getVimeoVideoId($podcast->url);
                    if ($videoId) {
                        $podcast->url = $this->getVimeoAuthenticatedUrl($videoId);
                    }

                    $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

                    $podcast->thumbnailUrl = ($podcast->thumbnail != null && $podcast->thumbnail != '') ? $baseUrl . $podcast->thumbnail : null;
                    unset($podcast->thumbnail);
                }
            }



            if ($request->has('activeMenu') && in_array($activeMenu, ['podcast', 'reel'])) {
                $videoType = $activeMenu == 'podcast' ? "podcast" : "reel";

                $assignedVideos = AssignVideo::where('assigned_uid', $user->id)
                    ->whereNotNull('assigned_by')
                    ->where('video_type', $videoType)
                    ->whereIn('video_id', $reelIds)
                    ->where(function ($query) {
                        $query->where('video_status', 'notcompleted')
                            ->orWhere('video_status', 'inprogress');
                    })
                    ->where(function ($query) {
                        $query->where(function ($q) {
                            $q->where('end_date', '=', Carbon::now()->toDateString())
                                ->where('end_time', '>', Carbon::now()->format('H:i:s'));
                        })->orWhere(function ($q) {
                            $q->where('end_date', '>', Carbon::now()->toDateString());
                        });
                    })
                    ->get()
                    ->keyBy('video_id');

                foreach ($finalReels as &$reel) {
                    if (isset($assignedVideos[$reel->id])) {
                        $assignment = $assignedVideos[$reel->id];
                        $reel->assignment = [
                            'video_status' => $assignment->video_status,
                            'end_date' => $assignment->end_date,
                            'end_time' => $assignment->end_time,
                        ];
                    }

                    $videoId = $this->getVimeoVideoId($reel->url);
                    if ($videoId) {
                        $reel->url = $this->getVimeoAuthenticatedUrl($videoId);
                    }

                    $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

                    $reel->thumbnail = ($reel->thumbnail != null && $reel->thumbnail != '') ? $baseUrl . $reel->thumbnail : null;
                }
            }

            // $Videoassignment = AssignVideo::where('assigned_uid', $user->id)
            //     ->whereNotNull('assigned_by')
            //     ->where('video_type', 'reel')
            //     ->where(function ($query) {
            //         $query->where('video_status', 'notcompleted')
            //             ->orWhere('video_status', 'inprogress');
            //     })
            //     ->where(function ($query) {
            //         $query->where(function ($q) {
            //             $q->where('end_date', '=', Carbon::now()->toDateString())
            //                 ->where('end_time', '>', Carbon::now()->format('H:i:s'));
            //         })->orWhere(function ($q) {
            //             $q->where('end_date', '>', Carbon::now()->toDateString());
            //         });
            //     })
            //     ->get();

            // $podcastAssignment = AssignVideo::where('assigned_uid', $user->id)
            //     ->whereNotNull('assigned_by')
            //     ->where('video_type', 'podcast')
            //     ->where(function ($query) {
            //         $query->where('video_status', 'notcompleted')
            //             ->orWhere('video_status', 'inprogress');
            //     })
            //     ->where(function ($query) {
            //         $query->where(function ($q) {
            //             $q->where('end_date', '=', Carbon::now()->toDateString())
            //                 ->where('end_time', '>', Carbon::now()->format('H:i:s'));
            //         })->orWhere(function ($q) {
            //             $q->where('end_date', '>', Carbon::now()->toDateString());
            //         });
            //     })
            //     ->get();

            $responseData = [
                'content' => $finalReels,
                'hashtags' => $hashtags,
            ];

            // if (!$Videoassignment->isEmpty()) {
            //     $responseData['Videoassignment'] = $Videoassignment;
            // }
            // if (!$podcastAssignment->isEmpty()) {
            //     $responseData['podcastAssignment'] = $podcastAssignment;
            // }

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $responseData,
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please provide all required parameters',
                'token' => $token
            ], 400);
        }
    }
}
