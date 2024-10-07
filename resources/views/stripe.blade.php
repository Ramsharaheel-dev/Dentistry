@extends ('layouts.layout')

@section('head')
<title>Dian Payment Gateway</title>
@endsection

@section('content')

@include('requires.header-home')
<style>
    .elementor-5 .elementor-element.elementor-element-ad9bb5d>.elementor-container {
        min-height: 0px;
    }

    .stripe {
        background-color: black !important;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 50px 0px;
    }

    h3 {
        color: white;
        font-size: 22px;
    }

    .form-row .form-group label {
        color: white;
    }

    .btn {
        background-color: #d9aa5a !important;
        border: 1px solid #d9aa5a;
    }

    .btn:hover {
        background-color: #d9aa5a !important;
    }

    .panel {
        border: 1px solid #20201f !important;
        padding: 30px 40px;
        background-color: #20201f !important;
        border-radius: 10px;
        padding-top: inherit;
    }

    p {
        margin: 0;
        color: white;
    }

    .form-row {
        margin-bottom: 10px;
    }

    .panel-default>.panel-heading {
        color: #fff;
        background-color: #20201f !important;
        border-color: #20201f !important;
    }

    .container {
        max-width: 100% !important;
    }

    .col-md-offset-3 {
        margin-left: 0% !important;
    }

    .stripe-heading .content {
        color: #a0a0a0;
        text-align: center;
        font-size: 25px;
        padding: 20px 70px;
    }

    .stripe-heading-img {
        margin-bottom: 15px;
    }

    .form-control{
        color:#a0a0a0 !important;
        background-color:#232323 !important;
    }
    @media (max-width: 767px) {
        .stripe-heading .content{
            padding:20px;
        }
        .panel{
            padding:20px;
        }
    }
</style>

<div class="stripe" style="overflow:hidden">
    <div class="container ">
        <div class="row justify-content-md-center">
            <!-- <h3 style="text-align: center;margin-top: 40px;margin-bottom: 40px;">Dian Payment Gateway</h3> -->
            <div class="col-md-6 col-md-offset-3">
                <div class="stripe-heading">
                    <h2 class="elementor-heading-title elementor-size-default" style="display:inline;color:white;font-size:45px;">Join the </h2>
                    <img class="stripe-heading-img" decoding="async" width="300" height="59" src="./images/2023-02-DIAN-Club-300x59.png" class="attachment-medium size-medium wp-image-109" alt="" loading="lazy" srcset="./images/2023-02-DIAN-Club-300x59.png 300w, ./images/2023-02-DIAN-Club.png 370w" sizes="(max-width: 300px) 100vw, 300px" />
                    <p class="content">Get access now for a monthly subscription and cancel at anytime.</p>
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading">
                            <div class="row" style="margin-top: 40px;">
                                <h3 style="color: #fff;">Payment Details</h3>
                                <div>
                                    <p>Plan name : {{ $planName }}</p>
                                    <p>Price : {{ $amount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p><br>
                            </div>
                            @endif
                            <br>
                            <!-- <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                @csrf
                                <div class='form-row row'>
                                    <div class='col-xs-12 col-md-6 form-group required'>
                                        <label class='control-label'>Name on Card</label>
                                        <input required class='form-control' size='4' type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-6 form-group required'>
                                        <label class='control-label'>Card Number</label>
                                        <input required autocomplete='off' class='form-control card-number' size='20' type='text'>
                                    </div>
                                </div>
                                <div class='form-row row'>
                                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                                        <label class='control-label'>CVC</label>
                                        <input required autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Month</label>
                                        <input required class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Year</label>
                                        <input required class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                    </div>
                                </div>
                                <div class='form-row row'>
                                    <div class='col-xs-12 col-md-12 form-group required'>
                                        <label class='control-label'>Coupon code</label>
                                        <input onchange="validate('{{ $coupons }}')" id="coupon" class='form-control' name="couponCode" size='4' type='text'>
                                    </div>
                                </div>
                                {{-- <div class='form-row row'>
                         <div class='col-md-12 error form-group hide'>
                            <div class='alert-danger alert'>Please correct the errors and try
                               again.
                            </div>
                         </div>
                      </div> --}}
                                <div class="form-row row">
                                    <div class="col-xs-12">
                                        <button class="btn btn-primary btn-lg btn-block" id="checkout-button" type="submit">Subscribe Now</button>
                                    </div>
                                </div>
                            </form> -->

                            <a href="{{ route('stripe.post') }}"><button class="btn btn-primary btn-lg btn-block" id="checkout-button" type="submit">Subscribe Now</button></a>
                            <p>By signing in, you agree to our terms and conditions and privacy policy</p>
                            <a href="{{ route('privacyPolicy') }}" style="color: white;text-decoration: underline;">Privacy Policy</a>
                            <a href="{{ route('termsAndConditions') }}" style="color: white;text-decoration: underline;margin-left:5px">Terms and conditions</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('customjs')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
      
      function validate($couponCodes) {
        $coupon = document.getElementById('coupon').value;
        $couponCodes = JSON.parse($couponCodes);
        if ($couponCodes.includes($coupon)) {
            const disableButton = false;
        } else {
            const disableButton = true;
            window.alert("Sorry, The Coupon Code you entered is invalid. Please check and try again!");
        }
        const button = document.getElementById('checkout-button');

        if (disableButton) button.disabled = "disabled";
    }
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });
                console.log($inputs);
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
       
    </script>
    @endsection