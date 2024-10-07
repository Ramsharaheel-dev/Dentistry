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

class AdminController extends Controller
{
    function adminLogin(){
        return view('adminLogin');
    }

    function checkAdminLogin(Request $request){

        $adminEmail = $request->adminEmail;
        $adminPassword = $request->adminPassword;

        $admin = DB::table('admin')->where('email',$adminEmail)->where('password',$adminPassword)->get()->first();

        if($admin!=''){
            $_SESSION['adminEmail'] = $adminEmail;
            $message = '';
            return view('adminDashboard',['message'=>$message]);
        }else{
            return back();
        }
    }

    function addDiscountCoupon(Request $request){
        if($request->couponCode && $request->discount){
            $couponCode = $request->couponCode;
            $discount = $request->discount;

            $coupon = DB::table('coupons')->insert([
                'couponCode' => $couponCode,
                'discount' => $discount
            ]);

            $message = 'Coupon added successfully !';
            return view('adminDashboard',['message'=>$message]);
        }
    }

    function updateSubscriptionPlan(Request $request){

        if($request->subscriptionName && $request->subscriptionPrice){

            $subscriptionName = $request->subscriptionName;
            $subscriptionPrice = $request->subscriptionPrice;

            $plan = DB::table('plans')->where('name',$subscriptionName)->update([
                'price' => $subscriptionPrice
            ]);


            $message = 'Plans updated successfully !';
            return view('adminDashboard',['message'=>$message]);
        }else{
            $message = 'Pass all parameters !';
            return view('adminDashboard',['message'=>$message]);
        }

    }

}
