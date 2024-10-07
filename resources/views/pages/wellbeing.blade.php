@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection

@section('content')
    <div class="content-body">

        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="bootstrap-badge">
                        <span class="badge badge-primary">Pain & Injuries</span>
                        <span class="badge badge-primary">Diet & Fitness</span>
                        <span class="badge badge-primary">Mindset</span>

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

            <div class="container-fluid ">

                <div class="row py-4 ">
                    <div class="col-md-12">
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="javascript:void(0)">
                                        <i class="fa fa-angle-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                                <li class="page-item page-indicator">
                                    <a class="page-link" href="javascript:void(0)">
                                        <i class="fa fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
