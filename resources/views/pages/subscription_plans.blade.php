@extends ('layouts.layout_2')

@section('head')
    <title>Subscription &#8211; Dian</title>
@endsection

@section('custom_style')
    <style>
        @media only screen and (min-device-width: 720px) and (max-device-width: 1280px) {}

        .pt-10 {
            padding-top: 10px;
        }

        .minus-top {
            position: relative;
            top: -14rem;
        }

        .price-btn {
            position: relative;
            top: 8.5rem;
            z-index: 1000;
        }

        .vertical-menu {
            padding-top: 8rem !important;
        }

        .pricing-plans {
            margin-top: -6rem;
            z-index: -1;
            position: absolute;
        }

        .pricing-container {
            position: relative;
            z-index: 20;
        }

        @media (min-width: 300px) and (max-width:480px) {
            .w-17 {
                top: 3% !important;
                display: none;
            }
        }


        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 28px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: transparent;
            -webkit-transition: 0.4s;
            /* box-shadow: 2px 6px 25px #1e2321; */
            transform: translate(0px, 0px);
            transition: 0.6s ease transform, 0.6s box-shadow;
            border: 1px solid rgba(217, 170, 89, 1);
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: 0.4s;
            transition: 0.4s;
        }

        /* input:checked+.slider {
                            background-color: #50bfe6;
                        } */

        /* input:focus+.slider {
                            box-shadow: 0 0 1px #50bfe6;
                        } */

        input:checked+.slider:before {
            -webkit-transform: translateX(29px);
            -ms-transform: translateX(29px);
            transform: translateX(29px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        label {
            font-size: 20px;
            font-weight: 500;
        }
    </style>
@endsection

@section('content')
    <div class="content-body">
        {{-- @include('pages.subheader') --}}

        <div class="container">
            <p class="introducin text-center">Join The Dian Club</p>
            <p class="speech_to_ text-center">Select your plan</p>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <div class="pricing-container">
                        <div class="toggle-buttons text-center">
                            <div>
                                <div class="toggle-btn">
                                    <span class="btn11" style="margin: 0.8em;">Monthly</span>
                                    <label class="switch">
                                        <input type="checkbox" class="form-check-input" id="planSwitch"
                                            onchange="togglePlanSwitch()" />
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="head1" style="margin: 0.8em;">Yearly</span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-switch">
                                <label class="btn11">Monthly</label>
                                <input type="checkbox" class="form-check-input" id="planSwitch"
                                    onchange="togglePlanSwitch()">
                                <label class="head1">Yearly</label>
                            </div> --}}


                        <div class="pricing-plans" id="monthly-plans">
                            <!-- Monthly Plans Content -->
                            <div class="row">
                                <div class="col-md-3">

                                    <div class="text-center ">

                                        <form method="POST" action="{{ route('freeSubscription') }}">
                                            @csrf
                                            <input type="hidden" name="planName" value="starter">
                                            <input type="hidden" name="priceId" value="price_1Nhv8JA8w9W8KkBmoI7T7cnS">
                                            <button type="submit" class="custom-price-btn" style="display: contents;">

                                                <div class=" top-8">

                                                    <p class="step_into_3 anek-telugu">Starter</p>
                                                    <p class="intro1">£0</p>
                                                </div>
                                                <img class="w-17 mtop-5" src="{{ asset('images/assist/cube.png') }}">
                                                {{-- <img class="w-17" src="{{ asset('images/assist/cube.png') }}"> --}}

                                            </button>
                                        </form>
                                    </div>

                                    <div class="vertical-menu">
                                        <div class="height">
                                            <div class="videos2">
                                                @foreach ($starterPlans as $starterPlan)
                                                    <li class="border-bottom pt-10">
                                                        {{ $starterPlan }}
                                                    </li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 pos-static" >

                                    <div class="text-center ">
                                        <form method="POST" action="{{ route('submitSubscriptionPlans') }}">
                                            <input type="hidden" name="planName" value="student">
                                            <input type="hidden" name="priceId" value="price_1OpTujA8w9W8KkBmbs8ILQTI">
                                            <button type="submit" class="custom-price-btn" style="display: contents;">
                                                <div class="top-13">
                                                    <p class="step_into_3 anek-telugu">Student</p>
                                                    <p class="intro1"> <del>£12.99 </del>
                                                    <p class="intro1 top-3">

                                                        £6.99</p>
                                                </div>
                                                <img class="w-12 " src="{{ asset('images/assist/cube.png') }}">
                                            </button>
                                        </form>
                                    </div>

                                    <div class="vertical-menu">
                                        <div class="height">
                                            <div class="videos2">
                                                @foreach ($studentPlans as $studentPlan)
                                                    <li class="border-bottom pt-10">
                                                        {{ $studentPlan }}
                                                    </li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 pos-static">


                                    <div class="text-center ">
                                        <form method="POST" action="{{ route('submitSubscriptionPlans') }}">
                                            <input type="hidden" name="planName" value="premium">
                                            <input type="hidden" name="priceId" value="price_1OpU3TA8w9W8KkBmyisbDP8e">
                                            <button type="submit" class="custom-price-btn" style="display: contents;">
                                                <div class="top-13">
                                                    <p class="step_into_3 anek-telugu">Premium</p>
                                                    <p class="intro1"> <del>£24.99 </del>
                                                    <p class="intro1 top-3">£15.99</p>
                                                </div>
                                                <img class="w-12" src="{{ asset('images/assist/cube.png') }}">
                                            </button>
                                        </form>
                                    </div>

                                    <div class="vertical-menu">
                                        <div class="height">
                                            <div class="videos2">
                                                @foreach ($premiumPlans as $premiumPlan)
                                                    <li class="border-bottom pt-10">
                                                        {{ $premiumPlan }}
                                                    </li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="text-center ">
                                        <form method="POST" action="{{ route('submitSubscriptionPlans') }}">
                                            <input type="hidden" name="planName" value="dentistryOwner">
                                            <input type="hidden" name="priceId" value="price_1OpU7kA8w9W8KkBmOkeiUGvR">
                                            <button type="submit" class="custom-price-btn" style="display: contents;">
                                                <div class="top-8">
                                                    <p class="step_into_3 anek-telugu">Practice Owner</p>
                                                    <p class="intro1">£50.00</p>
                                                </div>
                                                <img class="w-17 mtop-5" src="{{ asset('images/assist/cube.png') }}">
                                            </button>
                                        </form>
                                    </div>

                                    <div class="vertical-menu">
                                        <div class="height">
                                            <div class="videos2">
                                                @foreach ($dentistryOwnerPlans as $dentistryOwnerPlan)
                                                    <li class="border-bottom pt-10">
                                                        {{ $dentistryOwnerPlan }}
                                                    </li>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pricing-plans" id="yearly-plans" style="display: none;">
                            <div class="row">
                                <div class="col-md-3">

                                    <div class="text-center ">
                                        <form method="POST" action="{{ route('freeSubscription') }}">
                                            {{-- <input type="hidden" name="planName" value="starterYearly">
                                            <input type="hidden" name="priceId" value="price_1Nhv8JA8w9W8KkBmoI7T7cnS"> --}}
                                            <button type="submit" class="custom-price-btn" style="display: contents;">
                                                <div class="price-btn">
                                                    <p class="step_into_3 anek-telugu">Starter</p>
                                                    <p class="intro1">£0</p>
                                                </div>
                                                <img class="w-17" src="{{ asset('images/assist/cube.png') }}">
                                                {{-- <img class="w-17" src="{{ asset('images/assist/cube.png') }}"> --}}

                                            </button>
                                        </form>
                                    </div>

                                    <div class="vertical-menu">
                                        <div class="height">
                                            <div class="videos2">
                                                @foreach ($starterPlans as $starterPlan)
                                                    <li class="border-bottom pt-10">
                                                        {{ $starterPlan }}
                                                    </li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="text-center ">
                                        <form method="POST" action="{{ route('submitSubscriptionPlans') }}">
                                            <input type="hidden" name="planName" value="studentYearly">
                                            <input type="hidden" name="priceId" value="price_1OpU18A8w9W8KkBmpX3LbhDK">
                                            <button type="submit" class="custom-price-btn" style="display: contents;">
                                                <div class="price-btn">
                                                    <p class="step_into_3 anek-telugu">Student</p>
                                                    <p class="intro1">£65.00</p>
                                                </div>
                                                <img class="w-17" src="{{ asset('images/assist/cube.png') }}">
                                            </button>
                                        </form>
                                    </div>

                                    <div class="vertical-menu">
                                        <div class="height">
                                            <div class="videos2">
                                                @foreach ($studentPlans as $studentPlan)
                                                    <li class="border-bottom pt-10">
                                                        {{ $studentPlan }}
                                                    </li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center ">
                                        <form method="POST" action="{{ route('submitSubscriptionPlans') }}">
                                            <input type="hidden" name="planName" value="premiumYearly">
                                            <input type="hidden" name="priceId" value="price_1OpU59A8w9W8KkBmdZoIObwq">
                                            <button type="submit" class="custom-price-btn" style="display: contents;">
                                                <div class="price-btn">
                                                    <p class="step_into_3 anek-telugu">Premium</p>
                                                    <p class="intro1">£165.00</p>
                                                </div>
                                                <img class="w-17" src="{{ asset('images/assist/cube.png') }}">
                                            </button>
                                        </form>
                                    </div>

                                    <div class="vertical-menu">
                                        <div class="height">
                                            <div class="videos2">
                                                @foreach ($premiumPlans as $premiumPlan)
                                                    <li class="border-bottom pt-10">
                                                        {{ $premiumPlan }}
                                                    </li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center ">
                                        <form method="POST" action="{{ route('submitSubscriptionPlans') }}">
                                            <input type="hidden" name="planName" value="dentistryOwnerYearly">
                                            <input type="hidden" name="priceId" value="price_1OpU8TA8w9W8KkBmVi2rLV4s">
                                            <button type="submit" class="custom-price-btn" style="display: contents;">
                                                <div class="price-btn">
                                                    <p class="step_into_3 anek-telugu">Practice Owner</p>
                                                    <p class="intro1">£525.00</p>
                                                </div>
                                                <img class="w-17" src="{{ asset('images/assist/cube.png') }}">
                                            </button>
                                        </form>
                                    </div>

                                    <div class="vertical-menu">
                                        <div class="height">
                                            <div class="videos2">
                                                @foreach ($dentistryOwnerPlans as $dentistryOwnerPlan)
                                                    <li class="border-bottom pt-10">
                                                        {{ $dentistryOwnerPlan }}
                                                    </li>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            togglePlanSwitch();
        });

        function togglePlanSwitch() {
            const planSwitch = document.getElementById('planSwitch');
            const isChecked = planSwitch.checked;
            const monthlyPlans = document.getElementById('monthly-plans');
            const yearlyPlans = document.getElementById('yearly-plans');

            if (isChecked) {
                yearlyPlans.style.display = 'block';
                monthlyPlans.style.display = 'none';
            } else {
                monthlyPlans.style.display = 'block';
                yearlyPlans.style.display = 'none';
            }
        }
    </script>
@endsection

@section('customjs')
    {{-- <script>
        function check() {
            var checkBox = document.getElementById("checbox");
            var text1 = document.getElementsByClassName("text1");
            var text2 = document.getElementsByClassName("text2");

            for (var i = 0; i < text1.length; i++) {
                if (checkBox.checked == true) {
                    text1[i].style.display = "block";
                    text2[i].style.display = "none";
                } else if (checkBox.checked == false) {
                    text1[i].style.display = "none";
                    text2[i].style.display = "block";
                }
            }
        }
        check();
    </script> --}}
@endsection
