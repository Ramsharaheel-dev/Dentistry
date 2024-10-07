<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function googleSignUp(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (isset($user->profilePic) && $user->profilePic != '-') {
            $user->profilePic = 'https://dentistryinanutshell.com/dev_test/dentistry/storage/app/profile_pics/' . $user->profilePic;
        }

        if ($user) {
            if ($user->status == 'not paid') {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message' => 'User Exists Already || Subscription Not Paid',
                    'data' => $user,
                    'redirect_url' => 'Redirect on Subscription Plans',
                    'token' => $token
                ], 200);
            } else {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message' => 'User Exists Already || Subscription Paid',
                    'data' => $user,
                    'redirect_url' => 'Redirect On Dashboard',
                    'token' => $token
                ], 200);
            }
        } else {
            try {
                $newUser = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'gid' => '-',
                    'firstName' => '-',
                    'lastName' => '-',
                    'profilePic' => '-',
                    'statement' => '-',
                    'statementOne' => '-',
                    'statementTwo' => '-',
                    'statementThree' => '-',
                    'status' => 'not paid',
                    'privilege' => 0,
                ]);

                $token = $newUser->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message' => 'User Created Successfully',
                    'data' => $newUser,
                    'redirect_url' => 'Redirect on Subscription Plans',
                    'token' => $token
                ], 201);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'User Creation Failed',
                    'error' => $e->getMessage()
                ], 500);
            }
        }
    }

    public function appleSignUp(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->status == 'not paid') {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message' => 'User Exists Already || Subscription Not Paid',
                    'data' => $user,
                    'redirect_url' => 'Redirect on Subscription Plans',
                    'token' => $token
                ], 200);
            } else {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message' => 'User Exists Already || Subscription Paid',
                    'data' => $user,
                    'redirect_url' => 'Redirect On Dashboard',
                    'token' => $token
                ], 200);
            }
        } else {
            try {
                $newUser = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'gid' => '-',
                    'firstName' => '-',
                    'lastName' => '-',
                    'profilePic' => '-',
                    'statement' => '-',
                    'statementOne' => '-',
                    'statementTwo' => '-',
                    'statementThree' => '-',
                    'status' => 'not paid',
                    'privilege' => 0,
                ]);

                $token = $newUser->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message' => 'User Created Successfully',
                    'data' => $newUser,
                    'redirect_url' => 'Redirect on Subscription Plans',
                    'token' => $token
                ], 201);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'User Creation Failed',
                    'error' => $e->getMessage()
                ], 500);
            }
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        // Revoke the current access token associated with the user
        $user->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout successful'
        ]);
    }
}
