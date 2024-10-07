@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.0/css/all.css"/>

<style>

</style>


@section('content')
    <div class="content-body">

        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="bootstrap-badge">
                        <span class="badge badge-primary">Business</span>
                        <span class="badge badge-primary">Finance</span>

                    </div>

                </div>

            </div>

            <div class="container-fluid ">

                <div class="row py-3">

                    <div class="col-md-4">
                        <div class="videoContainer">
                            <img class="w-28" src="{{ asset('images/dashboard/4.png') }}" alt="Video Thumbnail">
                            <button class="playButton"
                                 data-src="https://player.vimeo.com/video/845503149?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479">
                            <script src="https://player.vimeo.com/api/player.js"></script>

                                <img class="" src="{{ asset('images/dashboard/videoicon.png') }}" alt="Video Thumbnail">
                            </button>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="videoContainer">
                            <img class="w-28" src="{{ asset('images/dashboard/5.png') }}" alt="Video Thumbnail">
                            <button class="playButton"
                                 data-src="https://player.vimeo.com/video/845503149?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479">
                            <script src="https://player.vimeo.com/api/player.js"></script>

                                <img class="" src="{{ asset('images/dashboard/videoicon.png') }}" alt="Video Thumbnail">
                            </button>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="videoContainer">
                            <img class="w-28" src="{{ asset('images/dashboard/6.png') }}" alt="Video Thumbnail">
                            <button class="playButton"
                                 data-src="https://player.vimeo.com/video/845503149?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479">
                            <script src="https://player.vimeo.com/api/player.js"></script>

                                <img class="" src="{{ asset('images/dashboard/videoicon.png') }}" alt="Video Thumbnail">
                            </button>

                        </div>
                    </div>
                </div>
                <div class="row py-4">

                    <div class="col-md-4">
                        <div class="videoContainer">
                            <img class="w-28" src="{{ asset('images/dashboard/7.png') }}" alt="Video Thumbnail">
                            <button class="playButton"
                                 data-src="https://player.vimeo.com/video/845503149?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479">
                            <script src="https://player.vimeo.com/api/player.js"></script>

                                <img class="" src="{{ asset('images/dashboard/videoicon.png') }}" alt="Video Thumbnail">
                            </button>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="videoContainer">
                            <img class="w-28" src="{{ asset('images/dashboard/8.png') }}" alt="Video Thumbnail">
                            <button class="playButton"
                                 data-src="https://player.vimeo.com/video/845503149?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479">
                            <script src="https://player.vimeo.com/api/player.js"></script>

                                <img class="" src="{{ asset('images/dashboard/videoicon.png') }}" alt="Video Thumbnail">
                            </button>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="videoContainer">
                            <img class="w-28" src="{{ asset('images/dashboard/9.png') }}" alt="Video Thumbnail">
                            <button class="playButton"
                                data-src="https://player.vimeo.com/fa22c2d6-33bb-4d8a-8823-3b4599c9b267">

                                <img class="" src="{{ asset('images/dashboard/videoicon.png') }}" alt="Video Thumbnail">
                            </button>

                        </div>
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
@endsection
