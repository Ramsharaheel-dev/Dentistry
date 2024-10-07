@extends ('layouts.layout')

@section('head')
<title>Contact &#8211; Dian</title>
@endsection

@section('content')

@include('requires.header-home')

<style>
    .aboutus-container{
        text-align:center;
        width:100%;
    }
    .aboutus-container h2 {
        font-size: 25px;
        color: white;
        margin-top: 25px;
    }

    .aboutus-heading {
        display: inline;
    }

    .aboutus-heading,
    .aboutus-heading2 {
        color: white;
        font-size: 61px;
    }

    .aboutus-heading2 {
        margin: 45px 0px 10px 0px;
    }

    .aboutus-heading-img {
        margin-bottom: 15px;
        width: 25%;
    }

    .aboutus-content {
        color: #fff;
        font-size: 27px;
    }

    .aboutus-wrap {
        margin: 40px 0px 30px 0px;
    }

    .aboutus-content-wrap{
        background-color: #d9aa5a;
        color: white !important;
        padding: 15px 60px;
        margin:0 auto;
        width: 50%;
        margin-bottom:20px;
    }

    .aboutus-container a {
        text-decoration: underline;
    }

    .aboutus-container a:hover {
        color: #a0a0a0;
    }

    .team {
        margin: 40px 0px;
    }

    .team-mem-name {
        color: #d9aa5a;
        font-size: 25px;
    }

    .team-mem-designation {
        color: #a0a0a0;
        font-size: 12px;
        margin-bottom: 3px;
    }

    .team-mem-description {
        color: #a0a0a0;
        font-size: 18px;
        margin-top: 15px;
    }
    @media (max-width: 767px) {
        .aboutus-heading,
        .aboutus-heading2 {
            font-size: 35px;
        }
        .aboutus-content-wrap {
            width:90%;
            padding: 15px 40px;
        }
        .aboutus-container h2{
            font-size:30px;
        }
    }
</style>

<div class="aboutus-container">
    <!-- <video width="320" height="240" autoplay controls style="height:auto">
        <source src="{{URL::asset('/images/sample.mp4')}}" type="video/mp4">
        Your browser does not support the video tag.
    </video> -->
    <div class="aboutus-wrap">
        <p class="aboutus-heading">Contact Us </p>

    </div>

    <div class="aboutus-content-wrap">
        <!-- <h2 class="aboutus-heading2">Question</h2> -->
        <p class="aboutus-content">Have a question, concern or complaint? Send your message to <a href="mailto:team@dentistryinanutshell.com">team@dentistryinanutshell.com</a></p>
    </div>

    <div class="aboutus-content-wrap">
        <!-- <h2 class="aboutus-heading2">Collaborator</h2> -->
        <p class="aboutus-content">Keen to get involved and explore working with us? Send your message to <a href="mailto:admin@dentistryinanutshell.com">admin@dentistryinanutshell.com</a></p>
    </div>

    <div class="aboutus-content-wrap">
        <!-- <h2 class="aboutus-heading2">Marketing</h2> -->
        <p class="aboutus-content">Want to advertise your service or product send your message to <a href="mailto:admin@dentistryinanutshell.com">admin@dentistryinanutshell.com</a></p>
    </div>

</div>

@endsection
