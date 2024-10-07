<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Exception;


class StripeController extends Controller
{

    public function createPaymentIntent(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $apiId = $request->api_id;

            // Fetch the subscription plan from the database
            $plan = DB::table('plans')->where('api_id', $apiId)->first();

            if (!$plan) {
                return response()->json(['error' => 'Invalid subscription plan'], 400);
            }

            // Amount in cents
            $amount = intval($plan->price * 100);

            // Create a PaymentIntent with the order amount and currency
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'EUR',
            ]);

            return response()->json([
                'status' => true,
                'paymentIntent' => $paymentIntent->client_secret,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function cancelSubscription(Request $request)
    {
        $user = $request->user();
        $token = $request->bearerToken();

        $email = $user->email;
        $subscription = DB::table('subscriptions')->where('userEmail', $email)->first();

        if (!$subscription) {
            return response()->json([
                'status' => false,
                'message' => 'Subscription ID not found',
            ], 404);
        }

        $status = $subscription->status;
        $subscriptionId = $subscription->subscriptionId;

        if ($status == 'active' || $status == 'open') {
            try {
                $stripe = new StripeClient(env('STRIPE_SECRET'));
                $stripe->subscriptions->cancel($subscriptionId, []);
            } catch (Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Subscription cancellation failed: ' . $e->getMessage(),
                ], 500);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Subscription is not active or open',
            ], 400);
        }

        DB::table('subscriptions')->where('userEmail', $email)->update([
            'status' => 'cancelled'
        ]);

        DB::table('users')->where('email', $email)->update([
            'status' => 'cancelled',
            'privilege' => 0
        ]);

        $reason = $request->reason;
        $moreInfo = $request->moreInfo;

        DB::table('cancelledSubscriptions')->insert([
            'email' => $email,
            'reason' => $reason,
            'moreInfo' => $moreInfo
        ]);

        $message = 'Your Subscription was cancelled successfully.';

        $activeUser = DB::table('users')->where('email', $email)->first();
        $name = $activeUser->name;

        $emailMessage = "Hi " . $name . ",\n\nI hope this email finds you well. \n\nYour Subscription was cancelled successfully.\n\nPlease Note: This is an automatic system email, please do not reply to this message.\n\nDIAN";

        $this->mailnow($emailMessage, $email, $name);

        return response()->json([
            'status' => true,
            'message' => $message,
            'token' => $token
        ]);
    }

    public function subscriptionPlans()
    {
        $plans = DB::table('plans')->get();
        $filteredPlans = $plans->filter(function ($plan) {
            return $plan->accessPages !== '-';
        });

        $planAccessPages = $filteredPlans->mapWithKeys(function ($plan) {
            return [
                $plan->name => [
                    'api_id' => $plan->api_id,
                    'price' => $plan->price,
                    'accessPages' => explode(',', $plan->accessPages),
                    'privilege' => $plan->privilege
                ]
            ];
        });

        return response()->json([
            'status' => true,
            'plans' => $planAccessPages,
        ]);
    }

    public function addSubscription(Request $request)
    {
        $user = $request->user();
        // Validate the request data

        $email = $user->email;
        $subscriptionId = $request->subscriptionId;
        $customerId = $request->customerId;
        $planName = $request->plan_name;

        // Retrieve the plan based on the provided plan name
        $plan = DB::table('plans')->where('name', $planName)->first();

        if (!$plan) {
            return response()->json(['message' => 'Plan not found'], 404);
        }

        // Delete any temporary or inactive subscriptions for the user
        DB::table('subscriptions')->where('userEmail', $email)->where('status', '-')->delete();

        // Check for an existing active subscription
        $existingSubscription = DB::table('subscriptions')->where('userEmail', $email)->first();

        // if ($existingSubscription && $existingSubscription->status == 'active') {
        //     return response()->json([
        //         'message' => 'An active subscription already exists. Please upgrade your subscription.',
        //         'redirect' => "https://dentistryinanutshell.com/dian/public/api/add-subscription"
        //     ], 200);
        // }

        Subscription::updateOrInsert(
            ['userEmail' => $email],
            [
                'subscriptionId' => $subscriptionId,
                'customerId' => $customerId,
                'planId' => $plan->id,
                'startDate' => now()->timestamp, // Store the start date as a UNIX timestamp
                'status' => 'active'
            ]
        );


        $user = User::where('email', $email)->update([
            'status' => 'paid',
            'privilege' => $plan->privilege
        ]);

        return response()->json([
            'message' => 'Subscription added successfully',
            'planId' => $plan->id
        ], 201);
    }

    public function upgradeSubscription(Request $request)
    {
        try {
            $user = $request->user();
            // Retrieve email and plan ID from the request
            $email = $user->email;
            $previousPlanId = $request->input('previous_plan_id');


            // Fetch active subscription of the user
            $subscription = DB::table('subscriptions')
                ->where('userEmail', $email)
                ->where('status', 'active')
                ->first();

            if (!$subscription) {
                return response()->json(['message' => 'No active subscription found'], 404);
            }

            // Fetch subscription and customer details
            $subscriptionId = $subscription->subscriptionId;
            $customerId = $subscription->customerId;
            $planId = $subscription->planId;

            // Get current plan details
            $plans = DB::table('plans')->where('id', $planId)->first();
            $currentPrivilege = $plans->privilege;

            // Initialize Stripe API
            $stripe_obj = new Stripe;

            $stripe_obj->setApiKey(env('STRIPE_SECRET'));
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $stripe = new StripeClient((env('STRIPE_SECRET')));


            $this->moveToHistorical($subscription, $previousPlanId);

            // Fetch previous plan and privileges
            $previousPlan = DB::table('plans')->where('id', $previousPlanId)->first();

            if (!$previousPlan) {
                return response()->json([
                    'message' => 'Previous plan not found'
                ], 404);
            }

            $previousPrivilege = $previousPlan->privilege;

            // Fetch all subscription items from Stripe
            $subscriptionItems = \Stripe\SubscriptionItem::all(['subscription' => $subscriptionId]);

            // Find and update the correct subscription item
            foreach ($subscriptionItems->data as $item) {
                if ($item->price->id == $previousPlan->api_id) {
                    $subscriptionItemId = $item->id;
                    try {
                        // Update Stripe subscription
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
                        return response()->json(['error' => $e->getMessage()], 500);
                    }
                    break;
                }
            }

            // Update user privilege
            DB::table('users')->where('email', $email)->update([
                'status' => 'paid',
                'privilege' => $plans->privilege
            ]);

            // Send confirmation email
            $activeUser = DB::table('users')->where('email', $email)->first();
            $name = $activeUser->name;
            $message = "Hi $name,\n\nYour subscription upgrade is successful. The new pricing will be reflected in the next invoice.\n\nRegards,\nDIAN";
            $this->mailnow($message, $email, $name);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Subscription upgraded successfully',
                'privilege' => $plans->privilege
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function moveToHistorical($subscription, $previousPlanId)
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


    public function stripePost(Request $request)
    {
        $user = $request->user();

        $email = $user->email;
        $couponCode = $request->couponCode;
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $discountCode = DB::table('coupons')->where('couponCode', $couponCode)->first();
        $stripeCouponId = $discountCode ? $discountCode->stripeId : null;
        $discount = $discountCode ? $discountCode->discount : 0;

        $subscription = DB::table('subscriptions')->where('userEmail', $email)->where('status', '-')->firstOrFail();
        $plan = DB::table('plans')->where('id', $subscription->planId)->firstOrFail();

        $customer = $this->getOrCreateCustomer($stripe, $email);

        $checkoutSession = $stripe->checkout->sessions->create([
            'success_url' => route('complete-checkout', ['session_id' => '{CHECKOUT_SESSION_ID}']),
            'cancel_url' => route('subscription-plans'),
            'mode' => 'subscription',
            'line_items' => [['price' => $plan->api_id, 'quantity' => 1]],
            'allow_promotion_codes' => true,
            'customer' => $customer->id,
        ]);

        return redirect($checkoutSession->url);
    }

    private function getOrCreateCustomer($stripe, $email)
    {
        $customer = $stripe->customers->all(['email' => $email])->data[0] ?? null;

        if (!$customer) {
            $customer = $stripe->customers->create(['email' => $email]);
        }

        return $customer;
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
        $sendgrid->send($email);

        // try {

        //     print $response->statusCode() . "\n";
        //     print_r($response->headers());
        //     print $response->body() . "\n";
        // } catch (\Exception $e) {
        //     echo 'Caught exception: ' . $e->getMessage() . "\n";
        // }
    }
}
