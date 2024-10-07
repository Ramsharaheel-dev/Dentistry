@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection

<style>
    .videoContainer {
        position: relative;
    }

    .playButton {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: none;
        border: none;
        font-size: 48px;
        /* Adjust the font size as needed */
        color: #fff;
        /* Adjust the color as needed */
        cursor: pointer;
    }
</style>


@section('content')
    <div class="content-body">

        <div class="container-fluid">
            <div class="row">


                <div class="col-md-12">
                    <div class="bootstrap-badge">
                        <span class="badge badge-primary">Speech To Text</span>
                        <span class="badge badge-primary">Patient Email Sendor</span>
                        <span class="badge badge-primary">Note : Template</span>
                        <span class="badge badge-primary">Patient Explainer Video</span>
                        <span class="badge badge-primary">More</span>


                    </div>


                </div>
                <div class="py-4">
                    <p class="step_into_">Disclaimer: In this section we have created simulation videos of common procedures
                        and issues you may want to use as visual aid to show your patients to help improve the patient
                        experience and allow them to have a better understanding.
                    </p>
                </div>
            </div>

            <div class="container-fluid ">

                <div class="row py-3">

                    <div class="col-md-4">
                        <div class="videoContainer">
                            <img class="w-28" src="{{ asset('images/dashboard/4.png') }}" alt="Video Thumbnail">
                            <button class="playButton"
                                data-src="https://player.vimeo.com/fa22c2d6-33bb-4d8a-8823-3b4599c9b267">

                                <img class="" src="{{ asset('images/dashboard/videoicon.png') }}" alt="Video Thumbnail">
                            </button>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="videoContainer">
                            <img class="w-28" src="{{ asset('images/dashboard/5.png') }}" alt="Video Thumbnail">
                            <button class="playButton"
                                data-src="https://player.vimeo.com/fa22c2d6-33bb-4d8a-8823-3b4599c9b267">

                                <img class="" src="{{ asset('images/dashboard/videoicon.png') }}" alt="Video Thumbnail">
                            </button>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="videoContainer">
                            <img class="w-28" src="{{ asset('images/dashboard/6.png') }}" alt="Video Thumbnail">
                            <button class="playButton"
                                data-src="https://player.vimeo.com/fa22c2d6-33bb-4d8a-8823-3b4599c9b267">

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
                                data-src="https://player.vimeo.com/fa22c2d6-33bb-4d8a-8823-3b4599c9b267">

                                <img class="" src="{{ asset('images/dashboard/videoicon.png') }}" alt="Video Thumbnail">
                            </button>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="videoContainer">
                            <img class="w-28" src="{{ asset('images/dashboard/8.png') }}" alt="Video Thumbnail">
                            <button class="playButton"
                                data-src="https://player.vimeo.com/fa22c2d6-33bb-4d8a-8823-3b4599c9b267">

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
                <div class="col-md-12">
                    <button type="button" class="btn1 btn-secondary anek-telugu">New content released every
                        month</button>
                </div>
            </div>
        </div>

    </div>
@endsection
