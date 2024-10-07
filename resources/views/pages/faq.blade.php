@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection

<style>


</style>



@section('content')
    <div class="content-body">

        {{-- @include('pages.subheader') --}}


        <div class="container-fluid">

            <div class="row">
                
                <div class="col-md-12">
                    <p class="introducin">Frequently Asked Questions</p>

                    <div class="m-4">
                        <div class="accordion" id="myAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed anek-telugu"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOne">What are the different
                                        subscription plans available?</button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse anek-telugu"
                                    data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <p>We offer three subscription plans: Started, Student and Premium. Each plan varies
                                            in features and pricing to suit your needs.
                                            </a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed anek-telugu"
                                        data-bs-toggle="collapse" data-bs-target="#collapse2">
                                        How do I upgrade or downgrade my subscription?
                                    </button>
                                </h2>
                                <div id="collapse2" class="accordion-collapse collapse anek-telugu"
                                    data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <p>You can easily upgrade or downgrade your subscription through your account
                                            settings. Select the desired plan and follow the instructions provided.

                                            </a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed anek-telugu"
                                        data-bs-toggle="collapse" data-bs-target="#collapse3">

                                        What payment methods do you accept?

                                    </button>
                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse anek-telugu"
                                    data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <p>We accept credit/debit cards and PayPal for subscription payments.
                                            </a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed anek-telugu"
                                        data-bs-toggle="collapse" data-bs-target="#collapse10">
                                        Is there a free trial period?
                                    </button>
                                </h2>
                                <div id="collapse10" class="accordion-collapse collapse anek-telugu"
                                    data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <p>Yes, we offer a Starter subscription which gives you access to our blogs, to some
                                            downloadable material, access to two free videos and the ability to view
                                            discussions within our Forum.

                                            </a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed anek-telugu"
                                        data-bs-toggle="collapse" data-bs-target="#collapse4">

                                        Can I cancel my subscription at any time?

                                    </button>
                                </h2>
                                <div id="collapse4" class="accordion-collapse collapse anek-telugu"
                                    data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <p>Yes, you can cancel your subscription at any time. Your subscription will remain
                                            active until the end of the billing cycle.
                                            </a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed anek-telugu"
                                        data-bs-toggle="collapse" data-bs-target="#collapse20">
                                        Do you offer refunds?
                                    </button>
                                </h2>
                                <div id="collapse20" class="accordion-collapse collapse anek-telugu"
                                    data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <p>No, however you can cancel your subscription at any time. Your subscription will
                                            remain active until the end of the billing cycle.
                                            </a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed anek-telugu"
                                        data-bs-toggle="collapse" data-bs-target="#collapse5">

                                        How can I update my billing information?

                                    </button>
                                </h2>
                                <div id="collapse5" class="accordion-collapse collapse anek-telugu"
                                    data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <p>You can update your billing information by logging into your account and
                                            navigating to the billing settings section.

                                            </a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed anek-telugu"
                                        data-bs-toggle="collapse" data-bs-target="#collapse6">

                                        Is my data secure?

                                    </button>
                                </h2>
                                <div id="collapse6" class="accordion-collapse collapse anek-telugu"
                                    data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <p>
                                            Absolutely! We take data security seriously and employ industry-standard
                                            encryption and security measures to protect your information. Please view
                                            our privacy policy page for more information.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed anek-telugu"
                                        data-bs-toggle="collapse" data-bs-target="#collapse7">
                                        Can I use my subscription on multiple devices?
                                    </button>
                                </h2>
                                <div id="collapse7" class="accordion-collapse collapse anek-telugu"
                                    data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <p>
                                            You can access your subscription on multiple devices by logging in with your
                                            Google credentials.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed anek-telugu"
                                        data-bs-toggle="collapse" data-bs-target="#collapse8">
                                        How do I reset my password?
                                    </button>
                                </h2>
                                <div id="collapse8" class="accordion-collapse collapse anek-telugu"
                                    data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <p>
                                            To reset your password, click on the "Forgot Password" link on the login
                                            page. You will receive an email with instructions on how to create a new
                                            password.

                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed anek-telugu"
                                        data-bs-toggle="collapse" data-bs-target="#collapse9">

                                        What happens if I miss a payment?

                                    </button>
                                </h2>
                                <div id="collapse9" class="accordion-collapse collapse anek-telugu"
                                    data-bs-parent="#myAccordion">
                                    <div class="card-body">
                                        <p>

                                            If a payment is missed, we will send you a notification to update your
                                            payment information. Your access to the subscription service may be
                                            temporarily suspended until the issue is resolved.

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
