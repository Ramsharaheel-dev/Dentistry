<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

class ForumController extends Controller
{

    // public function Forum()
    // {
    //     try {


    //         return view('pages.forum');

    //     } catch (\Throwable $th) {

    //         throw $th;
    //     }
    // }

    function forums()
    {
        if (session()->has('email')) {
            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();
            $questions = DB::table('categories')->get()->reverse();
            // return view('forum', ['user'=>$user, 'questions' => $questions,'activeMenu' => 'forums']);
            return view('pages.forum_old', ['user' => $user, 'questions' => $questions, 'activeMenu' => 'forums']);
        } else {
            return view('signin');
        }
    }

    function index()
    {
        return 'index';
    }
    function threads()
    {
        return 'threads';
    }

    function askQuestion()
    {
        $user = DB::table('users')->where('email', session('email'))->get()->first();
        if (session('privilege')>= 1) {
            return view('askQuestion');
        } else {
            $message = 'Upgrade your subcription to access this page';
            return view('noSubscriptionAccess', ['user' => $user, 'contentType' => 'forums', 'activeMenu' => 'forums', 'message' => $message]);
        }
    }

    function submitQuestion(Request $request)
    {
        if (session()->has('email')) {

            $email = session('email');
            $question = $request->question;
            $content = $request->content;

            $activeUser = DB::table('users')->where('email', $email)->get()->first();

            $new = DB::table('categories')->insert([
                'userId' => $activeUser->id,
                'userProfile' => $activeUser->profilePic,
                'question' => $question,
                'content' => $content
            ]);

            $name = $activeUser->name;

            $question = DB::table('categories')->where('userId', $activeUser->id)->where('question', $question)->where('content', $content)->get()->first();

            $questionId = $question->id;

            $url = 'https://www.dentistryinanutshell.com/dian/public/single-category/' . $questionId;
            // $url = 'https://test.dentistryinanutshell.com/lara/dev/dian/public/single-category/'.$questionId;

            $emailMessage = "Hi Admin,\n\nYou have received a question from " . $name . "\n\nFor Further information please check Forums page " . $url . "\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

            $toEmail = 'noreply@dentistryinanutshell.com';
            $subject = "Received a Question in Forum!";
            $ccemails = DB::table('users')->where('privilege','3')->get()->all();

            $this->mailnow($emailMessage, $toEmail, $subject, 'Admin', $ccemails);

            return redirect('forums');
        } else {
            return view('signin');
        }
    }

    function singleCategory($questionId)
    {
        if (session()->has('email')) {

            $email = session('email');
            $question = DB::table('categories')->where('id', $questionId)->get()->first();

            $userId = $question->userId;

            $user = DB::table('users')->where('id', $userId)->get()->first();
            // $user = DB::table('users')->where('email', session('email'))->get()->first();

            // dd($user);

            $threads = DB::table('threads')->where('userId', $userId)->where('questionId', $questionId)->get();

            $currentUser = DB::table('users')->where('email', $email)->get()->first();

            if (session('privilege') >= 1) {
                // return view('singleCategory', ['privilege' => $currentUser->privilege, 'status' => $currentUser->status, 'question' => $question, 'questionId' => $questionId, 'user' => $user, 'threads' => $threads]);
                return view('pages.single_category', ['privilege' => $currentUser->privilege, 'status' => $currentUser->status, 'question' => $question, 'questionId' => $questionId, 'user' => $user, 'threads' => $threads]);
            } else {
                return view('singleCategoryFree', ['privilege' => $currentUser->privilege, 'status' => $currentUser->status, 'question' => $question, 'questionId' => $questionId, 'user' => $user, 'threads' => $threads]);
            }
        } else {
            return view('signin');
        }
    }

    function deleteForumQuestion($questionId)
    {

        $question = DB::table('categories')->where('id', $questionId)->delete();

        return redirect('forums');
    }

    function submitThread(Request $request)
    {
        $content = $request->content;
        $userId = $request->userId;
        $questionId = $request->questionId;
        $email = session('email');

        $user = DB::table('users')->where('id', $userId)->get()->first();

        $userName = $user->firstName . ' ' . $user->lastName;
        $userProfile = $user->profilePic;

        $newThread = DB::table('threads')->insert([
            'questionId' => $questionId,
            'userId' => $userId,
            'userName' => $userName,
            'userProfile' => $userProfile,
            'content' => $content
        ]);

        $url = 'https://www.dentistryinanutshell.com/dian/public/single-category/' . $questionId;

        // $url = 'https://test.dentistryinanutshell.com/lara/dev/dian/public/single-category/'.$questionId;

        $emailMessage = "Hi " . $userName . ",\n\nI hope this email finds you well. It was lovely speaking to you. Please find the requested information in the email below.\n\nYou have received response to your question.\n\nFor Further information please check Forums page " . $url . "\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

        $fromEmail = 'noreply@dentistryinanutshell.com';
        $toEmail = $email;
        $subject = "Received a Response!";

        $this->mailnow($emailMessage, $toEmail, $subject, $userName, '-');

        return redirect()->back();
    }

    public function mailNow($message, $toEmail, $subject, $userName, $ccemails)
    {

        $dianKey = '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';

        $email = new \SendGrid\Mail\Mail();
        $email->setfrom('noreply@dentistryinanutshell.com', "DIAN");
        $email->setSubject($subject);
        if ($ccemails == '-') {
            $email->addto($toEmail, $userName);
        } else {
            foreach ($ccemails as $ccemail) {
                $email->addto($ccemail->email, $userName);
            }
        }

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
