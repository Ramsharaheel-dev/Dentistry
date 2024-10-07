<?php

namespace App\Http\Controllers;

use App\Mail\SendUserEmail;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserRelation;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \SendGrid\Mail\Mail;
use \SendGrid;

class UserController extends Controller
{

    public function __construct()
    {
        session(['email' => 'hancockghostwriters@gmail.com']);
        session(['signin1' => 'yes']);
        session(['username' => 'UI']);
        session(['privilege' => '9']);
    }

    public function secondsToHMS($seconds)
    {
        $interval = CarbonInterval::seconds($seconds);

        return $interval->cascade()->format('%H:%I:%S');
    }

    public function manageUsers()
    {
        if (session()->has('email')) {

            $email = session('email');
            $loginUser = User::where('email', $email)->first();
            $loginUserId = $loginUser->id;

            $createdUsers = UserRelation::with('user')
                ->where('created_by', $loginUserId)
                ->get();

            return view('pages.manage-users', compact('createdUsers'));
        } else {
            return view('pages.manage-users');
        }
    }

    public function storeUser(Request $request)
    {
        $email = session('email');
        $loginUser = User::where('email', $email)->first();

        $userCount = User::where('created_by', $loginUser->id)->count();

        $maxUserLimit = 5;

        if ($userCount >= $maxUserLimit) {
            return response()->json([
                'status' => false,
                'message' => 'User creation limit reached',
                'data' => [],
                'error' => []
            ], 422);
        }

        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
        ]);

        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return [
                'status' => false,
                'message' => 'Email already exists',
                'data' => [],
                'error' => []
            ];
        }

        $fullName = $request->firstName . ' ' . $request->lastName;
        $email = $request->email;


        $user = User::create([
            'name' => $fullName,
            'email' => $request->email,
            'gid' => '-',
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'profilePic' => '-',
            'statement' => '-',
            'statementOne' => '-',
            'statementTwo' => '-',
            'statementThree' => '-',
            'status' => 'paid',
            'privilege' => 2,
            'designation' => $request->designation,
            'created_by' => $loginUser->id
        ]);

        UserRelation::create([
            'created_by' => $loginUser->id,
            'user_id' => $user->id,
            'designation' => $user->designation,
        ]);

        $subscriptionDetails = Subscription::where('userEmail', $loginUser->email)->first();

        if ($subscriptionDetails->planId == 9) {
            $userPlanId = 5;
        } elseif ($subscriptionDetails->planId == 11) {
            $userPlanId = 8;
        }

        $subscription = DB::table('subscriptions')->insert([
            'subscriptionId' => $subscriptionDetails->subscriptionId,
            'userEmail' => $email,
            'customerId' => $subscriptionDetails->customerId,
            'planId' => $userPlanId,
            'startDate' => $subscriptionDetails->startDate,
            'status' => 'active'
        ]);

        $fullNameEmail =  $request->firstName . '_' . $request->lastName;

        $message = "I hope this email finds you well. You were added to Dentistry in a Nutshell, please click on the following link to set up your account.\n\nThanks DIAN Club\n\n Please Click on this link to proceed https://dentistryinanutshell.com/dian/public/signin";
        $subject = "You are added in dentistry with this Email";

        $this->mailnow($message, $email, $fullNameEmail, $subject);

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'User added successfully',
                'data' => [],
                'error' => []
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to add User',
            'data' => [],
            'error' => []
        ], 422);
    }


    public function mailNow($message, $to, $fullName, $subject)
    {
        $dianKey = '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';

        $email = new Mail();
        $email->setFrom("noreply@dentistryinanutshell.com", "DIAN");
        $email->setSubject($subject);
        $email->addTo($to, $fullName);
        $email->addContent("text/plain", $message);

        $sendgrid = new SendGrid($dianKey);
        $sendgrid->send($email);
        // try {
        //     $response = $sendgrid->send($email);

        //     // Check if the email was successfully sent
        //     if ($response->statusCode() == 202) {
        //         echo 'Email sent successfully.';
        //     } else {
        //         echo 'Failed to send email. Status Code: ' . $response->statusCode();
        //     }
        // } catch (\Exception $e) {
        //     echo 'Caught exception: ' . $e->getMessage() . "\n";
        // }
    }


    public function mailNow2()
    {
        $dianKey = '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';

        $email = new \SendGrid\Mail\Mail();
        $email->setfrom("noreply@dentistryinanutshell.com", "DIAN");
        $email->setSubject("hello world");
        $email->addto('asadshoaibkhokhar@gmail.com', 'asad');
        $email->addContent("text/plain", 'test message');

        $sendgrid = new \SendGrid($dianKey);

        try {
            $response = $sendgrid->send($email);
            dd($response);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (\Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }

    public function userDashboard()
    {
        try {
            return view('require_2.user_sidebar');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
