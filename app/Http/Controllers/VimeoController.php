<?php
// app/Http/Controllers/VideoController.php

namespace App\Http\Controllers;

use App\Models\Assist;
use App\Models\BusinessAndFinance;
use App\Models\HealthAndWellbeing;
use App\Models\Podcast;
use App\Models\Reel;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\VimeoService;
use Carbon\CarbonInterval;
use GuzzleHttp\Client;
use getID3;

class VimeoController extends Controller
{
    protected $vimeo;

    public function __construct(VimeoService $vimeo)
    {
        $this->vimeo = $vimeo;
    }

    public function secondsToHMS($seconds)
    {
        $interval = CarbonInterval::seconds($seconds);

        return $interval->cascade()->format('%H:%I:%S');
    }

    public function index()
    {
        if (session()->has('cms_login')) {
            return view('cms.videos_upload');
        } else {
            return redirect()->route('cms.login');
        }
    }

    public function upload(Request $request)
    {
        $videoFile = $request->file('video');
        $thumbnailFile = $request->file('thumbnail');
        $title = $request->input('title');
        $description = $request->input('description', '');
        $selectedPage = $request->input('selected_page');
        $selectedCategory = $request->input('selected_category_id');

        $videoPath = $videoFile->getPathName();

        // Retrieve the video duration using getID3
        $getID3 = new getID3;
        $videoInfo = $getID3->analyze($videoPath);

        if (isset($videoInfo['playtime_seconds'])) {
            $durationInSeconds = $videoInfo['playtime_seconds'];
            $formattedDuration = $this->secondsToHMS($durationInSeconds);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve video duration.'
            ]);
        }

        $videoResponse = $this->vimeo->uploadVideo($videoPath, $title, $description);

        if (isset($videoResponse['error'])) {
            return response()->json([
                'status' => false,
                'message' => $videoResponse['error']
            ]);
        }

        $videoUri = $videoResponse['uri'];
        $videoId = $this->vimeo->getVideoIdFromUri($videoUri);

        // Save thumbnail with a unique name in the public directory
        $uniqueName = uniqid() . '.' . $thumbnailFile->getClientOriginalExtension();
        $thumbnailFile->move(public_path('images/videos_thumbnails'), $uniqueName);

        $thumbnailResponse = $this->vimeo->uploadThumbnail($videoUri, public_path('images/videos_thumbnails') . '/' . $uniqueName);

        if (isset($thumbnailResponse['error'])) {
            return response()->json([
                'status' => false,
                'message' => $thumbnailResponse['error']
            ]);
        }

        $privacyResponse = $this->vimeo->setVideoPrivacy($videoId, 'disable');

        if (isset($privacyResponse['error'])) {
            return response()->json([
                'status' => false,
                'message' => $privacyResponse['error']
            ]);
        }

        // Add domains to the whitelist
        $allowedDomains = ['dentistryinanutshell.com', '*dentistryinanutshell.com']; // Your allowed domains
        $whitelistResponse = $this->vimeo->addDomainsToWhitelist($videoId, $allowedDomains);

        if (isset($whitelistResponse['error'])) {
            return response()->json([
                'status' => false,
                'message' => $whitelistResponse['error']
            ]);
        }
        // Construct the Vimeo player link
        $videoLink = "https://player.vimeo.com/video/{$videoId}";

        // Dynamically save video info to the correct table based on selected page
        switch ($selectedPage) {
            case 'reels':
                $video = new Reel;
                $video->name = $title;
                $video->hashtagId = $selectedCategory;
                $video->duration = $formattedDuration;
                $video->thumbnail = $uniqueName;
                break;
            case 'podcasts':
                $video = new Podcast;
                $video->name = $title;
                $video->hashtagId = $selectedCategory;
                $video->duration = $formattedDuration;
                $video->thumbnail = $uniqueName;
                break;
            case 'businessAndFinances':
                $video = new BusinessAndFinance;
                $video->name = $title;
                $video->hashtagId = $selectedCategory;
                $video->thumbnail = $uniqueName;
                break;
            case 'healthAndWellbeing':
                $video = new HealthAndWellbeing;
                $video->name = $title;
                $video->hashtagId = $selectedCategory;
                $video->thumbnail = $uniqueName;
                break;
            case 'assist-app':
                $video = new Assist;
                $video->name = $title;
                $video->hashtagId = '21';
                $video->thumbnail = $uniqueName;
                break;
            case 'students':
                $video = new Student;
                $video->hashtagId = $selectedCategory;
                $video->name = ($selectedCategory === '32') ? "Videos" : "Wellbeing";
                $video->thumbnailName = $uniqueName;
                break;
            default:
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid page selected.'
                ]);
        }

        $video->url = $videoLink;
        $video->save();

        return response()->json([
            'status' => true,
            'message' => 'Video and thumbnail uploaded successfully!',
            'video_link' => $videoLink,
            'duration' => $formattedDuration,
            'thumbnail' => $uniqueName
        ]);
    }
}
