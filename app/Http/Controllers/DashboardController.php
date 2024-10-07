<?php

namespace App\Http\Controllers;

use App\Models\AssignVideo;
use Illuminate\Http\Request;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Facades\URL as FacadesURL;
use URL;
use Carbon\Carbon;

use Jenssegers\Agent\Agent;

$agent = new Agent();

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

class DashboardController extends Controller
{
    // //Patch for Force User Logged
    // public function __construct()
    // {
    //     // Set session variables
    //     session(['email' => 'asad.cybertron@gmail.com']);
    //     session(['id' => '627']);
    //     session(['signin1' => 'yes']);
    //     //  session(['username' => 'UI']);
    //     session(['privilege' => '3']);
    // }

    // public function __construct()
    // {
    //     $_SESSION['email'] = "hancockghostwriters@gmail.com";
    //     $_SESSION['signin1'] = 'yes';
    //     $_SESSION['username'] = "UI";
    //     session('privilege') = "9";
    // }

    public function mailNow($message, $fromEmail, $toEmail, $subject, $userName)
    {

        $dianKey = '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';

        $email = new \SendGrid\Mail\Mail();
        $email->setfrom($fromEmail, $userName);
        $email->setSubject($subject);
        $email->addto($toEmail, 'DIAN');
        $email->addContent("text/plain", $message);

        $sendgrid = new \SendGrid($dianKey);

        try {
            $response = $sendgrid->send($email);

            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }

    function shopifyLogoUrl()
    {
        if (session()->has('email')) {
            return redirect('dashboard');
        } else {
            return redirect('home');
        }
    }

    function contact()
    {
        $hideSignin = FALSE;
        if (session()->has('email')) {
            $hideSignin = TRUE;
        }
        return view('contact', ['hideSignin' => $hideSignin]);
    }

    function home()
    {
        $hideSignin = FALSE;
        if (session()->has('email')) {
            $hideSignin = TRUE;
        }
        return view('home', ['hideSignin' => $hideSignin]);
    }

    function welcome()
    {
        $hideSignin = FALSE;
        if (session()->has('email')) {
            $hideSignin = TRUE;
        }
        return view('pages.welcome', ['hideSignin' => $hideSignin]);
    }

    function aboutUs()
    {
        $hideSignin = FALSE;
        if (session()->has('email')) {
            $hideSignin = TRUE;
        }
        return view('aboutUs', ['hideSignin' => $hideSignin]);
    }

    function packageInfo()
    {
        return 'packageInfo';
    }

    function uploadInitialProfileData(Request $request)
    {
        if ($request->firstName && $request->lastName) {

            $firstName = $request->firstName;
            $lastName = $request->lastName;
            $gdcNumber = $request->gdc_number;

            $email = session('email');

            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user != '') {
                if ($request->hasFile('editProfilePic')) {
                    $profilePic = $request->file('editProfilePic');

                    // Generate a unique filename
                    $uniqueFileName = uniqid() . '.' . $profilePic->getClientOriginalExtension();

                    // Save the file with the unique filename
                    Storage::put('profile_pics/' . $uniqueFileName, file_get_contents($profilePic), 'public');

                    $profilePicName = $uniqueFileName;
                } else {
                    $profilePicName = $user->profilePic;
                }

                if ($request->hasFile('initialSta
                ent')) {
                    $statement = $request->file('initialStatement');
                    $statementFileExtension = $statement->getClientOriginalExtension();
                    $statementFileName = $statement->getClientOriginalName();

                    $statementName = $statementFileName;

                    Storage::put('statements/' . $statementFileName, (string) file_get_contents($statement), 'public');
                } else {
                    $statementName = 'file.png';
                }
                $updateUser = DB::table('users')->where('email', $email)->update([
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'profilePic' => $profilePicName,
                    'gdc_number' => $gdcNumber,
                    'statement' => $statementName,
                    'statementOne' => 'file.png',
                    'statementTwo' => 'file.png',
                    'statementThree' => 'file.png',
                ]);
                return redirect('dashboard');
            }
        } else {
            return redirect();
        }
    }

    function updateUserProfile(Request $request)
    {
        $email = session('email');

        $user = DB::table('users')->where('email', $email)->get()->first();

        if ($request->firstName) {
            $firstName = $request->firstName;
        } else {
            $firstName = $user->firstName;
        }

        if ($request->firstName) {
            $lastName = $request->lastName;
        } else {
            $lastName = $user->lastName;
        }


        $gdcNumber = $request->gdc_number;
        $bio = $request->bio;
        $designation = $request->designation;
        $location = $request->location;
        $instagramUrl = $request->instagram_url;
        $facebookUrl = $request->facebook_url;
        $twitterUrl = $request->twitter_url;
        $linkedInUrl = $request->linkedin_url;

        if ($user != '') {
            if ($request->hasFile('editProfilePic')) {
                $profilePic = $request->file('editProfilePic');

                // Generate a unique filename
                $uniqueFileName = uniqid() . '.' . $profilePic->getClientOriginalExtension();

                // Save the file with the unique filename
                Storage::put('profile_pics/' . $uniqueFileName, file_get_contents($profilePic), 'public');

                $profilePicName = $uniqueFileName;
            } else {
                $profilePicName = $user->profilePic;
            }
            if ($request->hasFile('editStatement')) {
                $statement = $request->file('editStatement');
                $statementFileExtension = $statement->getClientOriginalExtension();
                $statementFileName = $statement->getClientOriginalName();

                $statementName = $statementFileName;

                Storage::put('statements/' . $statementFileName, (string) file_get_contents($statement), 'public');
            } else {
                $statementName = $user->statement;
            }

            if ($request->hasFile('editStatementOne')) {
                $statementOne = $request->file('editStatementOne');
                $statementFileExtensionOne = $statementOne->getClientOriginalExtension();
                $statementFileNameOne = $statementOne->getClientOriginalName();

                $statementNameOne = $statementFileNameOne;

                Storage::put('statements/' . $statementFileNameOne, (string) file_get_contents($statementOne), 'public');
            } else {
                $statementNameOne = $user->statementOne;
            }
            if ($request->hasFile('editStatementTwo')) {
                $statementTwo = $request->file('editStatementTwo');
                $statementFileExtensionTwo = $statementTwo->getClientOriginalExtension();
                $statementFileNameTwo = $statementTwo->getClientOriginalName();

                $statementNameTwo = $statementFileNameTwo;

                echo $statementNameTwo;

                Storage::put('statements/' . $statementFileNameTwo, (string) file_get_contents($statementTwo), 'public');
            } else {
                $statementNameTwo = $user->statementTwo;
            }
            if ($request->hasFile('editStatementThree')) {
                $statementThree = $request->file('editStatementThree');
                $statementFileExtensionThree = $statementThree->getClientOriginalExtension();
                $statementFileNameThree = $statementThree->getClientOriginalName();

                $statementNameThree = $statementFileNameThree;

                Storage::put('statements/' . $statementFileNameThree, (string) file_get_contents($statementThree), 'public');
            } else {
                $statementNameThree = $user->statementThree;
            }
            $updateUser = DB::table('users')->where('email', $email)->update([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'gdc_number' => $gdcNumber,
                'designation' => $designation,
                'bio' => $bio,
                'location' => $location,
                'instagram_url' => $instagramUrl,
                'facebook_url' => $facebookUrl,
                'twitter_url' => $twitterUrl,
                'linkedin_url' => $linkedInUrl,
                'profilePic' => $profilePicName,
                'statement' => $statementName,
                'statementOne' => $statementNameOne,
                'statementTwo' => $statementNameTwo,
                'statementThree' => $statementNameThree
            ]);

            // dd($updateUser);

            $user = DB::table('users')->where('email', $email)->get()->first();

            //    return $user;
            return redirect('dashboard');
        }
    }

    function deleteProfileImage(Request $request)
    {
        $email = session('email');

        $user = DB::table('users')->where('email', $email)->first();

        $oldProfilePic = $request->image_path;

        if ($oldProfilePic) {
            Storage::delete('profile_pics/' . $oldProfilePic);
        }

        DB::table('users')->where('email', $email)->update(['profilePic' => null]);

        return [
            'success' => true,
        ];
    }

    function submitSubscribe(Request $request)
    {
        if ($request->has('name') && $request->has('email')) {

            $name = $request->name;
            $email = $request->email;
            $mobileNumber = $request->mobileNumber;

            // Update privlege level of user here in database

            $subscriber = DB::table('subscribers')->where('name', $name)->where('email', $email)->get()->first();

            if ($subscriber == '') {
                $newSubscriber = DB::table('subscribers')->insert([
                    'name' => $name,
                    'email' => $email,
                    'phoneNumber' => $mobileNumber
                ]);

                $response = 'Thanks for Subscribing...';

                return view('subscribe', ['response' => $response]);
            } else {
                $response = 'This email address is alreday registered...';

                return view('subscribe', ['response' => $response]);
            }
        } else {
            return 'FAIL';
        }
    }

    function faq()
    {
        $hideSignin = FALSE;
        if (session()->has('email')) {
            $hideSignin = TRUE;
        }
        return view('faq', ['hideSignin' => $hideSignin]);
    }

    public function fetchSelectedVideos(Request $request)
    {
        $selectVideos = [];

        if ($request->videoIds) {
            $selectedId = $request->videoIds;

            $selectVideos = DB::table('reels')->whereIn('id', $selectedId)->first();
            // dd($selectVideos);

            return response()->json($selectVideos);
        }
    }


    public function freeSubscription()
    {
        $email = session('email');

        if (!$email) {
            // Handle the case when the email is not found in the session
            return redirect()->back()->with('error', 'Email not found in session.');
        }
        $user =  DB::table('users')->where('email', $email)->first();
        DB::table('users')->where('email', $email)->update([
            'status' => 'paid',
            'privilege' => 0
        ]);

        return view('dashboard', compact('user'));
    }

    public function dashboard()
    {
        if (session()->has('email')) {

            session()->forget('assigned_video');
            session()->forget('podcast_assign');

            $email = session()->get('email');

            $user = DB::table('users')->where('email', $email)->first();

            if ($user->status == 'paid') {
                if ($user->firstName == '-' && $user->lastName == '-') {
                    return redirect('welcome');
                } else {

                    $privilege = session('privilege');
                    if ($user->status == 'paid' && $privilege >= 1) {

                        // $reels = DB::table('reels')->paginate(3);
                        $reels = DB::table('reels')->get()->all();
                        $reelIds = [];
                        foreach ($reels as $singleReel) {
                            $reelIds[] = $singleReel->id;
                        }

                        $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'reels')->get();

                        $assignedVideos = AssignVideo::where('assigned_uid', $user->id)
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
                            ->pluck('video_id')
                            ->toArray();

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

                        if ($Videoassignment->count() > 0) {
                            session()->put('assigned_video', $Videoassignment);
                        }

                        if ($podcastAssignment->count() > 0) {
                            session()->put('podcast_assign', $podcastAssignment);
                        }

                        $assignedVideosData = [];
                        foreach ($reels as $reel) {
                            $deadline = AssignVideo::where('assigned_uid', $user->id)
                                ->whereNotNull('assigned_by')
                                ->where('video_type', 'reel')
                                ->whereIn('video_id', [$reel->id])
                                ->where(function ($query) {
                                    $query->where('video_status', 'notcompleted')
                                        ->orWhere('video_status', 'inprogress');
                                })
                                ->where(function ($query) {
                                    $query->where(function ($q) {
                                        $q->where('end_date', '=', Carbon::now()->toDateString())->where('end_time', '>', Carbon::now()->format('H:i:s'));
                                    })->orWhere(function ($q) {
                                        $q->where('end_date', '>', Carbon::now()->toDateString());
                                    });
                                })
                                ->first();

                            if ($deadline) {
                                $assignedVideosData[$reel->id] = [
                                    'end_time' => $deadline->end_time,
                                    'end_date' => $deadline->end_date,
                                ];
                            }
                        }

                        if ($user->created_by > 0) {
                            session()->put('filter', true);
                        }

                        return view('pages.home', compact('user', 'reels', 'hashtags', 'assignedVideosData', 'assignedVideos', 'podcastAssignment', 'Videoassignment') + ['activeMenu' => 'dashboard']);
                    } else {

                        $reels = DB::table('reels')->limit(2)->get();
                        $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'reels')->get();

                        return view('pages.home', compact('user', 'reels', 'hashtags') + ['activeMenu' => 'dashboard']);
                    }
                }
            } else {
                return redirect('subscription-plans');
            }
        } else {
            return redirect('signin');
        }
    }

    function dashboardVideoShow($id)
    {
        if (session()->has('email')) {

            session()->forget('assigned_video');
            session()->forget('podcast_assign');

            $email = session('email');

            $user = DB::table('users')->where('email', $email)->first();

            if ($user && $user->status == 'paid') {

                if ($user->firstName == '-' && $user->lastName == '-') {
                    return redirect('welcome');
                } else {

                    $reel = DB::table('reels')->where('id', $id)->first();

                    if (!$reel) {
                        abort(404);
                    }

                    $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'reels')->get();

                    $assignedVideos = AssignVideo::where('assigned_uid', $user->id)
                        ->whereNotNull('assigned_by')
                        ->where('video_type', 'reel')
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
                        ->pluck('video_id')
                        ->toArray();

                    $assignedVideosData = [];
                    $deadline = AssignVideo::where('assigned_uid', $user->id)
                        ->whereNotNull('assigned_by')
                        ->where('video_type', 'reel')
                        ->where('video_id', $id)
                        ->where(function ($query) {
                            $query->where('video_status', 'notcompleted')
                                ->orWhere('video_status', 'inprogress');
                        })
                        ->where(function ($query) {
                            $query->where(function ($q) {
                                $q->where('end_date', '=', Carbon::now()->toDateString())->where('end_time', '>', Carbon::now()->format('H:i:s'));
                            })->orWhere(function ($q) {
                                $q->where('end_date', '>', Carbon::now()->toDateString());
                            });
                        })
                        ->first();

                    if ($deadline) {
                        $assignedVideosData[$id] = [
                            'end_time' => $deadline->end_time,
                            'end_date' => $deadline->end_date,
                        ];
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

                    if ($Videoassignment->count() > 0) {
                        session()->put('assigned_video', $Videoassignment);
                    }

                    if ($podcastAssignment->count() > 0) {
                        session()->put('podcast_assign', $podcastAssignment);
                    }

                    return view('pages.dashboard_filter', compact('user', 'reel', 'hashtags', 'assignedVideos', 'assignedVideosData', 'Videoassignment', 'podcastAssignment') + ['activeMenu' => 'dashboard']);
                }
            } else {
                return redirect('subscription-plans');
            }
        } else {
            return redirect('signin');
        }
    }


    function privacyPolicy()
    {
        $hideSignin = FALSE;
        if (session()->has('email')) {
            $hideSignin = TRUE;
        }
        return view('privacyPolicy', ['hideSignin' => $hideSignin]);
    }

    function termsAndConditions()
    {
        $hideSignin = FALSE;
        if (session()->has('email')) {
            $hideSignin = TRUE;
        }
        return view('termsAndConditions', ['hideSignin' => $hideSignin]);
    }

    function hashtagFilter2(Request $request)
    {
        return 'done';
    }

    function businessFinanceHashtagFilter() {}

    function hashtagFilter(Request $request)
    {
        if ($request->has('contentType') && $request->has('nameOfHashtag')) {

            session()->forget('assigned_video');
            session()->forget('podcast_assign');

            $contentType = $request->contentType;
            $contentTypeLower = strtolower($contentType);
            $hashtagValue = $request->nameOfHashtag;
            $activeMenu = $request->activeMenu;

            $hashtags = DB::table('hashtags')->where('nameOfContentSection', $contentType)->get()->all();

            $hashtagId = '';

            for ($i = 0; $i < count($hashtags); $i++) {
                if ($hashtags[$i]->nameOfHashtag == $hashtagValue) {
                    $hashtagId = $hashtags[$i]->id;
                }
            }

            $finalReels = DB::table($contentTypeLower)->where('hashtagId', $hashtagId)->get()->all();

            $reelIds = [];
            foreach ($finalReels as $reel) {
                $reelIds[] = $reel->id;
            }

            $email = session('email');

            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($activeMenu == 'podcast') {
                $videoType = "podcast";
            } else {
                $videoType = "reel";
            }

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
                ->pluck('video_id')
                ->toArray();

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

            if ($Videoassignment->count() > 0) {
                session()->put('assigned_video', $Videoassignment);
            }

            if ($podcastAssignment->count() > 0) {
                session()->put('podcast_assign', $podcastAssignment);
            }

            $assignedVideosData = [];
            foreach ($finalReels as $reel) {
                $deadline = AssignVideo::where('assigned_uid', $user->id)
                    ->whereNotNull('assigned_by')
                    ->where('video_type', $videoType)
                    ->whereIn('video_id', [$reel->id])
                    ->where(function ($query) {
                        $query->where('video_status', 'notcompleted')
                            ->orWhere('video_status', 'inprogress');
                    })
                    ->where(function ($query) {
                        $query->where(function ($q) {
                            $q->where('end_date', '=', Carbon::now()->toDateString())->where('end_time', '>', Carbon::now()->format('H:i:s'));
                        })->orWhere(function ($q) {
                            $q->where('end_date', '>', Carbon::now()->toDateString());
                        });
                    })
                    ->first();

                if ($deadline) {
                    $assignedVideosData[$reel->id] = [
                        'end_time' => $deadline->end_time,
                        'end_date' => $deadline->end_date,
                    ];
                }
            }

            $prvUrl = basename(FacadesURL::previous());

            //return 'success';

            // return $hashtags;

            $privilege = session('privilege');

            if ($hashtagValue == 'Webinar' && $privilege == 0) {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'podcasts', 'activeMenu' => 'podcast', 'message' => $message]);
            }

            // return view('hashtagFilter', ['user' => $user, 'finalReels' => $finalReels, 'hashtags' => $hashtags, 'activeMenu' => $activeMenu, 'selectedHashtagValue' => $hashtagValue]);
            return view('pages.hashtag_filter', ['user' => $user, 'finalReels' => $finalReels, 'hashtags' => $hashtags, 'activeMenu' => $activeMenu, 'selectedHashtagValue' => $hashtagValue, 'assignedVideos' => $assignedVideos, 'assignedVideosData' => $assignedVideosData, 'Videoassignment' => $Videoassignment, 'podcastAssignment' => $podcastAssignment]);
        } else {
            return 'pass all parameters';
        }
    }

    function podcast()
    {
        if (session()->has('email')) {

            session()->forget('assigned_video');
            session()->forget('podcast_assign');

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();
            $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'podcasts')->get();
            $firstHashtag = DB::table('hashtags')->where('nameOfContentSection', 'podcasts')->get()->first();
            $podcasts = DB::table('podcasts')->where('hashtagId', $firstHashtag->id)->get()->reverse();
            $hashtagValue = $firstHashtag->nameOfHashtag;

            if ($user->status == 'paid' && session('privilege') >= 0 && $hashtagValue == 'Podcasts') {

                $podcastIds = [];
                foreach ($podcasts as $podcast) {
                    $podcastIds[] = $podcast->id;
                }

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
                    ->pluck('video_id')
                    ->toArray();

                $assignedVideosData = [];
                foreach ($podcasts as $podcast) {
                    $deadline = AssignVideo::where('assigned_uid', $user->id)
                        ->whereNotNull('assigned_by')
                        ->where('video_type', 'podcast')
                        ->whereIn('video_id', [$podcast->id])
                        ->where(function ($query) {
                            $query->where('video_status', 'notcompleted')
                                ->orWhere('video_status', 'inprogress');
                        })
                        ->where(function ($query) {
                            $query->where(function ($q) {
                                $q->where('end_date', '=', Carbon::now()->toDateString())->where('end_time', '>', Carbon::now()->format('H:i:s'));
                            })->orWhere(function ($q) {
                                $q->where('end_date', '>', Carbon::now()->toDateString());
                            });
                        })
                        ->first();

                    if ($deadline) {
                        $assignedVideosData[$podcast->id] = [
                            'end_time' => $deadline->end_time,
                            'end_date' => $deadline->end_date,
                        ];
                    }
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

                if ($Videoassignment->count() > 0) {
                    session()->put('assigned_video', $Videoassignment);
                }

                if ($podcastAssignment->count() > 0) {
                    session()->put('podcast_assign', $podcastAssignment);
                }

                return view('pages.hashtag_filter', ['user' => $user, 'finalReels' => $podcasts, 'hashtags' => $hashtags, 'activeMenu' => 'podcast', 'selectedHashtagValue' => $hashtagValue, 'assignedVideosData' => $assignedVideosData, 'assignedVideos' => $assignedVideos, 'podcastAssignment' => $podcastAssignment, 'Videoassignment' => $Videoassignment]);
            } else if ($hashtagValue == 'Webinar') {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'podcasts', 'activeMenu' => 'podcast', 'message' => $message]);
            }
        } else {
            return redirect('signin');
        }
    }

    function podcastVideoShow($id)
    {
        if (session()->has('email')) {

            session()->forget('assigned_video');
            session()->forget('podcast_assign');

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();
            $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'podcasts')->get();
            $podcast = DB::table('podcasts')->where('id', $id)->first();

            if (session('privilege') >= 0) {

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
                    ->pluck('video_id')
                    ->toArray();

                $assignedVideosData = [];
                $deadline = AssignVideo::where('assigned_uid', $user->id)
                    ->whereNotNull('assigned_by')
                    ->where('video_type', 'podcast')
                    ->where('video_id', $id)
                    ->where(function ($query) {
                        $query->where('video_status', 'notcompleted')
                            ->orWhere('video_status', 'inprogress');
                    })
                    ->where(function ($query) {
                        $query->where(function ($q) {
                            $q->where('end_date', '=', Carbon::now()->toDateString())->where('end_time', '>', Carbon::now()->format('H:i:s'));
                        })->orWhere(function ($q) {
                            $q->where('end_date', '>', Carbon::now()->toDateString());
                        });
                    })
                    ->first();

                if ($deadline) {
                    $assignedVideosData[$id] = [
                        'end_time' => $deadline->end_time,
                        'end_date' => $deadline->end_date,
                    ];
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

                if ($Videoassignment->count() > 0) {
                    session()->put('assigned_video', $Videoassignment);
                }

                if ($podcastAssignment->count() > 0) {
                    session()->put('podcast_assign', $podcastAssignment);
                }

                return view('pages.podcast_filter', ['user' => $user, 'podcast' => $podcast, 'hashtags' => $hashtags, 'activeMenu' => 'podcast', 'assignedVideosData' => $assignedVideosData, 'assignedVideos' => $assignedVideos, 'podcastAssignment' => $podcastAssignment, 'Videoassignment' => $Videoassignment]);
            }
        } else {
            return redirect('signin');
        }
    }

    function courses()
    {
        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid' && session('privilege') >= 2) {

                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'courses')->get();
                return view('courses', ['user' => $user, 'hashtags' => $hashtags, 'activeMenu' => 'courses', 'contentType' => 'courses']);
            } else {

                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'courses', 'activeMenu' => 'courses', 'message' => $message]);
            }
        } else {
            return redirect('signin');
        }
    }

    function courses1()
    {
        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid' && session('privilege') >= 2) {

                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'courses')->get();

                $courses = DB::table('courses')->get();
                return view('pages.courses', ['user' => $user, 'hashtags' => $hashtags, 'activeMenu' => 'courses', 'contentType' => 'courses', 'courses' => $courses]);
                // return view('courses', ['user' => $user, 'hashtags' => $hashtags, 'activeMenu' => 'courses', 'contentType' => 'courses']);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'courses', 'activeMenu' => 'courses', 'message' => $message]);
            }
        } else {
            return redirect('signin');
        }
    }

    function healthAndWellbeing()
    {
        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid' && session('privilege') >= 2) {

                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'healthAndWellBeing')->get();
                $firstHashtag = DB::table('hashtags')->where('nameOfContentSection', 'healthAndWellBeing')->get()->first();
                $healths = DB::table('healthandwellbeing')->where('hashtagId', $firstHashtag->id)->get()->all();
                return view('pages.healthAndWellbeing', ['user' => $user, 'hashtags' => $hashtags, 'healths' => $healths, 'activeMenu' => 'healthAndWellbeing', 'contentType' => 'healthandwellbeing']);
                // return view('healthAndWellbeing', ['user' => $user, 'hashtags' => $hashtags, 'healths' => $healths, 'activeMenu' => 'healthAndWellbeing', 'contentType' => 'healthAndWellbeing']);
            } else {

                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'healthAndWellbeings', 'activeMenu' => 'healthAndWellbeing', 'message' => $message]);
            }
        } else {
            return redirect('signin');
        }
    }

    function buildYourBusiness()
    {
        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid' && session('privilege') >= 2) {

                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'businessAndFinances')->get();
                $financeHashtag = DB::table('hashtags')->where('nameOfContentSection', 'businessAndFinances')->where('nameOfHashtag', 'Finance')->get()->first();
                $reels = DB::table('businessandfinances')->where('hashtagId', $financeHashtag->id)->get()->all();
                $businessHashtag = DB::table('hashtags')->where('nameOfContentSection', 'businessAndFinances')->where('nameOfHashtag', 'Business')->get()->first();
                $businessReels = DB::table('businessandfinances')->where('hashtagId', $businessHashtag->id)->get()->all();

                // return view('buildYourBusiness', ['user' => $user, 'reels' => $reels, 'businessReels' => $businessReels, 'hashtags' => $hashtags, 'activeMenu' => 'buildYourBusiness', 'contentType' => 'businessAndFinances']);
                return view('pages.buildYourBusiness', ['user' => $user, 'reels' => $reels, 'businessReels' => $businessReels, 'hashtags' => $hashtags, 'activeMenu' => 'buildYourBusiness', 'contentType' => 'businessAndFinances']);
            } else {

                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'businessAndFinances', 'activeMenu' => 'buildYourBusiness', 'message' => $message]);
            }
        } else {
            return redirect('signin');
        }
    }

    function downloads()
    {
        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if (session('privilege') >= 2) {
                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'downloads')->get();

                $path = './downloads/';
                $files = scandir($path);
                $fileNames = [];
                for ($i = 0; $i < count($files); $i++) {
                    if ($files[$i] != 'thumbnails') {
                        //array_push($fileNames,ucwords(strtolower($files[$i])));
                        array_push($fileNames, $files[$i]);
                    }
                }
                $fileNames = array_diff($fileNames, array('.', '..'));
                sort($fileNames);

                // $files = array_diff(scandir($path), array('.', '..'));

                $pathThumbnails = './downloads/thumbnails';
                $thumbnailFiles = scandir($pathThumbnails);
                $thumbnailFiles = array_diff(scandir($pathThumbnails), array('.', '..'));

                //return $fileNames;
                // return view('downloads', ['user' => $user, 'files' => $fileNames, 'hashtags' => $hashtags, 'thumbnailFiles' => $thumbnailFiles, 'activeMenu' => 'downloads', 'contentType' => 'downloads']);
                return view('pages.download', ['user' => $user, 'files' => $fileNames, 'hashtags' => $hashtags, 'thumbnailFiles' => $thumbnailFiles, 'activeMenu' => 'downloads', 'contentType' => 'downloads']);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'downloads', 'activeMenu' => 'downloads', 'message' => $message]);
            }
        } else {
            return redirect('signin');
        }
    }

    function assist()
    {
        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            $privilege = $user->privilege;

            if ($user->status == 'paid' && $privilege >= 2) {

                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'assists')->get();

                return view('assist', ['user' => $user, 'hashtags' => $hashtags, 'contentType' => 'assists', 'activeMenu' => 'assist']);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'assists', 'activeMenu' => 'assist', 'message' => $message]);
            }
        } else {
            return redirect('signin');
        }
    }

    function assistVideos()
    {

        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid' && session('privilege') >= 2) {

                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'assists')->get();

                $assists = DB::table('assists')->get()->all();

                return view('pages.assistVideos', ['user' => $user, 'hashtags' => $hashtags, 'assists' => $assists, 'contentType' => 'assist', 'activeMenu' => 'assist']);
                // return view('assistVideos', ['user' => $user, 'hashtags' => $hashtags, 'assists' => $assists, 'contentType' => 'assist', 'activeMenu' => 'assist']);
            } else {

                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'assist', 'activeMenu' => 'assist', 'message' => $message]);
            }
        } else {
            return redirect('signin');
        }
    }

    function student()
    {
        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();
            $firstHashtag = DB::table('hashtags')->where('nameOfContentSection', 'students')->get()->first();
            $students = DB::table('students')->where('hashtagId', $firstHashtag->id)->get()->reverse();
            $hashtagValue = $firstHashtag->nameOfHashtag;

            if ($user->status == 'paid' && session('privilege') >= 1) {

                $path = './student/';
                $files = scandir($path);
                $files = array_diff(scandir($path), array('.', '..'));

                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'students')->get();

                $agent = new Agent();
                return view('pages.hashtag_filter', ['user' => $user, 'finalReels' => $students, 'hashtags' => $hashtags, 'activeMenu' => 'student', 'selectedHashtagValue' => $hashtagValue]);
                // return view('hashtagFilter', ['user' => $user, 'finalReels' => $students, 'hashtags' => $hashtags, 'activeMenu' => 'student', 'selectedHashtagValue' => $hashtagValue]);

                // return view('student', ['user'=>$user, 'hashtags' => $hashtags, 'files' => $files,'activeMenu'=>'student','contentType'=>'students']);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'students', 'activeMenu' => 'student', 'message' => $message]);
            }
        } else {
            return redirect('signin');
        }
    }

    function refer()
    {
        if (session()->has('email')) {
            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid') {
                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'refer')->get();
                $refers = DB::table('refers')->get()->all();
                return view('refer', ['user' => $user, 'refers' => $refers, 'hashtags' => $hashtags, 'activeMenu' => 'refer', 'contentType' => 'refers']);
            } else {
                return redirect('stripe');
            }
        } else {
            return view('signin');
        }
    }

    function guidelines()
    {
        if (session()->has('email')) {
            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid' && session('privilege') >= 2) {
                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'guidelines')->get();

                $fileNames = DB::table('guidelines')->get()->all();

                return view('pages.guideline', ['user' => $user, 'fileNames' => $fileNames, 'hashtags' => $hashtags, 'activeMenu' => 'guidelines', 'contentType' => 'guidelines']);
                // return view('guidelines', ['user' => $user, 'fileNames' => $fileNames, 'hashtags' => $hashtags, 'activeMenu' => 'guidelines', 'contentType' => 'guidelines']);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'guidelines', 'activeMenu' => 'guidelines', 'message' => $message]);
            }
        } else {
            return view('signin');
        }
    }

    function pubMed()
    {
        if (session()->has('email')) {
            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid' && session('privilege') >= 0) {
                // return view('pubmed', ['user' => $user, 'activeMenu' => 'pubMed', 'contentType' => 'pubMed']);
                return view('pages.pubmed', ['user' => $user, 'activeMenu' => 'pubMed', 'contentType' => 'pubMed']);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'pubMed', 'activeMenu' => 'pubMed', 'message' => $message]);
            }
        } else {
            return view('signin');
        }
    }

    function submitPubMed(Request $request)
    {

        $searchWord = $request->searchWord;

        $url = "https://pubmed.ncbi.nlm.nih.gov/?term=" . $searchWord;
        return redirect()->away($url);
    }

    function copd()
    {
        if (session()->has('email')) {
            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid' && session('privilege') >= 0) {
                return view('copd', ['user' => $user, 'activeMenu' => 'copd', 'contentType' => 'copd']);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'copd', 'activeMenu' => 'copd', 'message' => $message]);
            }
        } else {
            return view('signin');
        }
    }

    function submitcopd(Request $request)
    {

        $email = session('email');
        $user = DB::table('users')->where('email', $email)->get()->first();
        $userName = $user->name;
        $gdcNumber = $request->gdcNumber;

        // Get an array of checked checkboxes
        $checkedCheckboxes = $request->input('checkboxes', []);

        // $checkedCheckboxes will contain an array of checked checkboxes.

        $value = '';
        // You can loop through the checked checkboxes and do whatever you need to do.
        for ($i = 0; $i < count($checkedCheckboxes); $i++) {
            if ($value != '') {
                $value = $value . ", " . $checkedCheckboxes[$i];
            } else {
                $value = $checkedCheckboxes[$i];
            }
        }

        $message =
            "Hello \n\nEmail: " . $email .
            "\n\nUsername: " . $userName .
            "\n\nGDC Number: " . $gdcNumber .
            "\n\nThe user has completed all the tasks and marked as complete in the CPD form" .
            "\n\n The list of tasks marked are " . "\n\n" . $value;

        $fromEmail = 'noreply@dentistryinanutshell.com';
        $toEmail = 'dianclubltd@gmail.com';
        $subject = "Received a response from CPD!";

        $this->mailnow($message, $fromEmail, $toEmail, $subject, "DIAN");

        return redirect("profile")->with('success', 'CPD submitted successfully');
    }

    function setupProfile()
    {
        if (session()->has('email')) {
            // return view('setupProfile');
            return view('pages.setupProfile');
        } else {
            return redirect('signin');
        }
    }

    function profile()
    {
        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();
            if ($user->status == 'paid') {

                if ($user->firstName == '-' && $user->lastName == '-') {
                    return redirect('welcome');
                } else {
                    $subscription = DB::table('subscriptions')->where('userEmail', $email)->get()->first();
                    // $startDate = $subscription->startDate;
                    $startDate = Carbon::createFromTimestamp($subscription->startDate ?? '')->format('d-m-Y');

                    // $startDate =
                    //     gmdate("d-m-Y", $startDate);

                    // echo $startDate;
                    $endDate =
                        date('d-m-Y', strtotime($startDate . ' + 30 days'));

                    $now = time();
                    $noOfDays = strtotime($endDate) - $now;
                    $noOfDays =
                        round($noOfDays / (60 * 60 * 24));

                    // echo '-----';
                    // echo round($noOfDays / (60 * 60 * 24));
                    // echo '-----';

                    $startDateExplode = explode('-', $startDate);

                    // $plan = DB::table('plans')->where('id', $subscription->planId)->get()->first();

                    // if ($plan->name == 'starter' || $plan->name == 'student' || $plan->name == 'premium') {
                    //     $autoRenewelDate = $startDateExplode[0] . 'th of every month';
                    // } else {
                    //     $monthName = date("F", mktime(0, 0, 0, $startDateExplode[1], 1));
                    //     $autoRenewelDate = $startDateExplode[0] . 'th of ' . $monthName . ' every year';
                    // }

                    $message = '';
                    $checkList = DB::table('checkLists')->where('userEmail', $email)->get()->first();

                    if ($checkList != '') {
                        $checkListStatus = $checkList->checkList;
                    } else {
                        $checkListStatus = 0;
                    }

                    $cpdLists = [];
                    $reels = DB::table('reels')->get('name')->all();
                    $podcasts = DB::table('podcasts')->get('name')->all();

                    for ($i = 0; $i < count($reels); $i++) {
                        array_push($cpdLists, $reels[$i]);
                    }

                    for ($i = 0; $i < count($podcasts); $i++) {
                        array_push($cpdLists, $podcasts[$i]);
                    }

                    $status = "active";

                    if ($user->status == "cancelled") {
                        $status = "cancelled";
                    }

                    if ($user->privilege == 0) {
                        $subscriptionPlan = 'Starter';
                    } else if ($user->privilege == 1) {
                        $subscriptionPlan = 'Student';
                    } else if ($user->privilege == 2) {
                        $subscriptionPlan = 'Premium';
                    } else {
                        $subscriptionPlan = 'ADMIN';
                    }

                    // return view('profile', ['autoRenewelDate' => $autoRenewelDate, 'subscriptionPlan' => $subscriptionPlan, 'status' => $status, 'cpdLists' => $cpdLists, 'checkListStatus' => $checkListStatus, 'message' => $message, 'user' => $user, 'startDate' => $startDate, 'endDate' => $endDate, 'noOfDays' => $noOfDays]);
                    // return view('pages.profile', ['autoRenewelDate' => $autoRenewelDate, 'subscriptionPlan' => $subscriptionPlan, 'status' => $status, 'cpdLists' => $cpdLists, 'checkListStatus' => $checkListStatus, 'message' => $message, 'user' => $user, 'startDate' => $startDate, 'endDate' => $endDate, 'noOfDays' => $noOfDays]);
                    return view('pages.profile', ['subscriptionPlan' => $subscriptionPlan, 'status' => $status, 'cpdLists' => $cpdLists, 'checkListStatus' => $checkListStatus, 'message' => $message, 'user' => $user, 'startDate' => $startDate, 'endDate' => $endDate, 'noOfDays' => $noOfDays]);
                }
            } else {
                return redirect('subscription-plans');
            }
        } else {
            return view('signin');
        }
    }

    function editProfile()
    {
        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();
            if ($user->status == 'paid') {

                if ($user->firstName == '-' && $user->lastName == '-') {
                    return redirect('welcome');
                } else {
                    $subscription = DB::table('subscriptions')->where('userEmail', $email)->get()->first();
                    // $startDate = $subscription->startDate;
                    // $startDate = Carbon::createFromTimestamp($subscription->startDate)->format('d-m-Y');

                    // $startDate =
                    //     gmdate("d-m-Y", $startDate);

                    // echo $startDate;
                    // $endDate = date('d-m-Y', strtotime($startDate . ' + 30 days'));

                    // $now = time();
                    // $noOfDays = strtotime($endDate) - $now;
                    // $noOfDays =
                    //     round($noOfDays / (60 * 60 * 24));

                    // echo '-----';
                    // echo round($noOfDays / (60 * 60 * 24));
                    // echo '-----';

                    // $startDateExplode = explode('-', $startDate);

                    // $plan = DB::table('plans')->where('id', $subscription->planId)->get()->first();

                    // if ($plan->name == 'starter' || $plan->name == 'student' || $plan->name == 'premium') {
                    //     $autoRenewelDate = $startDateExplode[0] . 'th of every month';
                    // } else {
                    //     $monthName = date("F", mktime(0, 0, 0, $startDateExplode[1], 1));
                    //     $autoRenewelDate = $startDateExplode[0] . 'th of ' . $monthName . ' every year';
                    // }

                    $message = '';
                    $checkList = DB::table('checkLists')->where('userEmail', $email)->get()->first();

                    if ($checkList != '') {
                        $checkListStatus = $checkList->checkList;
                    } else {
                        $checkListStatus = 0;
                    }

                    $cpdLists = [];
                    $reels = DB::table('reels')->get('name')->all();
                    $podcasts = DB::table('podcasts')->get('name')->all();

                    for ($i = 0; $i < count($reels); $i++) {
                        array_push($cpdLists, $reels[$i]);
                    }

                    for ($i = 0; $i < count($podcasts); $i++) {
                        array_push($cpdLists, $podcasts[$i]);
                    }

                    $status = "active";

                    if ($user->status == "cancelled") {
                        $status = "cancelled";
                    }

                    if ($user->privilege == 0) {
                        $subscriptionPlan = 'Starter';
                    } else if ($user->privilege == 1) {
                        $subscriptionPlan = 'Student';
                    } else if ($user->privilege == 2) {
                        $subscriptionPlan = 'Premium';
                    } else {
                        $subscriptionPlan = 'ADMIN';
                    }

                    return view('pages.edit-profile', ['subscriptionPlan' => $subscriptionPlan, 'status' => $status, 'cpdLists' => $cpdLists, 'checkListStatus' => $checkListStatus, 'message' => $message, 'user' => $user]);
                }
            } else {
                return redirect('subscription-plans');
            }
        } else {
            return view('signin');
        }
    }

    function singleBlog(Request $request)
    {
        if (session()->has('email')) {
            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if (session('privilege') >= 0) {

                if ($request->has('blogId')) {

                    $blogId = $request->blogId;
                    $blogs = DB::table('blogs')->where('id', $blogId)->get()->first();
                    $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'blogs')->get();
                    // return $blogs;
                    return view('pages.single_blog', ['user' => $user, 'blogs' => $blogs, 'hashtags' => $hashtags, 'activeMenu' => 'blogs', 'contentType' => 'blogs']);
                    // return view('singleBlog', ['user' => $user, 'blogs' => $blogs, 'hashtags' => $hashtags, 'activeMenu' => 'blogs', 'contentType' => 'blogs']);
                }
            }
        } else {
            return view('signin');
        }
    }

    function blogs()
    {
        $blogs = DB::table('blogs')->get()->reverse();

        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if (session('privilege') >= 0) {

                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'blogs')->get();
                return $hashtags;
                // return view('blogs', ['user'=>$user, 'blogs' => $blogs, 'hashtags' => $hashtags, 'activeMenu'=>'blogs', 'contentType'=>'blogs']);
            }
        } else {
            return view('signin');
        }
    }

    function allBlogs()
    {
        $firstHashtag = DB::table('hashtags')->where('nameOfContentSection', 'blogs')->get()->first();
        $blogs = DB::table('blogs')->where('hashtagId', $firstHashtag->id)->get()->all();
        $hashtagValue = $firstHashtag->nameOfHashtag;

        if (session()->has('email')) {
            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();
            if (session('privilege') >= 0) {
                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'blogs')->get();
                // return view('hashtagFilter', ['user' => $user, 'finalReels' => $blogs, 'hashtags' => $hashtags, 'activeMenu' => 'blogs', 'selectedHashtagValue' => $hashtagValue]);
                return view('pages.hashtag_filter', ['user' => $user, 'finalReels' => $blogs, 'hashtags' => $hashtags, 'activeMenu' => 'blogs', 'selectedHashtagValue' => $hashtagValue]);
                // return view('blogs', ['user'=>$user, 'blogs' => $blogs, 'hashtags' => $hashtags, 'activeMenu'=>'blogs', 'contentType'=>'blogs']);

            }
        } else {
            return view('signin');
        }
    }

    function workFlows()
    {
        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid' && session('privilege') >= 1) {
                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'workFlows')->get();

                $agent = new Agent();

                if ($agent->isMobile()) {
                    $firstHashtag = DB::table('hashtags')->where('nameOfContentSection', 'workFlows')->get()->first();
                    $workFlows = DB::table('workFlows')->where('hashtagId', $firstHashtag->id)->get()->reverse();
                    $hashtagValue = $firstHashtag->nameOfHashtag;

                    return view('hashtagFilter', ['user' => $user, 'finalReels' => $workFlows, 'hashtags' => $hashtags, 'activeMenu' => 'workFlows', 'selectedHashtagValue' => $hashtagValue]);
                    // return view('workFlows', ['user'=>$user, 'hashtags' => $hashtags,'activeMenu' => 'workFlows','contentType'=>'workFlows']);
                } else {
                    return view('noDesktopAccess', ['user' => $user, 'activeMenu' => 'workFlows', 'contentType' => 'workFlows']);
                }
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'workFlows', 'activeMenu' => 'workFlows', 'message' => $message]);
            }
        } else {
            return view('signin');
        }
    }
}
