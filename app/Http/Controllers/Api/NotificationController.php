<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();

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

            $notificationData = $userNotifications->map(function ($notification) {
                $data = is_array($notification->data) ? $notification->data : json_decode($notification->data, true);
                $data['url'] = 'https://www.dentistryinanutshell.com/dian/public/' . $data['url'];

                return [
                    'id' => $notification->id,
                    'data' => $data,
                    'notification_status' => $notification->read_at ? 'read' : 'unread'
                ];
            });

            if (!$notificationData->isEmpty()) {
                return [
                    'status' => 'user',
                    'notification' => $notificationData,
                    'token' => $token
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

                $filteredNotificationData = $filteredNotifications->map(function ($notification) {
                    $data = is_array($notification->data) ? $notification->data : json_decode($notification->data, true);
                    $data['url'] = 'https://www.dentistryinanutshell.com/dian/public/' . $data['url'];

                    return [
                        'id' => $notification->id,
                        'data' => $data,
                        'notification_status' => $notification->read_at ? 'read' : 'unread'
                    ];
                });

                return [
                    'status' => 'owner',
                    'notification' => $filteredNotificationData,
                    'token' => $token
                ];
            }
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function markRead(Request $request, $id)
    {
        $user = $request->user();
        $token = $request->bearerToken();
        $userId = $user->id;

        $loginUser = User::find($userId);
        $notification = $loginUser->notifications()->where('id', $id)->first();

        if ($notification) {
            if ($notification->read_at === null) {
                $notification->markAsRead();

                return response()->json([
                    'status' => true,
                    'message' => 'Notification Read Successfully',
                    'token' => $token
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Notification Already marked as read',
                    'token' => $token
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Notification not found',
                'token' => $token
            ], 404);
        }
    }

}
