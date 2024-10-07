<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BillingController extends Controller
{
    public function getBillingInfo(Request $request)
    {
        $user = $request->user();
        $email = $user->email;
        $token = $request->bearerToken();

        $billingUser = DB::table('subscriptions')->where('userEmail', $email)->first();

        if (!$billingUser) {
            return response()->json([
                'success' => false,
                'message' => 'Subscription not found',
                'token' => $token
            ], 404);
        }

        $timestamp = $billingUser->startDate;
        $date = Carbon::createFromTimestamp($timestamp);
        $startDate = $date->format('F jS, Y g:i A');

        $planId = $billingUser->planId;
        $selectPackage = DB::table('plans')->where('id', $planId)->first();

        if (!$selectPackage) {
            return response()->json([
                'success' => false,
                'message' => 'Plan not found',
                'token' => $token
            ], 404);
        }

        $packageName = $selectPackage->name;

        $billingHistory = DB::table('billing_history')
            ->where('userEmail', $email)
            ->orderByDesc('id')
            ->get();

        return response()->json([
            'success' => true,
            'startDate' => $startDate,
            'packageName' => $packageName,
            'billingHistory' => $billingHistory,
            'user' => $user,
            'token' => $token
        ]);
    }
}
