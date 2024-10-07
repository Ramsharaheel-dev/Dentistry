<?php

namespace App\Http\Controllers;

use Session;
use Stripe;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

class StripeController extends Controller
{

    function subscriptionPlans()
    {
        $starterPlans = DB::table('plans')->where('name', 'starter')->get()->first();
        $studentPlans = DB::table('plans')->where('name', 'student')->get()->first();
        $premiumPlans = DB::table('plans')->where('name', 'premium')->get()->first();
        $dentistryOwnerPlans = DB::table('plans')->where('name', 'dentistryOwner')->get()->first();

        $plans = DB::table('plans')->get()->all();

        $hideSignin = FALSE;
        if (session()->has('email')) {
            $hideSignin = TRUE;
        } else {
            $hideSignin = FALSE;
        }

        // return view('subscriptionPlans', [
        //     'plans' => $plans,
        //     'hideSignin' => $hideSignin,
        //     'starterPlans' => explode(',', $starterPlans->accessPages),
        //     'studentPlans' => explode(',', $studentPlans->accessPages),
        //     'premiumPlans' => explode(',', $premiumPlans->accessPages),
        //     'dentistryOwnerPlans' => explode(',', $dentistryOwnerPlans->accessPages)
        // ]);

        return view('pages.subscription_plans', [
            'plans' => $plans,
            'hideSignin' => $hideSignin,
            'starterPlans' => explode(',', $starterPlans->accessPages),
            'studentPlans' => explode(',', $studentPlans->accessPages),
            'premiumPlans' => explode(',', $premiumPlans->accessPages),
            'dentistryOwnerPlans' => explode(',', $dentistryOwnerPlans->accessPages)
        ]);
    }

    function submitSubscriptionPlans(Request $request)
    {
        if (session()->has('email')) {
            $email = session('email');

            $planName = $request->planName;
            $priceId = $request->priceId;

            $plan = DB::table('plans')->where('name', $planName)->get()->first();

            $planId = $plan->id;

            $subscriptions = DB::table('subscriptions')->where('userEmail', $email)->where('status', '-')->delete();

            $updateSubscription = DB::table('subscriptions')->where('userEmail', $email)->get()->first();

            if ($updateSubscription != '') {

                if ($updateSubscription->status == 'active') {
                    session(['previousPlanId' => $updateSubscription->planId]);

                    $updateSubscription = DB::table('subscriptions')->where('userEmail', $email)->update([
                        'planId' => $plan->id
                    ]);

                    return redirect('upgrade-subscription');
                }

                $updateSubscription = DB::table('subscriptions')->where('userEmail', $email)->update([
                    'planId' => $plan->id
                ]);
            } else {

                $newSubscription = DB::table('subscriptions')->insert([
                    'subscriptionId' => '-',
                    'userEmail' => $email,
                    'customerId' => '-',
                    'planId' => $plan->id,
                    'startDate' => '-',
                    'status' => '-'
                ]);
            }

            return redirect('stripe');
        } else {
            return redirect('signin');
        }
    }


    public function freeSubscription()
    {
        $email = session('email');

        if (!$email) {
            // Handle the case when the email is not found in the session
            return redirect()->back()->with('error', 'Email not found in session.');
        }

        $subscription = DB::table('subscriptions')->where('userEmail', $email)->first();

        if ($subscription) {
            $status = $subscription->status;
            $subscriptionId = $subscription->subscriptionId;

            if ($status == 'active' || $status == 'open') {
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                $stripe->subscriptions->cancel($subscriptionId, []);
            }

            DB::table('subscriptions')->where('userEmail', $email)->update([
                'status' => 'cancelled'
            ]);
        }

        DB::table('users')->where('email', $email)->update([
            'status' => 'paid',
            'privilege' => 0
        ]);

        session()->put('privilege', 0);

        return redirect('dashboard');
    }

    public function stripe()
    {
        $coupons = DB::table('coupons')->get('couponCode')->all();
        $couponCodes = [];

        for ($i = 0; $i < count($coupons); $i++) {
            array_push($couponCodes, $coupons[$i]->couponCode);
        }

        $email = session('email');

        $user = DB::table('subscriptions')->where('userEmail', $email)->get()->first();

        $plan = DB::table('plans')->where('id', $user->planId)->get()->first();

        $amount = $plan->price;
        $planName = $plan->name;

        $hideSignin = FALSE;
        if (session()->has('email')) {
            $hideSignin = TRUE;
        }

        return view('stripe', ['coupons' => json_encode($couponCodes), 'hideSignin' => $hideSignin, 'amount' => $amount, 'planName' => $planName]);
    }

    public function stripePost1(Request $request)
    {
        if (session()->has('email')) {
            $email =
                session('email');
            $stripe_obj = new Stripe\Stripe();

            $couponCode = $request->couponCode;

            $stripe = $stripe_obj->setApiKey(env('STRIPE_SECRET'));
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


            $stripe = new \Stripe\StripeClient((env('STRIPE_SECRET')));

            // $customer = $stripe->customers->create([
            //     'email' => $email,
            //     'source' => $request->stripeToken
            // ]);


            $discountCode = DB::table('coupons')->where('couponCode', $couponCode)->get()->first();

            if ($discountCode != '') {
                $discount = $discountCode->discount;
                $stripeCouponId = $discountCode->stripeId;
            } else {
                $discount = 0;
                $stripeCouponId = '';
            }

            $getSubscription = DB::table('subscriptions')->where('userEmail', $email)->where('status', '-')->get()->first();

            $planId = $getSubscription->planId;

            $plans = DB::table('plans')->where('id', $planId)->get()->first();
            $amount = $plans->price;
            $currency = $plans->currency;

            // if($discountCode != ''){
            //     $discountedAmount = $amount - ($amount * ($discount/100));
            // }else{
            //     $discountedAmount = $amount;
            // }

            // $discountedAmount = number_format((float)$discountedAmount, 2, '.', '');

            // dd($discountedAmount);

            // Stripe\Charge::create([
            //     "amount" => $discountedAmount*100,
            //     "currency" => $currency,
            //     "customer" => $customer->id,
            //     "description" => "Stripe Charging",
            // ]);

            // $newCustomer = DB::table('customers')->insert([
            //     'userEmail' => $email,
            //     'customerId' => $customer->id,
            //     'token' => $request->stripeToken,
            //     'amount' => $discountedAmount,
            //     'currency' => $currency,
            // ]);

            // $plan = DB::table('plans')->get()->first();

            // $price = $stripe->prices->create([

            //     'unit_amount' => $discountedAmount,

            //     'currency' => $currency,

            //     'recurring' => ['interval' => 'month']

            //   ]);

            // $subscription = $stripe->subscriptions->create([
            //     'customer' => $customer->id,
            //     'items' => [
            //         ['price' => $plans->api_id],
            //     ],
            //     'collection_method' => 'charge_automatically',
            //     'coupon' => $stripeCouponId
            // ]);

            $subscription = \Stripe\Checkout\Session::create([
                // TEST
                // 'success_url' => 'https://test.dentistryinanutshell.com/lara/dev/dian/public/welcome?session_id={CHECKOUT_SESSION_ID}',
                // 'cancel_url' => 'https://test.dentistryinanutshell.com/lara/dev/dian/public/subscription-plans',

                // 'mode' => 'subscription',
                // 'line_items' => [[
                // 'price' => 'price_1NiipSD3d1v3hHFFzVNmdqw7',
                //   'quantity' => 1,
                // ]],

                // PROD
                'success_url' => 'https://www.dentistryinanutshell.com/dian/public/welcome?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'https://www.dentistryinanutshell.com/dian/public/subscription-plans',
                'mode' => 'subscription',
                'line_items' => [
                    [
                        'price' => $plans->api_id,
                        'quantity' => 1,
                    ]
                ],
                'allow_promotion_codes' => true,
            ]);

            // header("Location: " . $subscription->url);


            $newSubscription = DB::table('subscriptions')->where('userEmail', $email)->where('status', '-')->update([
                'subscriptionId' => $subscription->subscription,
                'customerId' => '-',
                'startDate' => $subscription->created,
                'status' => $subscription->status
            ]);

            // Session::flash('success', 'Payment Successfull!');

            $user = DB::table('users')->where('email', $email)->update([
                'status' => 'paid',
                'privilege' => $plans->privilege
            ]);

            $activeUser = DB::table('users')->where('email', $email)->get()->first();

            $name = $activeUser->name;

            $message = "Hi " . $name . ",\n\nI hope this email finds you well. \n\nYour payment is successful.\n\nNow, Your subscription is activated.\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

            $this->mailnow($message, $email, $name);

            $user = DB::table('users')->where('email', session('email'))->get()->first();

            session(['privilege' => $user->privilege]);

            return redirect($subscription->url);
            //return redirect('setup-profile');
        } else {
            return redirect('signin');
        }
    }

    public function stripePost(Request $request)
    {
        if (session()->has('email')) {
            $email = session('email');
            $stripe_obj = new Stripe\Stripe();

            $couponCode = $request->couponCode;

            $stripe = $stripe_obj->setApiKey(env('STRIPE_SECRET'));
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


            $stripe = new \Stripe\StripeClient((env('STRIPE_SECRET')));

            $discountCode = DB::table('coupons')->where('couponCode', $couponCode)->get()->first();

            if ($discountCode != '') {
                $discount = $discountCode->discount;
                $stripeCouponId = $discountCode->stripeId;
            } else {
                $discount = 0;
                $stripeCouponId = '';
            }

            $getSubscription = DB::table('subscriptions')->where('userEmail', $email)->get()->first();

            $planId = $getSubscription->planId;

            $plans = DB::table('plans')->where('id', $planId)->get()->first();
            $amount = $plans->price;
            $currency = $plans->currency;

            try {
                $customer = \Stripe\Customer::all(['email' => session('email')]);

                if (!empty($customer->data)) {
                    $customer = $customer['data'][0];
                    // Customer with the provided email address exists
                    //   foreach ($customer->data as $customerData) {
                    //     echo 'Customer ID: ' . $customerData->id . '<br>';
                    //     // You can access other customer details here
                    //   }
                } else {
                    // Customer with the provided email address does not exist
                    $customer = \Stripe\Customer::create([
                        'email' => session('email'), // Provide a unique email address for each customer
                    ]);
                }
            } catch (\Exception $e) {
                // Handle any API errors
                echo 'Error: ' . $e->getMessage();
            }


            $subscription = \Stripe\Checkout\Session::create([
                // TEST
                // 'success_url' => 'https://test.dentistryinanutshell.com/lara/dev/dian/public/complete-checkout?session_id={CHECKOUT_SESSION_ID}',
                // 'cancel_url' => 'https://test.dentistryinanutshell.com/lara/dev/dian/public/subscription-plans',

                // 'mode' => 'subscription',
                // 'line_items' => [[
                // 'price' => $plans->api_id,
                //   'quantity' => 1,
                // ]],
                // 'allow_promotion_codes' => true,
                // 'customer' => $customer->id,

                // PROD
                'success_url' => 'https://www.dentistryinanutshell.com/dian/public/complete-checkout?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'https://www.dentistryinanutshell.com/dian/public/subscription-plans',
                'mode' => 'subscription',
                'line_items' => [
                    [
                        'price' => $plans->api_id,
                        'quantity' => 1,
                    ]
                ],
                'allow_promotion_codes' => true,
                'customer' => $customer->id,
            ]);


            // header("Location: " . $subscription->url);

            //    return $subscription;

            return redirect($subscription->url);
        } else {
            return redirect('signin');
        }
    }

    function completeCheckout(Request $request)
    {
        // return session('email');
        if (session()->has('email')) {

            $email = session('email');
            $stripe_obj = new Stripe\Stripe();

            $stripe = $stripe_obj->setApiKey(env('STRIPE_SECRET'));
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $stripe = new \Stripe\StripeClient((env('STRIPE_SECRET')));

            $checkoutSession = $stripe->checkout->sessions->retrieve(
                $request->session_id,
                []
            );

            if ($checkoutSession->status == 'complete') {
                $newSubscription = DB::table('subscriptions')->where('userEmail', $email)->update([
                    'subscriptionId' => $checkoutSession->subscription,
                    'customerId' => $checkoutSession->customer,
                    'startDate' => $checkoutSession->created,
                    'status' => 'active'
                ]);

                // Session::flash('success', 'Payment Successfull!');

                $getSubscription = DB::table('subscriptions')->where('userEmail', $email)->get()->first();

                $planId = $getSubscription->planId;

                $plans = DB::table('plans')->where('id', $planId)->get()->first();
                $user = DB::table('users')->where('email', $email)->update([
                    'status' => 'paid',
                    'privilege' => $plans->privilege
                ]);

                $activeUser = DB::table('users')->where('email', $email)->get()->first();

                $name = $activeUser->name;

                $message = "Hi " . $name . ",\n\nI hope this email finds you well. \n\nYour payment is successful.\n\nNow, Your subscription is activated.\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

                $this->mailnow($message, $email, $name);

                $user = DB::table('users')->where('email', session('email'))->get()->first();

                session(['privilege' => $user->privilege]);

                if ($user->firstName == '-' && $user->lastName == '-') {
                    return redirect('welcome');
                } else {
                    return redirect('dashboard');
                }
            } else {
                return redirect('subscription-plans');
            }
        } else {
            return redirect('signin');
        }
    }

    function upgradeSubscription()
    {
        if (session()->has('email')) {

            $email = session('email');
            $subscription = DB::table('subscriptions')->where('userEmail', $email)->where('status', 'active')->get()->first();

            $subscriptionId = $subscription->subscriptionId;
            $customerId = $subscription->customerId;
            $planId = $subscription->planId;

            $plans = DB::table('plans')->where('id', $planId)->get()->first();
            $currentPrivilege = $plans->privilege;

            $stripe_obj = new Stripe\Stripe();

            $stripe = $stripe_obj->setApiKey(env('STRIPE_SECRET'));
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $stripe = new \Stripe\StripeClient((env('STRIPE_SECRET')));

            if (session()->has('previousPlanId')) {
                $previousPlanId = session('previousPlanId');
                $this->moveToHistorical($subscription,$previousPlanId);
                $previousPlan = DB::table('plans')->where('id', $previousPlanId)->get()->first();
                $previousPrivilege = $previousPlan->privilege;

                $subscriptionItems = \Stripe\SubscriptionItem::all(
                    array(
                        'subscription' => $subscriptionId,
                    )
                );

                foreach ($subscriptionItems->data as $item) {

                    if ($item->price->id == $previousPlan->api_id) {
                        $subscriptionItemId = $item->id;
                        break;
                        try {
                            $stripe->subscriptions->update($subscriptionId, [
                                'items' => [
                                    [
                                        'id' => $subscriptionItemId,
                                        'deleted' => true,
                                    ],
                                    ['price' => $plans->api_id],
                                ],
                            ]);
                        } catch (\Stripe\Exception\CardException $e) {
                            echo $e;
                        }
                    }
                }
                $user = DB::table('users')->where('email', $email)->update([
                    'status' => 'paid',
                    'privilege' => $plans->privilege
                ]);

                $activeUser = DB::table('users')->where('email', $email)->get()->first();

                $name = $activeUser->name;

                $message = "Hi $name,\n\nI hope this email finds you well. \n\nUpgrading subscription is successful.\n\nThe change of pricing will be reflected in next invoice.\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

                $this->mailnow($message, $email, $name);

                $user = DB::table('users')->where('email', session('email'))->get()->first();

                session(['privilege' => $user->privilege]);

                return redirect('dashboard');
            }

            return redirect('subscription-plans');
        } else {
            return redirect('signin');
        }
    }

    function moveToHistorical($subscription,$previousPlanId)
    {
        $planId = $subscription->planId;
        $selectPackage = DB::table('plans')->where('id', $previousPlanId)->first();
        $packageName = $selectPackage->name;

        DB::table('billing_history')->insert([
            'userEmail' => $subscription->userEmail ?? '-',
            'packageName' => $packageName,
            'startDate' => $subscription->startDate ?? '-',
            'endDate' => now(),
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($subscription->status === 'active') {
            DB::table('billing_history')->insert([
                'userEmail' => $subscription->userEmail ?? '-',
                'packageName' => $packageName,
                'startDate' => $subscription->startDate ?? '-',
                'endDate' => now(),
                'status' => 'cancelled',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }


    function completeUpgradeCheckout(Request $request)
    {
        $stripe_obj = new Stripe\Stripe();

        $stripe = $stripe_obj->setApiKey(env('STRIPE_SECRET'));
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


        $stripe = new \Stripe\StripeClient((env('STRIPE_SECRET')));

        $email = session('email');

        $checkoutSession = $stripe->checkout->sessions->retrieve(
            $request->session_id,
            []
        );

        if ($checkoutSession->status == 'complete') {
            $newSubscription = DB::table('subscriptions')->where('userEmail', $email)->update([
                'subscriptionId' => $checkoutSession->subscription,
                'customerId' => $checkoutSession->customer,
                'startDate' => $checkoutSession->created,
                'status' => 'active'
            ]);

            // Session::flash('success', 'Payment Successfull!');

            $getSubscription = DB::table('subscriptions')->where('userEmail', $email)->get()->first();

            $planId = $getSubscription->planId;

            $plans = DB::table('plans')->where('id', $planId)->get()->first();
            $user = DB::table('users')->where('email', $email)->update([
                'status' => 'paid',
                'privilege' => $plans->privilege
            ]);

            $activeUser = DB::table('users')->where('email', $email)->get()->first();

            $name = $activeUser->name;

            $message = "Hi " . $name . ",\n\nI hope this email finds you well. \n\nUpgrading subscription is successful.\n\nNow, Your subscription is activated.\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

            $this->mailnow($message, $email, $name);

            $user = DB::table('users')->where('email', session('email'))->get()->first();

            session(['privilege' => $user->privilege]);

            return redirect('dashboard');
        } else {
            return redirect('subscription-plans');
        }
    }

    function cancelSubscription(Request $request)
    {
        if (session()->has('email')) {

            $email = session('email');
            $subscription = DB::table('subscriptions')->where('userEmail', $email)->get()->first();

            $status = $subscription->status;


            $subscriptionId = $subscription->subscriptionId;

            if ($status == 'active' || $status == 'open') {
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                $stripe->subscriptions->cancel(
                    $subscriptionId,
                    []
                );
            }

            DB::table('subscriptions')->where('userEmail', $email)->update([
                'status' => 'cancelled'
            ]);

            DB::table('users')->where('email', $email)->update([
                'status' => 'cancelled',
                'privilege' => 0
            ]);

            if ($request->reason) {
                $reason = $request->reason;
            } else {
                $reason = '-';
            }

            if ($request->moreInfo) {
                $moreInfo = $request->moreInfo;
            } else {
                $moreInfo = '-';
            }

            DB::table('cancelledSubscriptions')->insert([
                'email' => $email,
                'reason' => $reason,
                'moreInfo' => $moreInfo
            ]);

            $message = 'Your Subcription cancelled successfully';

            $activeUser = DB::table('users')->where('email', $email)->get()->first();

            $name = $activeUser->name;

            $emailMessage = "Hi " . $name . ",\n\nI hope this email finds you well. \n\nYour Subcription cancelled successfully.\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

            $this->mailnow($emailMessage, $email, $name);

            // return $message;

            return redirect('logout');

            // return back()->withInput(['message' => $message]);

        } else {
            return redirect('signin');
        }
    }

    function checkRenewlSubscriptionNotifications()
    {
        $users = DB::table('users')->get()->all();

        for ($i = 0; $i <= count($users); $i++) {
            $subscription = DB::table('subscriptions')->where('userEmail', $users[$i]->email)->get()->first();

            if ($subscription != '' && $subscription->startDate != '-' && $subscription->status != 'cancelled') {

                $startDate = $subscription->startDate;
                $startDate =
                    gmdate("d-m-Y", $startDate);
                $now = time();
                $endDate =
                    date('d-m-Y', strtotime($startDate . ' + 30 days'));
                $noOfDays = strtotime($endDate) - $now;
                $noOfDays =
                    round($noOfDays / (60 * 60 * 24));

                if ($noOfDays == 1) {
                    $message = "Hi " . $users[$i]->name . ",\n\nI hope this email finds you well. It was lovely speaking to you. Please find the requested information in the email below.\n\nYour subscription is going to be expired tomorrow.\n\nYour payment will be automatically be debited to renewel the subscription.\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";
                    $to = $users[$i]->email;
                    $name = $users[$i]->name;

                    // $this->mailNow($message,$to,$name);

                } else if ($noOfDays == 0) {
                    $updateSubscription = DB::table('subscriptions')->where('userEmail', $users[$i]->email)->update(['startDate', $now]);
                }
            }
        }
    }


    public function mailNow($message, $to, $name)
    {

        $dianKey = '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';

        $email = new \SendGrid\Mail\Mail();
        $email->setfrom("noreply@dentistryinanutshell.com", "DIAN");
        $email->setSubject("Welcome to DIAN!");
        $email->addto($to, $name);
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
