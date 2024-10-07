<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;
use Illuminate\Support\Facades\Storage;
use File;
use Carbon\Carbon;

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
class VideoRecorderController extends Controller
{
    public function showRecorder()
    {
        return view('video_recorder');
    }

    public function saveVideo(Request $request)
    {
        if ($request->hasFile('video') && $request->file('video')->isValid()) {
            try {
                $email = session('email');
                $user = DB::table('users')->where('email', $email)->get()->first();
                $userId = $user->id;
                $timestamp = time();
                $videoFile = $request->file('video');
                $uploadPath = 'storage/videos/' . $userId . '/';
                $videoName = 'video.' . $timestamp . 'webm';

                // Store the video file in the 'uploads' directory using Laravel's Storage
                $videoFile->storeAs($uploadPath, $videoName);

                // chmod("storage/videos",0755);
                // chmod("storage/videos/".$userId,0755);
                // chmod("storage/videos/".$userId."/".$videoName,0755);

                //$videoLink = Storage::url($uploadPath . $videoName);
                // $videoLink = 'http://localhost/dentistry/storage/app/' . $uploadPath . $videoName;
                // $videoLink = 'https://dentistryinanutshell.com/dev_test/dentistry/storage/app/'. $uploadPath. $videoName;
                $videoLink = 'https://dentistryinanutshell.com/dian/storage/app/'. $uploadPath. $videoName;
                // dd($videoLink);
                // $_SESSION['currentVideoLink'] = $videoLink;
                session(['currentVideoLink' => $videoLink]);

                return response()->json(['message' => 'Video saved successfully.', 'videoLink' => $videoLink]);
            } catch (\Exception $e) {
                // Handle any exceptions that may occur during file storage
                return response()->json(['error' => 'Error saving video.']);
            }
        } else {
            // Invalid file or no file provided
            return response()->json(['error' => 'Invalid video file.']);
        }
    }
    // public function saveVideo(Request $request)
    // {
    //     if ($request->hasFile('video')) {
    //         $video = $request->file('video');
    //         $video->storeAs('videos', 'recorded-video.webm'); // Store in the public/videos directory
    //         return response()->json(['message' => 'Video saved successfully.']);
    //     } else {
    //         return response()->json(['message' => 'Error saving the video.'], 500);
    //     }
    // }



    public function saveVideo2()
    {
        dd("Hello World!");
    }
}
