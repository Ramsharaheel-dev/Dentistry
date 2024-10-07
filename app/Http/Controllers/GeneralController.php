<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{

    public function getNotifications(Request $request)
    {
        if (session()->has('email')) {
            $user = User::where('email', session('email'))->first();

            if ($user) {
                $userId = $user->id;

                $loginUser = User::find($userId);
                $currentTime = Carbon::now();

                $userNotifications = $loginUser->unreadNotifications()->where(function ($query) use ($currentTime) {
                    $query->where('data->end_date', '>', $currentTime->toDateString())
                        ->orWhere(function ($q2) use ($currentTime) {
                            $q2->where('data->end_date', '=', $currentTime->toDateString())
                                ->where('data->end_time', '>', $currentTime->format('H:i:s'));
                        });
                })->get();

                if (!$userNotifications->isEmpty()) {
                    return [
                        'status' => 'user',
                        'notification' => $userNotifications
                    ];
                } else {
                    $filteredNotifications = Notification::whereJsonContains('data->assigned_by', $userId)
                        ->where(function ($query) use ($currentTime) {
                            $query->where('data->end_date', '>', $currentTime->toDateString())
                                ->orWhere(function ($q2) use ($currentTime) {
                                    $q2->where('data->end_date', '=', $currentTime->toDateString())
                                        ->where('data->end_time', '>', $currentTime->format('H:i:s'));
                                });
                        })
                        ->get();

                    return [
                        'status' => 'owner',
                        'notification' => $filteredNotifications
                    ];
                }
            } else {
                // Handle case where user is not found
                return response()->json(['error' => 'User not found'], 404);
            }
        } else {
            // Handle case where session email is not set
            return response()->json(['error' => 'Session email not set'], 400);
        }
    }

    public function markRead($id)
    {
        if (session()->has('email')) {

            $user = User::where('email', session('email'))->first();
            $userId = $user->id;

            $loginUser = User::find($userId);
            $loginUser->notifications->where('id', $id)->markAsRead();

            return true;
        }
    }
}
