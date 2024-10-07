<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BillingController extends Controller
{
    public function Billing()
    {
        try {
            if (!session()->has('email')) {
                return view('signin');
            }
            $email = session('email');
            $user = DB::table('users')->where('email', $email)->get()->first();

            $billingUser = DB::table('subscriptions')->where('userEmail', $email)->first();
            $timestamp = $billingUser->startDate;

            $date = Carbon::createFromTimestamp($timestamp);
            $startDate = $date->format('F jS, Y g:i A');
            $planId = $billingUser->planId;
            $selectPackage = DB::table('plans')->where('id', $planId)->first();
            $packageName = $selectPackage->name;

            $billingHistory = DB::table('billing_history')
                ->where('userEmail', $email)
                ->orderByDesc('id')
                ->get();

            return view('pages.billing', compact('startDate', 'packageName', 'billingHistory','user'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
