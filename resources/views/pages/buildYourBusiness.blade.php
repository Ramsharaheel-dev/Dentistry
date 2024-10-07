@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection

<style>
    img {
        width: 100% !important;
    }

    .patientNotesOne {
        background-color: #d9aa5a;
        padding: 30px 10px;
    }

    .patientNamesTwo {
        border: 1px solid #d9aa5a;
        margin: 40px 20px;
        padding: 0px;
        border-radius: 10px;
    }

    .classContent {
        color: white;
    }

    .classContent1 {
        font-size: 30px;
    }

    .classContent2 {
        font-size: 40px;
    }

    .classContent3 {
        font-size: 35px;
    }

    .emailBtn {
        background-color: #102335;
        padding: 10px;
        color: white;
        border-radius: 5px;
        font-size: 25px;
    }

    .lineTag {
        color: white;
        width: 90%;
        margin: 20px !important;
        background-color: white !important;
        border: 1px solid white;
    }

    #financePage {
        display: none;
    }


    @media (max-width: 767px) {
        .patientNamesTwo {
            border: 1px solid #dadada;
            margin: 10px;
            padding: 40px;
            border-radius: 10px;
        }

        .classContent1 {
            font-size: 20px;
        }

        .classContent2 {
            font-size: 25px;
        }

        .classContent3 {
            font-size: 30px;
        }

        .emailBtn {
            font-size: 18px;
        }
    }
</style>

@section('content')
    <div class="content-body">

        @include('require_2.businessAndFinanceHashtag')

        <div class="container-fluid">

            <div class="row" id="buinessPage">
                <div class="row">
                    <div class="financeVidoes">
                        <div class="row">

                            @foreach ($businessReels as $businessReel)
                                <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px">
                                    <div style="padding:56.25% 0 0 0;position:relative;"><iframe src={{ $businessReel->url }}
                                            frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                                            style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                            title="Test"></iframe></div>
                                    <script src="https://player.vimeo.com/api/player.js"></script>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="row py-4">

                    <p class="speech_to_ text-center">1 To 1 Consultation</p>
                    <p class="your_perso pt-4 text-center">Tell Us About Your Business Or Plans</p>
                    <div class="col-md-12">
                        <button type="button" class="btn1 btn-secondary anek-telugu">Email Us Here</button>
                    </div>
                </div>
            </div>

            <div id="financePage">
                <div class="row">
                    <div class="financeVidoes">
                        <div class="row">
                            @foreach ($reels as $reel)
                                <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px">
                                    <div style="padding:56.25% 0 0 0;position:relative;"><iframe src={{ $reel->url }}
                                            frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                                            style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                            title="Test"></iframe></div>
                                    <script src="https://player.vimeo.com/api/player.js"></script>
                                    <!-- <h1 class="dashboard-name">{{ $reel->name }}</h1> -->
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="row py-4">

                    <p class="speech_to_ text-center">1 To 1 Consultation</p>
                    <p class="your_perso pt-4 text-center">Tell Us About Your Business Or Plans</p>
                    <div class="col-md-12">
                        <button type="button" class="btn1 btn-secondary anek-telugu">Email Us Here</button>
                    </div>
                </div>
            </div>


        </div>

    </div>
    <script>
        // /* background: linear-gradient(89deg, rgb(217 170 89) 0%, rgba(217, 170, 89, 1) 0%, rgb(0 0 0 / 0%) 92%) !important; */
        // color: #C19D5E !important;
        $(document).ready(
            function() {
                $("#showBusiness").css({
                    "background": "linear-gradient(89deg, rgb(217, 170, 89) 0%, rgba(217, 170, 89, 1) 0%, rgb(0, 0, 0, 0) 92%)",
                    "color": "#ffffff"
                });
                $("#showFinance").css({
                    "background-color": "#102335"
                });
                $("#showBusiness").click(function() {
                    $("#buinessPage").css({
                        "display": "block"
                    });
                    $("#showBusiness").css({
                        "background": "linear-gradient(89deg, rgb(217, 170, 89) 0%, rgba(217, 170, 89, 1) 0%, rgb(0, 0, 0, 0) 92%)",
                        "color": "#ffffff"
                    });
                    $("#showFinance").css({
                        "background": "#102335"
                    });
                    $("#financePage").css({
                        "display": "none"
                    });
                });

                $("#showFinance").click(function() {
                    $("#buinessPage").css({
                        "display": "none"
                    });
                    $("#showFinance").css({
                        "background": "linear-gradient(89deg, rgb(217, 170, 89) 0%, rgba(217, 170, 89, 1) 0%, rgb(0, 0, 0, 0) 92%)",
                        "color": "#ffffff"
                    });
                    $("#showBusiness").css({
                        "background": "#102335"
                    });
                    $("#financePage").css({
                        "display": "block"
                    });
                });

            });
    </script>
@endsection
