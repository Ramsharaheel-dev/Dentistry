@extends ('layouts.layout')

@section('head')
<title>No Desktop Access &#8211; Dian</title>
@endsection

@section('content')

@include('requires.header')
@include('requires.content-section')

<style>
    .container h2 {
        font-size: 25px;
        color: white;
        margin-top: 25px;
    }
    .dashboard-container {
        max-width: 100% !important;
        /* margin-top: 25px; */
    }

    .Title_module_title__c7915904 {
        display: none;
    }

    .dashboard-name {
        font-size: 17px;
        color: white;
        margin-top: 10px;
        margin-bottom: 30px;
        text-align: center;
    }

    @media (max-width: 767px) {
        .container {
            margin-bottom: 100px
        }
    }
</style>
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
    .appWorrkFlows{
        text-align:center;
        margin-top:15px;
    }

    .appWorrkFlows .img1{
        width:20%;
        margin-left:10px;
    }
    .appWorrkFlows .img2{
        width:21%;
        margin-left:10px;
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

<!-- REELS -->
<div class="container dashboard-container text-center">
    <div id="activeMenu" value="{{ $activeMenu }}"></div>
    <div class="row" id="buinessPage">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="patientNotesOne">
            <hr class="lineTag">
                <div class="patientNamesTwo">
                    <p class="classContent classContent1">Please view in app</p>
                </div>
            <hr class="lineTag">
            <div class="appWorrkFlows">
                <img class="img1" src="../public/images/Apple Store.png">
                <img class="img2" src="../public/images/Google play.png">
            </div>
            </div>
        </div>
    </div>
    <!-- <div class="row align-items-start">
       <h3>Please view in app</h3>
    </div> -->
    <p class="new-content-disclaimer">New content released every month</p>
</div>

@endsection