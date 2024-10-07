@extends ('layouts.layout')

@section('head')
<title>Dian Subscription Plans</title>
<link rel='stylesheet' id='font-awesome-css' href="{{asset('css/subscriptionPlans.css')}}"/>
@endsection

@section('content')

@include('requires.header-home')

<div class="container">
    <div class="plans-heading">
        <h2 class="elementor-heading-title elementor-size-default" style="display:inline;color:white;font-size:45px;">Join the </h2>
        <img class="stripe-heading-img" decoding="async" width="300" height="59" src="./images/2023-02-DIAN-Club.png" class="attachment-medium size-medium wp-image-109" alt="" loading="lazy" srcset="./images/2023-02-DIAN-Club.png 300w, ./images/2023-02-DIAN-Club.png 370w" sizes="(max-width: 300px) 100vw, 300px" />
        <p>Select your plan</p>
        <div class="switch-wrapper">
            <input id="monthly" type="radio" name="switch" checked>
            <input id="yearly" type="radio" name="switch">
            <label for="monthly">Monthly</label>
            <label for="yearly">Yearly</label>
            <span class="highlighter"></span>
        </div>
    </div>


    <div class="row table-wrapper" style="margin-top:50px">

    <div class="col-lg-4 plans-col">
        <div class="plans-btn">

            <!-- <p class="plans-currency">0</p> -->
            <form method="POST" action="{{ route('submitSubscriptionPlans') }}">
                <div class="price monthly">
                    <!-- <div class="amount">0</div> -->
                    <input type="hidden" name="planName" value="starter">
                    <input type="hidden" name="priceId" value="price_1Nhv8JA8w9W8KkBmoI7T7cnS">
                    <input type="submit" class="amount" value="Starter&#13;&#10;£0">
                </div>
            </form>
            <form method="POST" action="{{ route('submitSubscriptionPlans') }}">
                <div class="price yearly hide">
                    <!-- <div class="amount">0</div> -->
                    <input type="hidden" name="planName" value="starterYearly">
                    <input type="hidden" name="priceId" value="price_1NhvHNA8w9W8KkBm8V543OXm">
                    <input type="submit" class="amount" value="Starter&#13;&#10;£0">
                </div>
            </form>
        </div>
        <ul>
        @foreach($starterPlans as $starterPlan)
            <li>
                {{ $starterPlan }}
            </li>
        @endforeach
        </ul>
    </div>


        <div class="col-lg-4 plans-col">
        <div class="plans-btn">
            <!-- <p class="plans-currency">10</p> -->
            <form method="POST" action="{{ route('submitSubscriptionPlans') }}">
                <div class="price monthly">
                    <!-- <div class="amount">5</div> -->
                    <input type="hidden" name="planName" value="student">
                    <input type="hidden" name="priceId" value="price_1NhvFrA8w9W8KkBmceRLJpdw">
                    <input type="submit" class="amount" value="Student&#13;&#10;£12.95">
                </div>

            </form>
            <form method="POST" action="{{ route('submitSubscriptionPlans') }}">
                <div class="price yearly hide">
                    <!-- <div class="amount">10</div> -->
                    <input type="hidden" name="planName" value="studentYearly">
                    <input type="hidden" name="priceId" value="price_1NhvHxA8w9W8KkBmMqVgkTu6">
                    <input type="submit" class="amount" value="Student&#13;&#10;£140">
                </div>

            </form>
        </div>
        <ul>
        @foreach($studentPlans as $studentPlan)
            <li>
                {{ $studentPlan }}
            </li>
        @endforeach
        </ul>
        </div>
        <div class="col-lg-4 plans-col">
        <div class="plans-btn">
            <!-- <p class="plans-currency">100</p> -->
            <form method="POST" action="{{ route('submitSubscriptionPlans') }}">
                <div class="price monthly">
                    <!-- <div class="amount">10</div> -->
                    <input type="hidden" name="planName" value="premium">
                    <input type="hidden" name="priceId" value="price_1NhvGgA8w9W8KkBmpkoQErQW">
                    <input type="submit" class="amount" value="Premium&#13;&#10;£24.95">
                </div>

            </form>
            <form method="POST" action="{{ route('submitSubscriptionPlans') }}">
                <div class="price yearly hide">
                    <!-- <div class="amount">10</div> -->
                    <input type="hidden" name="planName" value="premiumYearly">
                    <input type="hidden" name="priceId" value="price_1NhvIdA8w9W8KkBmvQfVlxvy">
                    <input type="submit" class="amount" value="Premium&#13;&#10;£280">
                </div>

            </form>
        </div>
        <ul>
        @foreach($premiumPlans as $premiumPlan)
            <li>
                {{ $premiumPlan }}
            </li>
        @endforeach
        </ul>
        </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/subscriptionPlans.js') }}"></script>
@endsection

