<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\CarbonInterval;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AssistController extends Controller
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

    function saveSpeechToText(Request $request)
    {

        $user = $request->user();

        $token = $request->bearerToken();
        $data = $request->data;
        if ($data) {

            $timestamp = date('Y-m-d H:i:s', time());
            $newPatientNotes = DB::table('saved_speech_to_text')->insert([
                'userId' => $user->id,
                'data' => $data,
                'created_at' => $timestamp
            ]);

            if ($newPatientNotes) {
                return response()->json([
                    'status' => true,
                    'message' => 'Record Added Succesfully',
                    'token' => $token
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Something Went Wrong !',
                    'token' => $token
                ], 400);
            }
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Data not provided !!',
                'token' => $token
            ], 400);
        }
    }

    public function getSpeechToTextNotes(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        if ($user) {
            if ($user->status == 'paid' && $user->privilege >= 2) {
                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'assist-app')->get();

                $savedSpeechTexts = DB::table('saved_speech_to_text')
                    ->where('userId', $user->id)
                    ->get();

                return response()->json([
                    'status' => true,
                    'message' => 'Success',
                    'savedSpeechTexts' => $savedSpeechTexts,
                    'hashtags' => $hashtags,
                    'token' => $token
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Upgrade your subscription to access this feature',
                    'token' => $token
                ], 403);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
    }

    public function patientExplainerVideos(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        if ($user) {
            if ($user->status == 'paid' && $user->privilege >= 2) {
                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'assist-app')->get();

                $assists = DB::table('assists')->get()->all();

                foreach ($assists as &$assist) {

                    $videoId = $this->getVimeoVideoId($assist->url);
                    if ($videoId) {
                        $assist->url = $this->getVimeoAuthenticatedUrl($videoId);
                    }

                    $baseUrl = 'https://www.dentistryinanutshell.com/dian/public/images/videos_thumbnails/';

                    $assist->thumbnail = ($assist->thumbnail != null && $assist->thumbnail != '') ? $baseUrl . $assist->thumbnail : null;
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Success',
                    'data' => $assists,
                    'hashtags' => $hashtags,
                    'token' => $token
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Upgrade your subscription to access this feature',
                    'token' => $token
                ], 403);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
    }

    public function emailTemplate(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        if ($user->status == 'paid' && $user->privilege >= 2) {
            $emailTemplates = DB::table('email_templates')->get();

            return response()->json([
                'success' => true,
                'emailTemplates' => $emailTemplates,
                'token' => $token
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Upgrade your subscription to access this page',
                'token' => $token
            ], 403);
        }
    }

    public function saveEmailTemplateVideo(Request $request)
    {
        if ($request->hasFile('video') && $request->file('video')->isValid()) {
            try {
                $user = $request->user();
                $token = $request->bearertoken();
                $userId = $user->id;
                $timestamp = time();
                $videoFile = $request->file('video');
                $uploadPath = 'storage/videos/' . $userId . '/';
                $videoName = 'video.' . $timestamp . '.' . 'webm';

                // Store the video file in the 'uploads' directory using Laravel's Storage
                $videoFile->storeAs($uploadPath, $videoName);

                $videoLink = "https://www.dentistryinanutshell.com/dian/storage/app/$uploadPath$videoName";
                // $videoLink = 'https://dentistryinanutshell.com/dev_test/dentistry/storage/app/'. $uploadPath. $videoName;
                // $videoLink = 'https://dentistryinanutshell.com/dian/storage/app/'. $uploadPath. $videoName;

                return response()->json([
                    'status' => true,
                    'message' => 'Video saved successfully.',
                    'videoLink' => $videoLink,
                    'token' => $token
                ], 200);
            } catch (\Exception $e) {
                // Handle any exceptions that may occur during file storage
                return response()->json(['error' => 'Error saving video.']);
            }
        } else {
            // Invalid file or no file provided
            return response()->json(['error' => 'Invalid video file.']);
        }
    }

    public function sendEmailTemplate(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();
        if ($request->dentistName && $request->dentistEmail && $request->patientName && $request->patientEmail) {

            $dentistName = $request->dentistName;
            $dentistEmail = $request->dentistEmail;
            $patientName = $request->patientName;
            $patientEmail = $request->patientEmail;
            $practiceEmail = $request->practiceEmail;
            $subject = $request->subject;
            $videoLink = $request->videoLink;

            if ($videoLink) {
                $message = "Dear " . $patientName . ",\n\nI hope this email finds you well. It was lovely speaking to you. Please find the requested information in the email below.\n\n" . $request->emailContent . "\n\nFor more information check the video link given below." . "\n\n" . $videoLink . "\n\nWishing you good dental health and a bright, confident smile!\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nWarm regards,\n" . $dentistName . "\nTitle\nDental Practice\n" . $dentistEmail;

                $this->mailnow($message, $patientEmail, $patientName, $subject);
                return response()->json([
                    'status' => true,
                    'message' => 'Mail Send Successfully',
                    'token' => $token
                ], 200);
            }

            $message = "Dear " . $patientName . ",\n\nI hope this email finds you well. It was lovely speaking to you. Please find the requested information in the email below.\n\n" . $request->emailContent . "\n\nWishing you good dental health and a bright, confident smile!\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nWarm regards,\n" . $dentistName . "\n" . $dentistEmail;

            $this->mailnow($message, $patientEmail, $patientName, $subject);
            $this->mailnow($message, $dentistEmail, $dentistName, $subject);
            $this->mailnow($message, $practiceEmail, $dentistName, $subject);
            return response()->json([
                'status' => true,
                'message' => 'Mail Send Successfully',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Pass All Parameters',
                'token' => $token
            ], 403);
        }
    }

    public function mailNow($message, $to, $patientName, $subject)
    {

        $dianKey = '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';

        $email = new \SendGrid\Mail\Mail();
        $email->setfrom("noreply@dentistryinanutshell.com", "DIAN");
        $email->setSubject($subject);
        $email->addto($to, $patientName);
        $email->addContent("text/plain", $message);

        $sendgrid = new \SendGrid($dianKey);
        $sendgrid->send($email);

        // try {
        //     $response = $sendgrid->send($email);

        //     print $response->statusCode() . "\n";
        //     print_r($response->headers());
        //     print $response->body() . "\n";
        // } catch (\Exception $e) {
        //     echo 'Caught exception: ' . $e->getMessage() . "\n";
        // }
    }
}
