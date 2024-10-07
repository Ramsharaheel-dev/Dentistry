<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AssignVideo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
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

    // private function fetchVideoDurationFromVimeo($videoId, $accessToken)
    // {
    //     $client = new Client();
    //     $response = $client->get("https://api.vimeo.com/videos/{$videoId}", [
    //         'headers' => [
    //             'Authorization' => "Bearer {$accessToken}",
    //         ],
    //         'verify' => false,
    //     ]);

    //     $data = json_decode($response->getBody(), true);

    //     if (isset($data['duration'])) {
    //         $durationInSeconds = $data['duration'];
    //         $formattedDuration = gmdate('H:i:s', $durationInSeconds);
    //         return $formattedDuration;
    //     }
    // }

    public function dashboard(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        if ($user->status == 'paid') {
            if ($user->firstName == '-' && $user->lastName == '-') {
                return response()->json([
                    'status' => true,
                    'message' => 'Welcome new user',
                    'redirect_url' => 'welcome'
                ], 200);
            } else {
                if ($user->status == 'paid' && $user->privilege >= 1) {
                    // $reels = DB::table('reels')->get()->all();
                    $reels = DB::table('reels')->paginate(10);
                    $reelIds = [];
                    foreach ($reels as $singleReel) {
                        $reelIds[] = $singleReel->id;
                    }


                    $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'reels')->get();

                    $Videoassignment = AssignVideo::where('assigned_uid', $user->id)
                        ->whereNotNull('assigned_by')
                        ->where('video_type', 'reel')
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

                    $podcastAssignment = AssignVideo::where('assigned_uid', $user->id)
                        ->whereNotNull('assigned_by')
                        ->where('video_type', 'podcast')
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
                        ->get();

                    // Integrate assignment data into reels and authorize Vimeo URLs
                    foreach ($reels as &$reel) {
                        if (isset($Videoassignment[$reel->id])) {
                            $assignment = $Videoassignment[$reel->id];
                            $reel->assignment = [
                                'video_status' => $assignment->video_status,
                                'end_date' => $assignment->end_date,
                                'end_time' => $assignment->end_time,
                            ];
                        }

                        // Authorize Vimeo URL
                        $videoId = $this->getVimeoVideoId($reel->url);
                        if ($videoId) {
                            $reel->url = $this->getVimeoAuthenticatedUrl($videoId);
                        }
                        $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

                        $reel->thumbnail = ($reel->thumbnail != null && $reel->thumbnail != '') ? $baseUrl . $reel->thumbnail : null;
                    }

                    $responseData = [
                        // 'user' => $user,
                        'videos' => $reels,
                        'hashtags' => $hashtags
                    ];

                    if (!$podcastAssignment->isEmpty()) {
                        $responseData['podcastAssignment'] = $podcastAssignment;
                    }

                    return response()->json([
                        'status' => true,
                        'message' => 'Dashboard Data',
                        'data' => $responseData,
                        'token' => $token
                    ], 200);
                } else {
                    $reels = DB::table('reels')->limit(2)->get();
                    $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'reels')->get();

                    // Authorize Vimeo URLs for limited reels
                    foreach ($reels as &$reel) {
                        $videoId = $this->getVimeoVideoId($reel->url);
                        if ($videoId) {
                            $reel->url = $this->getVimeoAuthenticatedUrl($videoId);
                        }

                        $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/video_thumbnails/';

                        $reel->thumbnail = ($reel->thumbnail != null && $reel->thumbnail != '') ? $baseUrl . $reel->thumbnail : null;
                    }

                    return response()->json([
                        'status' => true,
                        'message' => 'Success || Dashboard Data',
                        'data' => [
                            // 'user' => $user,
                            'reels' => $reels,
                            'hashtags' => $hashtags,
                        ],
                    ], 200);
                }
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Subscription not paid',
                'redirect_url' => 'subscription-plans'
            ], 403);
        }
    }

    public function dashboardVideoShow(Request $request, $id)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        $user = DB::table('users')->where('id', $user->id)->first();

        if ($user->status == 'paid') {
            if ($user->firstName == '-' && $user->lastName == '-') {
                return response()->json([
                    'status' => true,
                    'message' => 'Welcome new user',
                    'redirect_url' => 'welcome'
                ], 200);
            } else {
                $reel = DB::table('reels')->where('id', $id)->first();

                if (!$reel) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Reel not found'
                    ], 404);
                }

                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'reels')->get();

                $Videoassignment = AssignVideo::where('assigned_uid', $user->id)
                    ->whereNotNull('assigned_by')
                    ->where('video_type', 'reel')
                    ->whereIn('video_id', [$id])
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

                $podcastAssignment = AssignVideo::where('assigned_uid', $user->id)
                    ->whereNotNull('assigned_by')
                    ->where('video_type', 'podcast')
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
                    ->get();

                // Integrate assignment data into reels and authorize Vimeo URLs
                if (isset($Videoassignment[$reel->id])) {
                    $assignment = $Videoassignment[$reel->id];
                    $reel->assignment = [
                        'video_status' => $assignment->video_status,
                        'end_date' => $assignment->end_date,
                        'end_time' => $assignment->end_time,
                    ];
                }

                // Authorize Vimeo URL
                $videoId = $this->getVimeoVideoId($reel->url);
                if ($videoId) {
                    $reel->url = $this->getVimeoAuthenticatedUrl($videoId);
                }

                $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

                $reel->thumbnail = ($reel->thumbnail != null && $reel->thumbnail != '') ? $baseUrl . $reel->thumbnail : null;

                $responseData = [
                    'videos' => $reel,
                    'hashtags' => $hashtags
                ];

                if (!$podcastAssignment->isEmpty()) {
                    $responseData['podcastAssignment'] = $podcastAssignment;
                }

                return response()->json([
                    'status' => true,
                    'data' => $responseData,
                    'token' => $token
                ], 200);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Subscription not paid',
                'redirect_url' => 'subscription-plans'
            ], 403);
        }
    }

    public function podcast(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        $email = $user->email;
        $user = DB::table('users')->where('email', $email)->first();
        $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'podcasts')->get();
        $firstHashtag = DB::table('hashtags')->where('nameOfContentSection', 'podcasts')->first();
        $podcasts = DB::table('podcasts')->where('hashtagId', $firstHashtag->id)->get()->all();
        $hashtagValue = $firstHashtag->nameOfHashtag;

        if ($user->status == 'paid' && $user->privilege >= 0 && $hashtagValue == 'Podcasts') {

            $podcastIds = array_column($podcasts, 'id');

            $assignedVideos = AssignVideo::where('assigned_uid', $user->id)
                ->whereNotNull('assigned_by')
                ->where('video_type', 'podcast')
                ->whereIn('video_id', $podcastIds)
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

            foreach ($podcasts as &$podcast) {
                if (isset($assignedVideos[$podcast->id])) {
                    $assignment = $assignedVideos[$podcast->id];
                    $podcast->assignment = [
                        'video_status' => $assignment->video_status,
                        'end_date' => $assignment->end_date,
                        'end_time' => $assignment->end_time,
                    ];
                }

                $videoId = $this->getVimeoVideoId($podcast->url);
                if ($videoId) {
                    $podcast->url = $this->getVimeoAuthenticatedUrl($videoId);
                }

                $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

                $podcast->thumbnail = ($podcast->thumbnail != null && $podcast->thumbnail != '') ? $baseUrl . $podcast->thumbnail : null;
            }

            $Videoassignment = AssignVideo::where('assigned_uid', $user->id)
                ->whereNotNull('assigned_by')
                ->where('video_type', 'reel')
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
                ->get();

            $responseData = [
                // 'user' => $user,
                'videos' => $podcasts,
                'hashtags' => $hashtags
            ];

            if (!$Videoassignment->isEmpty()) {
                $responseData['Videoassignment'] = $Videoassignment;
            }

            return response()->json([
                'status' => true,
                'message' => 'Success || Podcast Data',
                'data' => $responseData,
                'token' => $token
            ], 200);
        } else if ($hashtagValue == 'Webinar') {
            return response()->json([
                'status' => false,
                'message' => 'Upgrade your subscription to access this page',
                'redirect_url' => 'subscription-plans'
            ], 403);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Upgrade your subscription to access this page',
            ], 403);
        }
    }

    public function podcastVideoShow(Request $request, $id)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        $email = $user->email;
        $user = DB::table('users')->where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'podcasts')->get();
        $podcast = DB::table('podcasts')->where('id', $id)->first();

        if (!$podcast) {
            return response()->json([
                'status' => false,
                'message' => 'Podcast not found'
            ], 404);
        }

        if ($user->privilege >= 0) {
            $assignedVideos = AssignVideo::where('assigned_uid', $user->id)
                ->whereNotNull('assigned_by')
                ->where('video_type', 'podcast')
                ->where('video_id', $id)
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

            if (isset($assignedVideos[$podcast->id])) {
                $assignment = $assignedVideos[$podcast->id];
                $podcast->assignment = [
                    'video_status' => $assignment->video_status,
                    'end_date' => $assignment->end_date,
                    'end_time' => $assignment->end_time,
                ];
            }

            $videoId = $this->getVimeoVideoId($podcast->url);
            if ($videoId) {
                $podcast->url = $this->getVimeoAuthenticatedUrl($videoId);
            }

            $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

            $podcast->thumbnail = ($podcast->thumbnail != null && $podcast->thumbnail != '') ? $baseUrl . $podcast->thumbnail : null;

            $Videoassignment = AssignVideo::where('assigned_uid', $user->id)
                ->whereNotNull('assigned_by')
                ->where('video_type', 'reel')
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
                ->get();

            $responseData = [
                // 'user' => $user,
                'videos' => $podcast,
                'hashtags' => $hashtags
            ];

            if (!$Videoassignment->isEmpty()) {
                $responseData['Videoassignment'] = $Videoassignment;
            }

            return response()->json([
                'status' => true,
                'message' => 'Success || Podcast Data',
                'data' => $responseData,
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }
    }

    public function buildYourBusiness(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        if ($user->status == 'paid' && $user->privilege >= 2) {
            // Fetch hashtags related to business and finances
            $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'businessAndFinances')->get();

            // Fetch specific hashtags for finance and business
            $financeHashtag = DB::table('hashtags')
                ->where('nameOfContentSection', 'businessAndFinances')
                ->where('nameOfHashtag', 'Finance - Shorts')
                ->first();
            $businessHashtag = DB::table('hashtags')
                ->where('nameOfContentSection', 'businessAndFinances')
                ->where('nameOfHashtag', 'Business')
                ->first();

            // Fetch reels for finance and business based on their hashtags
            $financeReels = DB::table('businessandfinances')->where('hashtagId', $financeHashtag->id)->get();
            $businessReels = DB::table('businessandfinances')->where('hashtagId', $businessHashtag->id)->get();

            // Iterate through business reels to update Vimeo URLs
            foreach ($businessReels as $businessReel) {
                $videoId = $this->getVimeoVideoId($businessReel->url);
                if ($videoId) {
                    $businessReel->url = $this->getVimeoAuthenticatedUrl($videoId);
                }

                $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

                $businessReel->thumbnail = ($businessReel->thumbnail != null && $businessReel->thumbnail != '') ? $baseUrl . $businessReel->thumbnail : null;
            }

            // Iterate through finance reels to update Vimeo URLs
            foreach ($financeReels as $financeReel) {
                $videoId = $this->getVimeoVideoId($financeReel->url);
                if ($videoId) {
                    $financeReel->url = $this->getVimeoAuthenticatedUrl($videoId);
                }
                $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

                $businessReel->thumbnail = ($businessReel->thumbnail != null && $businessReel->thumbnail != '') ? $baseUrl . $businessReel->thumbnail : null;
            }

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => [
                    'businessReels' => $businessReels,
                    'financeReels' => $financeReels,
                    'hashtags' => $hashtags,
                ],
                'contentType' => 'businessAndFinances',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'message' => 'Upgrade your subscription to access this page',
                'contentType' => 'businessAndFinances',
                'token' => $token
            ], 403);
        }
    }

    public function allBlogs(Request $request)
    {
        $user = $request->user();

        $token = $request->bearerToken();

        $firstHashtag = DB::table('hashtags')->where('nameOfContentSection', 'blogs')->get()->first();
        // $blogs = DB::table('blogs')->where('hashtagId', $firstHashtag->id)->get()->all();
        $blogs = DB::table('blogs')->select('id', 'nameOfPublisher', 'thumbnail', 'dateOfPublish')->get();

        $hashtagValue = $firstHashtag->nameOfHashtag;


        $thumbnailBaseUrl = 'https://dentistryinanutshell.com/dian/public/blogs/thumbnails/';

        foreach ($blogs as &$blog) {
            if (isset($blog->thumbnail)) {
                $blog->thumbnail = $thumbnailBaseUrl . $blog->thumbnail;
            }
        }

        $email = $user->email;
        $user = DB::table('users')->where('email', $email)->get()->first();
        if ($user->privilege >= 0) {
            $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'blogs')->get();
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'blogs' => $blogs,
                'hashtags' => $hashtags,
                'selectedHashtagValue' => $hashtagValue,
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Email Not Available',
                'token' => $token
            ], 500);
        }
    }

    public function singleBlog(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();
        $blogId = $request->input('blogId');

        // Fetch the blog by id
        $blog = DB::table('blogs')->where('id', $blogId)->first();

        if (!$blog) {
            return response()->json([
                'status' => false,
                'message' => 'Blog not found',
                'token' => $token
            ], 404);
        }

        $blogData = json_decode($blog->data, true);

        // Check if 'content' exists and is an array
        if (isset($blogData[0]['content']) && is_array($blogData[0]['content'])) {
            foreach ($blogData[0]['content'] as &$contentItem) {
                if (isset($contentItem['image'])) {
                    // Modify the image URL or path as needed
                    $contentItem['image'] = 'https://www.dentistryinanutshell.com/dian/public/blogs/blogImages/general/' . $contentItem['image'] . '.png';
                }
            }
        }

        // Fetching hashtags related to blogs
        $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'blogs')->get();

        // Getting the email of the user
        $email = $user->email;

        // Fetching user details
        $userDetails = DB::table('users')->where('email', $email)->first();

        if ($userDetails && $userDetails->privilege >= 0) {
            // If user privilege is greater than or equal to 0, return blogs and hashtags
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'blogs' => [
                    'id' => $blog->id,
                    'nameOfPublisher' => $blog->nameOfPublisher,
                    'content' => $blogData,
                    'dateOfPublish' => $blog->dateOfPublish,
                    'hashtagId' => $blog->hashtagId,
                ],
                'hashtags' => $hashtags,
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access',
                'token' => $token
            ], 403);
        }
    }
    public function student(Request $request)
    {

        $user = $request->user();
        $token = $request->bearerToken();

        $email = $user->email;
        $user = DB::table('users')->where('email', $email)->first();
        $firstHashtag = DB::table('hashtags')->where('nameOfContentSection', 'students')->first();
        $students = DB::table('students')->where('hashtagId', $firstHashtag->id)->get()->all();
        $hashtagValue = $firstHashtag->nameOfHashtag;

        // Base URL for thumbnails
        $thumbnailBaseUrl = 'https://dentistryinanutshell.com/dian/public/student/images/';
        foreach ($students as &$file) {
            if (isset($file->thumbnailName)) {
                $file->thumbnailUrl = $thumbnailBaseUrl . $file->thumbnailName;
            }
        }

        if ($user->status == 'paid' && $user->privilege >= 1) {

            $path = './student/';
            $files = array_diff(scandir($path), ['.', '..']);

            $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'students')->get();

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => [
                    'content' => $students,
                    'hashtags' => $hashtags,
                    'selectedHashtagValue' => $hashtagValue
                ],
                'contentType' => 'students',
                'activeMenu' => 'student',
                'token' => $token
            ]);
        } else {
            $message = 'Upgrade your subscription to access this page';
            return response()->json([
                'status' => false,
                'message' => $message,
                'data' => [
                    'user' => $user,
                    'contentType' => 'students',
                    'activeMenu' => 'student',
                    'token' => $token

                ]
            ], 403);
        }
    }

    public function healthAndWellbeing(Request $request)
    {

        $user = $request->user();

        $token = $request->bearerToken();

        if ($user->status == 'paid' && $user->privilege >= 2) {

            $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'healthAndWellBeing')->get();
            $firstHashtag = DB::table('hashtags')->where('nameOfContentSection', 'healthAndWellBeing')->first();
            $healths = DB::table('healthandwellbeing')->where('hashtagId', $firstHashtag->id)->get()->all();

            foreach ($healths as &$health) {

                $videoId = $this->getVimeoVideoId($health->url);
                if ($videoId) {
                    $health->url = $this->getVimeoAuthenticatedUrl($videoId);
                }

                $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

                $health->thumbnail = ($health->thumbnail != null && $health->thumbnail != '') ? $baseUrl . $health->thumbnail : null;
            }


            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => [
                    'content' => $healths,
                    'hashtags' => $hashtags,
                    'activeMenu' => 'healthAndWellbeing',
                    'contentType' => 'healthandwellbeing'
                ],
                'token' => $token
            ]);
        } else {
            $message = 'Upgrade your subscription to access this page';
            return response()->json([
                'status' => false,
                'message' => $message,
                'data' => [
                    'user' => $user,
                    'contentType' => 'healthAndWellBeing',
                    'activeMenu' => 'healthAndWellbeing'
                ],
                'token' => $token
            ], 403);
        }
    }

    public function courses(Request $request)
    {

        $user = $request->user();

        if ($user->status == 'paid' && $user->privilege >= 2) {

            $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'courses')->get();

            $courses = DB::table('courses')->get()->all();

            foreach ($courses as $course) {
                $course->url = 'https://www.dentistryinanutshell.com/dian/public/courses/' .$course->url;
            }

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => [
                    'content' => $courses,
                    'hashtags' => $hashtags
                ]
            ]);
        } else {
            $message = 'Upgrade your subscription to access this page';
            return response()->json([
                'status' => false,
                'message' => $message,
                'data' => [
                    'user' => $user,
                    'contentType' => 'courses',
                    'activeMenu' => 'courses'
                ]
            ], 403);
        }
    }

    public function guidelines(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        if ($user->status == 'paid' && $user->privilege >= 2) {
            $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'guidelines')->get();
            $fileNames = DB::table('guidelines')->select('id', 'name', 'thumbnailName', 'url')->get();

            // Base URL for thumbnails
            $thumbnailBaseUrl = 'https://dentistryinanutshell.com/dian/public/guidelines/';

            foreach ($fileNames as &$file) {
                if (isset($file->thumbnailName)) {
                    $file->thumbnailUrl = $thumbnailBaseUrl . $file->thumbnailName;
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => [
                    'content' => $fileNames,
                    'hashtags' => $hashtags,
                    'activeMenu' => 'guidelines',
                    'contentType' => 'guidelines'
                ],
                'token' => $token
            ]);
        } else {
            $message = 'Upgrade your subscription to access this page';
            return response()->json([
                'status' => false,
                'message' => $message,
                'data' => [
                    'user' => $user,
                    'contentType' => 'guidelines',
                    'activeMenu' => 'guidelines'
                ],
                'token' => $token
            ], 403);
        }
    }

    public function downloads(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        if ($user->privilege >= 2) {
            $pathThumbnails = './downloads/thumbnails';
            $thumbnailFiles = scandir($pathThumbnails);
            $thumbnailFiles = array_diff(scandir($pathThumbnails), array('.', '..'));

            // Initialize an array to store structured data
            $data = [];

            foreach ($thumbnailFiles as $thumbnail) {
                // Extract the thumbnail number from its filename
                preg_match('/(\d+)/', $thumbnail, $matches);
                $thumbnailNumber = $matches[1] ?? null;

                // If a matching thumbnail number is found, add its files
                if ($thumbnailNumber !== null) {
                    $filesUrls = [];
                    $pathFiles = './downloads/';
                    $files = scandir($pathFiles);

                    foreach ($files as $file) {
                        // Check if the file corresponds to the current thumbnail number
                        if (strpos($file, "downloads{$thumbnailNumber}.pdf") !== false) {
                            $filesUrls[] = 'https://dentistryinanutshell.com/dian/public/downloads/' . $file;
                        }
                    }

                    // Add thumbnail and its corresponding files to data array
                    $data[] = [
                        'thumbnailFile' => 'https://dentistryinanutshell.com/dian/public/downloads/thumbnails/' . $thumbnail,
                        'files' => $filesUrls,
                    ];
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $data,
                'token' => $token
            ]);
        } else {
            $message = 'Upgrade your subscription to access this page';
            return response()->json([
                'status' => false,
                'message' => $message,
                'data' => [
                    'user' => $user,
                    'contentType' => 'downloads',
                ],
                'token' => $token
            ], 403);
        }
    }
}
