@extends ('layouts.layout')

@section('head')
<title>FAQ &#8211; Dian</title>
@endsection

@section('content')

@include('requires.header-home')

<style>
    body{
        overflow-x: hidden;
    }
    .container h2 {
        font-size: 25px;
        color: white;
        margin-top: 25px;
    }

    .faqHeading{
        color: white !important;
        margin-bottom: 20px !important;
    }

    .questions{
        width: 100%;
        padding: 20px 20px !important;
        text-align: left !important;
        background-color: #232323 !important;
        border: none !important;
    }

    .answers{
        margin-bottom: 10px !important;
    }
</style>

<div class="container">
    <div class="elementor-element elementor-element-245ca40 elementor-widget elementor-widget-heading" data-id="245ca40" data-element_type="widget" data-widget_type="heading.default">
        <div class="elementor-widget-container">
            <h2 class="faqHeading elementor-heading-title elementor-size-default">Frequently Asked Questions</h2>
        </div>
    </div>
    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question1" role="button" aria-expanded="false" aria-controls="collapseExample">
        What are the different subscription plans available?
        </a>
    </p>
    <div class="collapse answers" id="question1">
        <div class="card card-body">
        We offer three subscription plans: Started, Student and Premium. Each plan varies in features and pricing to suit your needs.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question2" role="button" aria-expanded="false" aria-controls="collapseExample">
        How do I upgrade or downgrade my subscription?
        </a>
    </p>
    <div class="collapse answers" id="question2">
        <div class="card card-body">
        You can easily upgrade or downgrade your subscription through your account settings. Select the desired plan and follow the instructions provided.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question3" role="button" aria-expanded="false" aria-controls="collapseExample">
        What payment methods do you accept?
        </a>
    </p>
    <div class="collapse answers" id="question3">
        <div class="card card-body">
        We accept credit/debit cards and PayPal for subscription payments.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question4" role="button" aria-expanded="false" aria-controls="collapseExample">
        Is there a free trial period?
        </a>
    </p>
    <div class="collapse answers" id="question4">
        <div class="card card-body">
        Yes, we offer a Starter subscription which gives you access to our blogs, to some downloadable material, access to two free videos and the ability to view discussions within our Forum.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question5" role="button" aria-expanded="false" aria-controls="collapseExample">
        Is there a free trial period?
        </a>
    </p>
    <div class="collapse answers" id="question5">
        <div class="card card-body">
        Yes, we offer a Starter subscription which gives you access to our blogs, to some downloadable material, access to two free videos and the ability to view discussions within our Forum.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question6" role="button" aria-expanded="false" aria-controls="collapseExample">
        Can I cancel my subscription at any time?
        </a>
    </p>
    <div class="collapse answers" id="question6">
        <div class="card card-body">
        Yes, you can cancel your subscription at any time. Your subscription will remain active until the end of the billing cycle.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question7" role="button" aria-expanded="false" aria-controls="collapseExample">
        Do you offer refunds?
        </a>
    </p>
    <div class="collapse answers" id="question7">
        <div class="card card-body">
        No, however you can cancel your subscription at any time. Your subscription will remain active until the end of the billing cycle.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question8" role="button" aria-expanded="false" aria-controls="collapseExample">
        How can I update my billing information?
        </a>
    </p>
    <div class="collapse answers" id="question8">
        <div class="card card-body">
        You can update your billing information by logging into your account and navigating to the billing settings section.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question9" role="button" aria-expanded="false" aria-controls="collapseExample">
        Is my data secure?
        </a>
    </p>
    <div class="collapse answers" id="question9">
        <div class="card card-body">
        Absolutely! We take data security seriously and employ industry-standard encryption and security measures to protect your information. Please view our privacy policy page for more information.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question10" role="button" aria-expanded="false" aria-controls="collapseExample">
        Can I use my subscription on multiple devices?
        </a>
    </p>
    <div class="collapse answers" id="question10">
        <div class="card card-body">
        You can access your subscription on multiple devices by logging in with your Google credentials.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question11" role="button" aria-expanded="false" aria-controls="collapseExample">
        How do I reset my password?
        </a>
    </p>
    <div class="collapse answers" id="question11">
        <div class="card card-body">
        To reset your password, click on the "Forgot Password" link on the login page. You will receive an email with instructions on how to create a new password.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question12" role="button" aria-expanded="false" aria-controls="collapseExample">
        What happens if I miss a payment?
        </a>
    </p>
    <div class="collapse answers" id="question12">
        <div class="card card-body">
        If a payment is missed, we will send you a notification to update your payment information. Your access to the subscription service may be temporarily suspended until the issue is resolved.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question13" role="button" aria-expanded="false" aria-controls="collapseExample">
        Can I share my subscription with others?
        </a>
    </p>
    <div class="collapse answers" id="question13">
        <div class="card card-body">
        Subscriptions are meant for individual use and cannot be shared with others. Each user will need their own subscription. Your account could be suspended if this is breached.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question14" role="button" aria-expanded="false" aria-controls="collapseExample">
        Is there an option for an annual subscription?
        </a>
    </p>
    <div class="collapse answers" id="question14">
        <div class="card card-body">
        Yes, we offer an annual subscription option at a discounted rate. You can choose between monthly and annual billing during the signup process.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question15" role="button" aria-expanded="false" aria-controls="collapseExample">
        What is your cancellation policy?
        </a>
    </p>
    <div class="collapse answers" id="question15">
        <div class="card card-body">
        You can cancel your subscription at any time. Upon cancellation, your access will continue until the end of the current billing period, and you will not be charged for the following period.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question16" role="button" aria-expanded="false" aria-controls="collapseExample">
        Are there any hidden fees?
        </a>
    </p>
    <div class="collapse answers" id="question16">
        <div class="card card-body">
        No, we do not have any hidden fees. All costs associated with the subscription are clearly stated during the signup process.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question17" role="button" aria-expanded="false" aria-controls="collapseExample">
        How can I contact customer support?
        </a>
    </p>
    <div class="collapse answers" id="question17">
        <div class="card card-body">
        You can reach our customer support team by emailing team@dentistryinanutshell.com or using the contact form on our website.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question18" role="button" aria-expanded="false" aria-controls="collapseExample">
        What happens if I want to reactivate my canceled subscription?
        </a>
    </p>
    <div class="collapse answers" id="question18">
        <div class="card card-body">
        f you wish to reactivate a canceled subscription, you can do so by logging into your account and following the prompts to reactivate or sign-up again.
        </div>
    </div>

    <p>
        <a class="btn btn-primary questions" data-bs-toggle="collapse" href="#question19" role="button" aria-expanded="false" aria-controls="collapseExample">
        Do you offer a referral program?
        </a>
    </p>
    <div class="collapse answers" id="question19">
        <div class="card card-body">
        Yes, we have a referral program that rewards you with discounts or other benefits for referring new users to our subscription service. Please contact us on team@dentistryinanutshell.com
        </div>
    </div>


</div>

@endsection