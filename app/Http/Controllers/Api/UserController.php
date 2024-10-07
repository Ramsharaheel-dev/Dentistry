<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRelation;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function manageUsers(Request $request)
    {
        $user = $request->user();

        $token = $request->bearerToken();

        if ($user) {
            $createdUsers = User::where('created_by', $user->id)->select('id', 'name', 'designation', 'email')->get();

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $createdUsers,
                'token' => $token
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
                'data' => [],
                'token' => $token
            ], 401);
        }
    }

    public function storeUser(Request $request)
    {
        $user = $request->user();
        $email = $user->email;

        $token = $request->bearerToken();

        $userCount = User::where('created_by', $user->id)->count();
        $maxUserLimit = 5;

        if ($userCount >= $maxUserLimit) {
            return response()->json([
                'status' => false,
                'message' => 'User creation limit reached',
                'data' => [],
                'token' => $token
            ], 422);
        }

        $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
            'designation' => 'required|string',
        ]);

        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return response()->json([
                'status' => false,
                'message' => 'Email already exists',
                'data' => [],
                'token' => $token
            ]);
        }

        $fullName = $request->firstName . ' ' . $request->lastName;

        $newUser = User::create([
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
            'created_by' => $user->id
        ]);

        UserRelation::create([
            'created_by' => $user->id,
            'user_id' => $newUser->id,
            'designation' => $newUser->designation,
        ]);

        $subscriptionDetails = Subscription::where('userEmail', $user->email)->first();
        $userPlanId = null;

        if ($subscriptionDetails->planId == 9) {
            $userPlanId = 5;
        } elseif ($subscriptionDetails->planId == 11) {
            $userPlanId = 8;
        }

        if ($userPlanId !== null) {
            DB::table('subscriptions')->insert([
                'subscriptionId' => $subscriptionDetails->subscriptionId,
                'userEmail' => $newUser->email,
                'customerId' => $subscriptionDetails->customerId,
                'planId' => $userPlanId,
                'startDate' => $subscriptionDetails->startDate,
                'status' => 'active'
            ]);
        }

        $fullNameEmail =  $request->firstName . '_' . $request->lastName;

        $message = "I hope this email finds you well. You were added to Dentistry in a Nutshell, please click on the following link to set up your account.\n\nThanks DIAN Club\n\n Please Click on this link to proceed https://dentistryinanutshell.com/dian/public/signin";
        $subject = "You are added in dentistry with this Email";

        // $this->sendEmail($message, $newUser->email, $fullNameEmail, $subject);

        return response()->json([
            'status' => true,
            'message' => 'User added successfully',
            'data' => $newUser,
            'token' => $token
        ]);
    }

    public function updateUserProfile(Request $request)
    {
        $user = $request->user();

        $token = $request->bearerToken();

        $gdcNumber = $request->gdc_number;
        $bio = $request->bio;
        $designation = $request->designation;
        $location = $request->location;
        $instagramUrl = $request->instagram_url;
        $facebookUrl = $request->facebook_url;
        $twitterUrl = $request->twitter_url;
        $linkedInUrl = $request->linkedin_url;

        if ($request->hasFile('editProfilePic')) {
            $profilePic = $request->file('editProfilePic');
            $uniqueFileName = uniqid() . '.' . $profilePic->getClientOriginalExtension();
            Storage::put('profile_pics/' . $uniqueFileName, file_get_contents($profilePic), 'public');
            $profilePicName = $uniqueFileName;
        } else {
            $profilePicName = $user->profilePic;
        }

        // $statementName = $this->handleFileUpload($request, 'editStatement', $user->statement);
        // $statementNameOne = $this->handleFileUpload($request, 'editStatementOne', $user->statementOne);
        // $statementNameTwo = $this->handleFileUpload($request, 'editStatementTwo', $user->statementTwo);
        // $statementNameThree = $this->handleFileUpload($request, 'editStatementThree', $user->statementThree);

        // Update the user profile
        $updateUser = DB::table('users')->where('id', $user->id)->update([
            'gdc_number' => $gdcNumber,
            'designation' => $designation,
            'bio' => $bio,
            'location' => $location,
            'instagram_url' => $instagramUrl,
            'facebook_url' => $facebookUrl,
            'twitter_url' => $twitterUrl,
            'linkedin_url' => $linkedInUrl,
            'profilePic' => $profilePicName,
            'updated_at' => Now()
        ]);

        if ($updateUser) {
            $user = DB::table('users')->where('id', $user->id)->first();
            return response()->json([
                'status' => true,
                'message' => 'User profile updated successfully',
                'user' => $user,
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update user profile',
                'token' => $token
            ], 500);
        }
    }

    public function deleteProfileImage(Request $request)
    {
        try {
            $user = $request->user();

            $email = $user->email;
            $oldProfilePic = $user->profilePic;

            if ($oldProfilePic) {
                if (!Storage::delete('profile_pics/' . $oldProfilePic)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to delete the profile picture'
                    ], 500);
                }
            }

            $updateResult = DB::table('users')->where('email', $email)->update(['profilePic' => null]);

            if (!$updateResult) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update the user profile'
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'Profile picture deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting profile picture: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the profile picture'
            ], 500);
        }
    }

    public function uploadInitialProfileData(Request $request)
    {
        $user = $request->user();
        $email = $user->email;

        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $gdcNumber = $request->input('gdc_number');

        $profilePicName = $user->profilePic;

        if ($request->hasFile('profilePic')) {
            $profilePic = $request->file('profilePic');
            $uniqueFileName = uniqid() . '.' . $profilePic->getClientOriginalExtension();
            Storage::put('profile_pics/' . $uniqueFileName, file_get_contents($profilePic), 'public');
            $profilePicName = $uniqueFileName;
        }

        DB::table('users')
            ->where('email', $email)
            ->update([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'profilePic' => $profilePicName,
                'gdc_number' => $gdcNumber,
                'statement' => 'file.png',
                'statementOne' => 'file.png',
                'statementTwo' => 'file.png',
                'statementThree' => 'file.png',
            ]);

        return response()->json([
            'status' => true,
            'message' => 'User initial data updated successfully'
        ]);
    }


    // private function handleFileUpload(Request $request, $fileKey, $currentFileName)
    // {
    //     if ($request->hasFile($fileKey)) {
    //         $file = $request->file($fileKey);
    //         $fileName = $file->getClientOriginalName();
    //         Storage::put('statements/' . $fileName, file_get_contents($file), 'public');
    //         return $fileName;
    //     } else {
    //         return $currentFileName;
    //     }
    // }

}
