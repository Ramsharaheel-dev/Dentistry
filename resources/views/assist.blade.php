@extends ('layouts.layout')

@section('head')
<title>Assist &#8211; Dian</title>
<style>
    .assistLayout1, .assistLayout2{
        padding:2px !important;
    }
    .patientNotesOne{
        background-color:#d9aa5a;
        padding:10px;
    }
    .patientNamesTwo{
        margin: 20px;
    }
    .classContent{
        color: white;
        text-align:initial;
    }
    .assistLayout1, .assistLayout2{
        width:45%;
    }

    .classContent1{
        font-size: 20px;
    }
    .classContent2{
        font-size: 30px;
    }
    .classContent3{
        font-size: 35px;
    }
    .lineTag{
        color: white;
        width: 90%;
        margin: 20px !important;
        background-color: white !important;
        border: 1px solid white;
    }
    .assistContent{
        display: flex;
        align-items: center;
    }

    @media (max-width: 767px) {
        .assistLayout1, .assistLayout2{
            width:100%;
        }
        .assistLayout2{
            margin-top: 15px;
        }
        .patientNamesTwo {
            border: 1px solid #dadada;
            margin: 10px;
            padding: 40px;
            border-radius: 10px;
        } 
        .classContent1{
            font-size: 18px;
        }
        .classContent2{
            font-size: 23px;
        }
        .classContent3{
            font-size: 30px;
        }
        .col-md-2, .col-xs-2{
            padding-left:0 !important;
            padding-right:0 !important;
        }
    }
</style>
@endsection

@section('content')

@include('requires.header')
@include('requires.content-section')

<!-- REELS -->
<div class="container text-center">
    <div id="activeMenu" value="assist"></div>
    <p style="color:#a0a0a0">Please access the ASSIST feature only in laptops and desktop computers. We are currently working towards making in available in other form factors like Tablets and mobile and will be available soon!</p>
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-xs-12 assistLayout1">
        <a href="{{ route('speechToTextNotes') }}" target=”_blank”>
            <div class="patientNotesOne">
            <hr class="lineTag">
                <div class="patientNamesTwo">
                    <div class="row assistContent">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <img src="images/custom-recorder.png"/>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <p class="classContent classContent1">NOTES</p>
                            <p class="classContent classContent2">Speech to text</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <img src="images/right-arrow.png"/>
                        </div>
                    </div>
                </div>
                <hr class="lineTag">
            </div>
        </a>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12 assistLayout2">
        <a href="{{ route('emailTemplate') }}" target=”_blank”>
            <div class="patientNotesOne">
            <hr class="lineTag">
                <div class="patientNamesTwo">
                    <div class="row assistContent">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <img src="images/send.png"/>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <p class="classContent classContent1">PATIENT</p>
                            <p class="classContent classContent2">Email Sender</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <img src="images/right-arrow.png"/>
                        </div>
                    </div>
                </div>
                <hr class="lineTag">
            </div>
        </a>
        </div>
    </div>
    <div class="row" style="margin-top:2px">
        <div class="col-lg-6 col-sm-12 col-xs-12 assistLayout1">
        <a href="{{ route('allTemplates') }}">
            <div class="patientNotesOne">
            <hr class="lineTag">
                <div class="patientNamesTwo">
                    <div class="row assistContent">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <img src="images/cursor.png"/>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <p class="classContent classContent1">NOTES</p>
                            <p class="classContent classContent2">Templates</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <img src="images/right-arrow.png"/>
                        </div>
                    </div>
                </div>
                <hr class="lineTag">
            </div>
        </a>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12 assistLayout2">
        <a href="{{ route('assistVideos') }}">
            <div class="patientNotesOne">
            <hr class="lineTag">
                <div class="patientNamesTwo">
                    <div class="row assistContent">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <img src="images/film.png"/>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <p class="classContent classContent1">PATIENT</p>
                            <p class="classContent classContent2">Explainer Videos</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <img src="images/right-arrow.png"/>
                        </div>
                    </div>
                </div>
                <hr class="lineTag">
            </div>
        </a>
        </div>
    </div>
    <p class="new-content-disclaimer">New content released every month</p>
</div>

@endsection