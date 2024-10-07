<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use GeneaLabs\LaravelSocialiter\Facades\Socialiter;

use Laravel\Socialite\Facades\Socialite;

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

class GoogleAuthController extends Controller
{
    public function checkUserExists($currentUser)
    {
        $givenEmail = $currentUser->getEmail();
        $extensionEmail = explode('@', $givenEmail);
        $user = User::where('email', $currentUser->getEmail())->first();

        if ($user != '') {
            $userExists = TRUE;
            // echo "User exists: True all accounts";
        } else if ($extensionEmail[1] == 'gmail.com' || $extensionEmail[1] == 'googlemail.com') {

            $gmail = $extensionEmail[0] . '@gmail.com';
            $googleMail = $extensionEmail[0] . '@googlemail.com';
            $user = User::whereIn('email', [$gmail, $googleMail])->get()->first();

            if ($user != '') {
                $userExists = TRUE;
                // echo "User exists: True gmail account";
            } else {
                $userExists = FALSE;
                // echo "User exists: False gmail account";
            }
        } else {
            $userExists = FALSE;
            // echo "User exists: Flase all account";
        }

        if ($currentUser->name != null) {
            $name = $currentUser->name;
            // echo "Current user name exists".$name;
        } else {
            $name = '-';
            // echo "Current user name not exists";
        }

        $gid = $currentUser->id;
        $gid = $gid . '';
        // echo "GID: ". $gid;

        if ($userExists) {

            if ($user->status == 'not paid') {

                // $_SESSION['email'] = $currentUser->getEmail();
                session(['email' => $currentUser->getEmail()]);


                // echo "User exists but status is not paid ". $currentUser->getEmail();

                return redirect()->route('subscriptionPlans');
            } else {

                // $_SESSION['email'] = $currentUser->getEmail();

                // $_SESSION['signin1'] = 'yes';
                // $_SESSION['username'] = $name;

                // $user = DB::table('users')->where('email', $_SESSION['email'])->get()->first();
                // $_SESSION['privilege'] = $user->privilege;

                session(['email' => $currentUser->getEmail()]);
                session(['signin1' => 'yes']);
                session(['username' => $name]);

                $user = DB::table('users')->where('email', session('email'))->first();

                session(['privilege' => $user->privilege]);

                // echo "USer exists and status is paid ".$currentUser->getEmail();

                return redirect()->route('dashboard');
            }
        } else {
            $newUser = DB::table('users')->insert(
                [
                    'name' => $name,
                    'email' => $givenEmail,
                    'gid' => $gid,
                    'firstName' => '-',
                    'lastName' => '-',
                    'profilePic' => '-',
                    'statement' => '-',
                    'statementOne' => '-',
                    'statementTwo' => '-',
                    'statementThree' => '-',
                    'status' => 'not paid',
                    'privilege' => 0
                ]
            );

            // $_SESSION['email'] = $currentUser->getEmail();

            // $_SESSION['signin1'] = 'yes';
            // $_SESSION['username'] = $name;

            session(['email' => $currentUser->getEmail()]);
            session(['signin1' => 'yes']);
            session(['username' => $name]);
            session(['privilege' => $user->privilege]);

            // echo "NEW USER ".$currentUser->getEmail();

            return redirect()->route('subscriptionPlans');
        }
    }

    public function signin()
    {
        if (session()->has('email')) {

            $email = session('email');

            $user = DB::table('users')->where('email', $email)->get()->first();

            if ($user != '') {
                if ($user->status == 'paid') {
                    return redirect()->route('dashboard');
                } else {
                    return redirect()->route('subscriptionPlans');
                }
            } else {
                return view('subscriptionPlans');
            }
        } else {
            return view('signin');
        }
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirect2()
    {
        return Socialite::driver('google')->redirect('auth/google/call-back2');
    }

    public function callBackGoogle()
    {
        $currentUser = Socialite::driver('google')->stateless()->user();

        $givenEmail = $currentUser->getEmail();
        $extensionEmail = explode('@', $givenEmail);
        $user = User::where('email', $currentUser->getEmail())->first();

        if ($user != '') {
            $userExists = TRUE;
            // echo "User exists: True all accounts";
        } else if ($extensionEmail[1] == 'gmail.com' || $extensionEmail[1] == 'googlemail.com') {

            $gmail = $extensionEmail[0] . '@gmail.com';
            $googleMail = $extensionEmail[0] . '@googlemail.com';
            $user = User::whereIn('email', [$gmail, $googleMail])->get()->first();

            if ($user != '') {
                $userExists = TRUE;
                // echo "User exists: True gmail account";
            } else {
                $userExists = FALSE;
                // echo "User exists: False gmail account";
            }
        } else {
            $userExists = FALSE;
            // echo "User exists: Flase all account";
        }

        if ($currentUser->name != null) {
            $name = $currentUser->name;
            // echo "Current user name exists".$name;
        } else {
            $name = '-';
            // echo "Current user name not exists";
        }

        $gid = $currentUser->id;
        $gid = $gid . '';
        // echo "GID: ". $gid;

        if ($userExists) {

            if ($user->status == 'not paid') {

                session(['email' => $currentUser->getEmail()]);

                // echo "User exists but status is not paid ". $currentUser->getEmail();

                return redirect()->route('subscriptionPlans');
            } elseif ($user->created_by > 0 || $user->gid == '-') {
                DB::table('users')->where('email', $user->email)->update([
                    'gid' => $gid,
                ]);

                session(['email' => $user->email]);
                session(['signin1' => 'yes']);
                session(['username' => $name]);
                session(['privilege' => $user->privilege]);

                return redirect()->route('dashboard');
            } else {

                // $_SESSION['email'] = $currentUser->getEmail();

                // $_SESSION['signin1'] = 'yes';
                // $_SESSION['username'] = $name;

                // $user = DB::table('users')->where('email', $_SESSION['email'])->get()->first();

                // $_SESSION['privilege'] = $user->privilege;
                session(['email' => $currentUser->getEmail()]);
                session(['signin1' => 'yes']);
                session(['username' => $name]);

                $user = DB::table('users')->where('email', session('email'))->first();

                session(['privilege' => $user->privilege]);

                // echo "USer exists and status is paid ".$currentUser->getEmail();

                return redirect()->route('dashboard');
            }
        } else {
            $newUser = DB::table('users')->insert(
                [
                    'name' => $name,
                    'email' => $givenEmail,
                    'gid' => $gid,
                    'firstName' => '-',
                    'lastName' => '-',
                    'profilePic' => '-',
                    'statement' => '-',
                    'statementOne' => '-',
                    'statementTwo' => '-',
                    'statementThree' => '-',
                    'status' => 'not paid',
                    'privilege' => 0
                ]
            );

            // $_SESSION['email'] = $currentUser->getEmail();

            // $_SESSION['signin1'] = 'yes';
            // $_SESSION['username'] = $name;


            session(['email' => $currentUser->getEmail()]);
            session(['signin1' => 'yes']);
            session(['username' => $name]);

            // echo "NEW USER ".$currentUser->getEmail();

            return redirect()->route('subscriptionPlans');
        }
    }
    public function callBackGoogle2()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->getEmail())->first();
        $email = $googleUser->email;
        $name = $googleUser->name;
        $gid = $googleUser->id;
        $gid = $gid . '';
        print($gid);

        if (!$user) {

            $newUser = DB::table('users')->insert(
                [
                    'name' => $name,
                    'email' => $email,
                    'gid' => $gid,
                    'firstName' => '-',
                    'lastName' => '-',
                    'profilePic' => '-',
                    'statement' => '-',
                    'statementOne' => '-',
                    'statementTwo' => '-',
                    'statementThree' => '-',
                    'status' => 'not paid',
                    'privilege' => 0
                ]
            );

            // $_SESSION['email'] = $googleUser->getEmail();

            // $_SESSION['signin1'] = 'yes';
            // $_SESSION['username'] = $googleUser->name;

            session(['email' => $googleUser->getEmail()]);
            session(['signin1' => 'yes']);
            session(['username' => $googleUser->name]);

            return redirect()->intended('subcriptionPlans');
        } else {

            // $_SESSION['email'] = $googleUser->getEmail();

            // $_SESSION['signin1'] = 'yes';
            // $_SESSION['username'] = $googleUser->name;

            // $user = DB::table('users')->where('email', $_SESSION['email'])->get()->first();

            // $_SESSION['privilege'] = $user->privilege;


            return redirect()->intended('allTemplates');
        }
    }

    public function redirectToApple()
    {
        // return Socialite::driver('apple')->redirect();
        // return Socialite::driver('sign-in-with-apple')->scopes(["name", "email"])->redirect();
        // return Socialite::driver('apple')->scopes(["name", "email"])->redirect();
        return Socialite::driver("sign-in-with-apple")->scopes(["name", "email"])->redirect();
    }

    public function handleAppleCallback()
    {
        // $currentUser = Socialite::driver('sign-in-with-apple')->stateless()->user();
        $currentUser = Socialite::driver('sign-in-with-apple')->user();
        // ddd($currentUser);

        $givenEmail = $currentUser->getEmail();
        $extensionEmail = explode('@', $givenEmail);
        $user = User::where('email', $currentUser->getEmail())->first();

        if ($user != '') {
            $userExists = TRUE;
            // echo "User exists: True all accounts";
        } else if ($extensionEmail[1] == 'gmail.com' || $extensionEmail[1] == 'googlemail.com') {

            $gmail = $extensionEmail[0] . '@gmail.com';
            $googleMail = $extensionEmail[0] . '@googlemail.com';
            $user = User::whereIn('email', [$gmail, $googleMail])->get()->first();

            if ($user != '') {
                $userExists = TRUE;
                // echo "User exists: True gmail account";
            } else {
                $userExists = FALSE;
                // echo "User exists: False gmail account";
            }
        } else {
            $userExists = FALSE;
            // echo "User exists: Flase all account";
        }

        if ($currentUser->name != null) {
            $name = $currentUser->name;
            // echo "Current user name exists".$name;
        } else {
            $name = '-';
            // echo "Current user name not exists";
        }

        $gid = '-';
        // echo "GID: ". $gid;

        if ($userExists) {

            if ($user->status == 'not paid') {

                // $_SESSION['email'] = $currentUser->getEmail();
                session(['email' => $currentUser->getEmail()]);

                // echo "User exists but status is not paid ". $currentUser->getEmail();

                return redirect()->route('subscriptionPlans');
            } else {

                // $_SESSION['email'] = $currentUser->getEmail();

                // $_SESSION['signin1'] = 'yes';
                // $_SESSION['username'] = $name;

                // $user = DB::table('users')->where('email', $_SESSION['email'])->get()->first();

                // $_SESSION['privilege'] = $user->privilege;

                session(['email' => $currentUser->getEmail()]);
                session(['signin1' => 'yes']);
                session(['username' => $name]);

                $user = DB::table('users')->where('email', session('email'))->first();

                session(['privilege' => $user->privilege]);

                // echo "USer exists and status is paid ".$currentUser->getEmail();

                return redirect()->route('dashboard');
            }
        } else {
            $newUser = DB::table('users')->insert(
                [
                    'name' => $name,
                    'email' => $givenEmail,
                    'gid' => $gid,
                    'firstName' => '-',
                    'lastName' => '-',
                    'profilePic' => '-',
                    'statement' => '-',
                    'statementOne' => '-',
                    'statementTwo' => '-',
                    'statementThree' => '-',
                    'status' => 'not paid',
                    'privilege' => 0
                ]
            );

            // $_SESSION['email'] = $currentUser->getEmail();

            // $_SESSION['signin1'] = 'yes';
            // $_SESSION['username'] = $name;
            session(['email' => $currentUser->getEmail()]);
            session(['signin1' => 'yes']);
            session(['username' => $name]);


            // echo "NEW USER ".$currentUser->getEmail();

            return redirect()->route('subscriptionPlans');
        }
    }
    // function logout()
    // {

    //     unset($_SESSION["email"]);
    //     unset($_SESSION["signin1"]);
    //     unset($_SESSION['username']);
    //     unset($_SESSION['privilege']);
    //     session_destroy();

    //     return redirect()->route('home');
    // }

    public function logout()
    {
        session()->forget('email');
        session()->forget('signin1');
        session()->forget('username');
        session()->forget('privilege');
        session()->flush();
        return redirect()->route('home');
    }
}
