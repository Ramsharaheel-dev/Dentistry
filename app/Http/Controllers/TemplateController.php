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

class TemplateController extends Controller
{

    function allTemplates()
    {

        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();
            $userId = $user->id;

            if ($user->status == 'paid' && $user->privilege >= 2) {

                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'assist')->get();

                $allTemplates = DB::table('filters')->get()->all();

                $savedTemplates = DB::table('patient_notes')->where('userId', $userId)->get()->all();

                // return view('allTemplates', ['user' => $user, 'hashtags' => $hashtags, 'allTemplates' => $allTemplates, 'savedTemplates' => $savedTemplates]);
                return view('pages.templates', ['user' => $user, 'hashtags' => $hashtags, 'allTemplates' => $allTemplates, 'savedTemplates' => $savedTemplates]);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'podcasts', 'activeMenu' => 'podcast', 'message' => $message]);
            }
        } else {
            return redirect('signin');
        }
    }

    function templateNotes(Request $request)
    {

        if ($request->templateName) {
            if (session()->has('email')) {

                $email = session('email');

                $templateName = $request->templateName;
                $templateId = $request->templateId;

                $user = DB::table('users')->where('email', $email)->get()->first();

                if ($user->status == 'paid' && $user->privilege >= 2) {

                    if ($request->data) {

                        $data = $request->data;
                        return redirect()->route('displaySavedPatientNotes', ['templateId' => $templateId]);
                    } else {
                        //return $templateName;
                        return redirect()->route('patientNotes', ['templateId' => $templateId]);
                    }

                    // return view('page1',['user'=>$user,'data'=>json_decode($data,true),'templateId'=>$templateId,'templateName'=>$templateName]);
                } else {
                    $message = 'Upgrade your subcription to access this page';
                    return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'podcasts', 'activeMenu' => 'podcast', 'message' => $message]);
                }
            } else {
                return redirect('signin');
            }
        } else {
            return redirect()->back();
        }
    }

    function patientNotes($templateId)
    {

        if (session()->has('email')) {

            $email = session('email');

            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid' && $user->privilege >= 2) {

                $template = DB::table('filters')->where('id', $templateId)->get()->first();
                $data = $template->content;
                $templateId = $template->id;
                $templateName = $template->title;

                // return view('patientNotesTemplate', ['user' => $user, 'data' => json_decode($data, true), 'templateId' => $templateId, 'templateName' => $templateName]);
                return view('pages.patient_notes_template', ['user' => $user, 'data' => json_decode($data, true), 'templateId' => $templateId, 'templateName' => $templateName]);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'podcasts', 'activeMenu' => 'podcast', 'message' => $message]);
            }
        } else {
            return redirect('signin2');
        }
    }

    function patientNotes2($templateId)
    {
        if (session()->has('email')) {

            $email = session('email');

            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid' && $user->privilege >= 2) {

                $template = DB::table('filters')->where('id', $templateId)->get()->first();
                $data = $template->content;
                $templateId = $template->id;
                $templateName = $template->title;

                return view('patientNotesTemplate', ['user' => $user, 'data' => json_decode($data, true), 'templateId' => $templateId, 'templateName' => $templateName]);
                // return view('pages.patient_notes_template', ['user' => $user, 'data' => json_decode($data, true), 'templateId' => $templateId, 'templateName' => $templateName]);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'podcasts', 'activeMenu' => 'podcast', 'message' => $message]);
            }
        } else {
            return redirect('signin2');
        }
    }


    function displaySavedPatientNotes($templateId)
    {

        if (session()->has('email')) {

            $email = session('email');

            $user = DB::table('users')->where('email', $email)->get()->first();
            $userId = $user->id;

            if ($user->status == 'paid' && $user->privilege >= 2) {

                $template = DB::table('patient_notes')->where('templateId', $templateId)->where('userId', $userId)->get()->first();
                $data = $template->data;
                $templateId = $template->templateId;
                $templateName = $template->templateName;

                // return view('displaySavedPatientNotesTemplate', ['user' => $user, 'data' => json_decode($data, true), 'templateId' => $templateId, 'templateName' => $templateName]);
                return view('pages.display_save_patient_notes', ['user' => $user, 'data' => json_decode($data, true), 'templateId' => $templateId, 'templateName' => $templateName]);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'podcasts', 'activeMenu' => 'podcast', 'message' => $message]);
            }
        } else {
            return redirect('signin2');
        }
    }


    function displaySavedPatientNotes2($templateId)
    {
        if (session()->has('email')) {

            $email = session('email');

            $user = DB::table('users')->where('email', $email)->get()->first();
            $userId = $user->id;

            if ($user->status == 'paid' && $user->privilege >= 2) {

                $template = DB::table('patient_notes')->where('templateId', $templateId)->where('userId', $userId)->get()->first();
                $data = $template->data;
                $templateId = $template->templateId;
                $templateName = $template->templateName;

                return view('displaySavedPatientNotesTemplate', ['user' => $user, 'data' => json_decode($data, true), 'templateId' => $templateId, 'templateName' => $templateName]);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'podcasts', 'activeMenu' => 'podcast', 'message' => $message]);
            }
        } else {
            return redirect('signin2');
        }
    }

    function saveSpeechToText(Request $request)
    {
        if ($request->speechToTextData) {
            $data = $request->speechToTextData;
            $email = session('email');

            $user = DB::table('users')->where('email', $email)->get()->first();
            $timestamp = date('Y-m-d H:i:s', time());
            $newPatientNotes = DB::table('saved_speech_to_text')->insert([
                'userId' => $user->id,
                'data' => $data,
                'created_at' => $timestamp
            ]);
            return redirect('assist');
        } else {
            return redirect()->back();
        }
    }


    public function fetchSpeechTextData()
    {
        if (session()->has('email')) {

            $email = session('email');
            $loginUser = User::where('email', $email)->first();
            $loginUserId = $loginUser->id;

            $createdUsers = DB::table('saved_speech_to_text')
                ->where('userId', $loginUserId)
                ->get();

            return view('pages.speech-to', compact('createdUsers'));
        } else {
            return view('pages.manage-users');
        }
    }

    function savePatientNotes(Request $request)
    {

        if ($request->templateId && $request->templateName && $request->patientNotesJson) {

            $templateId = $request->templateId;
            $templateName = $request->templateName;
            $data = $request->patientNotesJson;

            $userEmail = session('email');

            $user = DB::table('users')->where('email', $userEmail)->get()->first();

            $userId = $user->id;
            $timestamp = date('Y-m-d H:i:s', time());

            $patientNotes = DB::table('patient_notes')->where('userId', $userId)->where('templateId', $templateId)->get()->first();

            if ($patientNotes != '') {
                $newPatientNotes = DB::table('patient_notes')->where('userId', $userId)->where('templateId', $templateId)->update([
                    'userId' => $userId,
                    'templateId' => $templateId,
                    'templateName' => $templateName,
                    'data' => $data,
                    'created_at' => $timestamp
                ]);
            } else {
                $newPatientNotes = DB::table('patient_notes')->insert([
                    'userId' => $userId,
                    'templateId' => $templateId,
                    'templateName' => $templateName,
                    'data' => $data,
                    'created_at' => $timestamp
                ]);
            }

            return redirect('all-templates');
        } else {
            return redirect()->back();
        }
    }

    function deletePatientNotes()
    {
        $carbonDate = Carbon::now()->subDay();
        $thresholdDateTime = $carbonDate->format('Y-m-d H:i:s');

        $deleteNotes = DB::table('patient_notes')->where('created_at', "<=", $thresholdDateTime)->delete();

        return "success";
    }

    function speechToTextNotes()
    {
        // $_SESSION['email'] = 'raghibdev2001@gmail.com';
        if (session()->has('email')) {

            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid' && $user->privilege >= 2) {

                $hashtags = DB::table('hashtags')->where('nameOfContentSection', 'assist')->get();

                $allTemplates = DB::table('filters')->get()->all();

                $savedSpeechTexts = DB::table('saved_speech_to_text')
                    ->where('userId', $user->id)
                    ->get();

                return view('pages.speech-to-text', ['user' => $user, 'hashtags' => $hashtags, 'allTemplates' => $allTemplates, 'savedSpeechTexts' => $savedSpeechTexts]);
                // return view('speechToText', ['user'=>$user,'hashtags' => $hashtags,'allTemplates'=>$allTemplates]);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'podcasts', 'activeMenu' => 'podcast', 'message' => $message]);
            }
        } else {
            return redirect('signin');
        }
    }

    function emailTemplate()
    {
        if (session()->has('email')) {

            $email = session('email');

            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user->status == 'paid' && $user->privilege >= 2) {
                $emailTemplates = DB::table('email_templates')->get()->all();

                return view('pages.email_template', ['user' => $user, 'emailTemplates' => $emailTemplates]);
                // return view('emailTemplate',['user'=>$user,'emailTemplates'=>$emailTemplates]);
            } else {
                $message = 'Upgrade your subcription to access this page';
                return view('pages.noSubscriptionAccess', ['user' => $user, 'contentType' => 'podcasts', 'activeMenu' => 'podcast', 'message' => $message]);
            }
        } else {
            return redirect('signin');
        }
    }

    function sendPatientEmail(Request $request)
    {
        if ($request->dentistName && $request->dentistEmail && $request->patientName && $request->patientEmail) {

            $dentistName = $request->dentistName;
            $dentistEmail = $request->dentistEmail;
            $patientName = $request->patientName;
            $patientEmail = $request->patientEmail;
            $practiceEmail = $request->practiceEmail;
            // $price = $request-> price;
            $subject = $request->subject;
            // if(isset($_SESSION['currentVideoLink']))

            if (session()->has('currentVideoLink')) {
                $message = "Dear " . $patientName . ",\n\nI hope this email finds you well. It was lovely speaking to you. Please find the requested information in the email below.\n\n" . $request->emailContent . "\n\nFor more information check the video link given below." . "\n\n" . session('currentVideoLink') . "\n\nWishing you good dental health and a bright, confident smile!\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nWarm regards,\n" . $dentistName . "\nTitle\nDental Practice\n" . $dentistEmail;

                $this->mailnow($message, $patientEmail, $patientName, $subject);
                return redirect()->back()->with('success', 'Mail send successfully');
            }

            $message = "Dear " . $patientName . ",\n\nI hope this email finds you well. It was lovely speaking to you. Please find the requested information in the email below.\n\n" . $request->emailContent . "\n\nWishing you good dental health and a bright, confident smile!\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nWarm regards,\n" . $dentistName . "\n" . $dentistEmail;

            $this->mailnow($message, $patientEmail, $patientName, $subject);
            $this->mailnow($message, $dentistEmail, $dentistName, $subject);
            $this->mailnow($message, $practiceEmail, $dentistName, $subject);
            return redirect()->back()->with('success', 'Mail sent successfully');
        } else {
            return "Pass all parameters";
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

        try {
            $response = $sendgrid->send($email);

            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }
}
