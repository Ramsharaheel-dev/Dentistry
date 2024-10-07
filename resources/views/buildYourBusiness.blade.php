@extends ('layouts.layout')

@section('head')
<title>Business &#8211; Dian</title>
<style>
    .patientNotesOne{
        background-color:#d9aa5a;
        padding:30px 10px;
    }
    .patientNamesTwo{
        border: 1px solid #d9aa5a;
        margin: 40px 20px;
        padding: 0px;
        border-radius: 10px;
    }
    .classContent{
        color: white;
    }
    .classContent1{
        font-size: 30px;
    }
    .classContent2{
        font-size: 40px;
    }
    .classContent3{
        font-size: 35px;
    }
    .emailBtn{
        background-color: #232323;
        padding: 10px;
        color:white;
        border-radius: 5px;
        font-size: 25px;
    }

    .lineTag{
        color: white;
        width: 90%;
        margin: 20px !important;
        background-color: white !important;
        border: 1px solid white;
    }

    #financePage{
        display:none;
    }


    @media (max-width: 767px) {
        .patientNamesTwo {
            border: 1px solid #dadada;
            margin: 10px;
            padding: 40px;
            border-radius: 10px;
        }
        .classContent1{
            font-size: 20px;
        }
        .classContent2{
            font-size: 25px;
        }
        .classContent3{
            font-size: 30px;
        }
        .emailBtn{
            font-size:18px;
        }
    }
</style>
@endsection

@section('content')

@include('requires.header')
@include('requires.content-section')
@include('requires.businessAndFinanceHashtag')

<!-- REELS -->
<div class="container text-center" style="margin-top:50px;max-width:100% !important">
    <div id="activeMenu" value="buildYourBusiness"></div>
    <div class="row" id="buinessPage">
    <div class="row">
            <div class="financeVidoes">
                @foreach($businessReels as $businessReel)
                <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px">
                    <div style="padding:56.25% 0 0 0;position:relative;"><iframe src={{ $businessReel->url }} frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Test"></iframe></div>
                    <script src="https://player.vimeo.com/api/player.js"></script>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="patientNotesOne">
            <hr class="lineTag">
                <div class="patientNamesTwo">
                    <p class="classContent classContent1">1-TO-1 CONSULTATION</p>
                    <p class="classContent classContent2">Tell us about your <br> business or plans</p>
                    <a href="mailto:noreply@dentistryinanutshell.com?subject=About business or plans"><p class="classContent emailBtn">Email us here</p></a>
                </div>
                <hr class="lineTag">
            </div>
        </div>
    </div>

    <div id="financePage">
        <div class="row">
            <div class="financeVidoes">
                @foreach($reels as $reel)
                <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px">
                    <div style="padding:56.25% 0 0 0;position:relative;"><iframe src={{ $reel->url }} frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Test"></iframe></div>
                    <script src="https://player.vimeo.com/api/player.js"></script>
                    <!-- <h1 class="dashboard-name">{{ $reel->name }}</h1> -->
                </div>
                @endforeach
            </div>
        </div>

        <div class="row" id = "">

            <div class="col-lg-12 col-sm-12 col-xs-12">

                <div class="patientNotesOne">
                <hr class="lineTag">
                    <div class="patientNamesTwo">
                        <p class="classContent classContent1">1-TO-1 CONSULTATION</p>
                        <p class="classContent classContent2">Get financial advice <br> and guidance</p>
                        <a href="mailto:noreply@dentistryinanutshell.com?subject=Financial advice and guidance"><p class="classContent emailBtn">Email us here</p></a>
                    </div>
                    <hr class="lineTag">
                </div>
            </div>
        </div>
        <p class="new-content-disclaimer">New content released every month</p>
    </div>
</div>
<script>
$(document).ready(
    function(){
        $("#showBusiness").css({"background-color":"#d9aa5a"});
        $("#showFinance").css({"background-color":"#232323"});
        $("#showBusiness").click(function () {
            $("#buinessPage").css({"display":"block"});
            $("#showBusiness").css({"background-color":"#d9aa5a"});
            $("#showFinance").css({"background-color":"#232323"});
            $("#financePage").css({"display":"none"});
        });

        $("#showFinance").click(function () {
            $("#buinessPage").css({"display":"none"});
            $("#showFinance").css({"background-color":"#d9aa5a"});
            $("#showBusiness").css({"background-color":"#232323"});
            $("#financePage").css({"display":"block"});
        });

    });
</script>
@endsection
