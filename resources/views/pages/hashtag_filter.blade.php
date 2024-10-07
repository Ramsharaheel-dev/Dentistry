@extends ('layouts.layout_2')

@section('head')
    <title>Filter &#8211; Dian</title>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
@section('custom_style')
    <style>
        /* img {
                                                                                                                                            width: 100% !important;
                                                                                                                                        } */

        .assign-borders {
            border: 3px solid #d9aa59;
        }
    </style>
    @if ($activeMenu == 'student')
        <style>
            img {
                width: 100% !important;

            }

            img.student {
                /* filter: grayscale(70%) !important; */
                border-radius: 10px;
                width: 91% !important;
                margin-left: auto;
                margin-right: auto;
                display: block;
                /* margin-left: 15px; */
            }

            /* img.note-img {
                                                                                        width: 33px !important;
                                                                                        position: relative;
                                                                                        z-index: 99999999;
                                                                                        transform: translate(25rem, 3rem);
                                                                                    } */

            .image-wrapper {
                position: relative;
                /* background-color: #FCF8C7; */
                border-radius: 20px;
                padding-top: 13px;
                padding-bottom: 10px;
            }

            /* .note-active {
                            background-color: #FCF8C7;
                            border-radius: 20px;
                        }


                        .note-img.active {
                            background-color: #FCF8C7;
                            border-radius: 20px;
                            padding-top: 13px;
                            padding-bottom: 10px;
                        } */

            /* .note-img.active {
                                background-color: #FCF8C7;
                                border-radius: 20px;
                                padding-top: 13px;
                                padding-bottom: 10px;
                            } */

            .note-img {
                width: 33px !important;
                position: absolute;
                top: 20px;
                right: 34px;
                z-index: 99999999;
            }


            /* Style for modal */
            .modal {
                display: none;
                position: fixed;
                z-index: 9999;
                padding-top: 50px;
                left: 0;
                top: 0;
                /* width: 100% !important; */
                /* height: 100% !important; */
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.9);
                /* background-image: url(/public/student/images/assist/_Posterior_Triangles.jpeg) !important; */
                background-image: url(../../images/student/10.png) !important;
                text-align: center;
                background-repeat: no-repeat;
                background-size: 100% 100%;
            }

            .modal-content {
                margin: auto;
                display: block;
                max-width: 100%;
                /* Ensure image fits within modal width */
                max-height: 100%;
                /* Ensure image fits within modal height */
            }

            .closeModal {
                position: absolute;
                top: 15px;
                right: 34rem;
                color: #ffffff;
                font-size: 40px;
                font-weight: bold;
                cursor: pointer;
            }

            .closeModal:hover,
            .closeModal:focus {
                color: #aaaaaa;
                text-decoration: none;
                cursor: pointer;
            }

            .hidden {
                display: none !important;
                visibility: hidden;
            }

            /* * Hide only visually, but have it available for screenreaders: h5bp.com/v */
            .visuallyhidden {
                border: 0;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            /* * Extends the .visuallyhidden class to allow the element to be focusable * when navigated to via the keyboard: h5bp.com/p */

            .visuallyhidden.focusable:active,
            .visuallyhidden.focusable:focus {
                clip: auto;
                height: auto;
                margin: 0;
                overflow: visible;
                position: static;
                width: auto;
            }

            /* * Hide visually and from screenreaders, but maintain layout */

            .invisible {
                visibility: hidden;
            }

            .clearfix:before,
            .clearfix:after {
                content: " ";
                /* 1 */
                display: table;
                /* 2 */
            }

            .clearfix:after {
                clear: both;
            }

            .noflick {
                perspective: 1000;
                backface-visibility: hidden;
                transform: translate3d(0, 0, 0);
            }

            /* ==========================================================================
                                                                                                                                   Base styles: opinionated defaults
                                                                                                                                   ========================================================================== */
            * {
                box-sizing: border-box;
            }


            ::selection {
                background: #B3D4FC;
                text-shadow: none;
            }

            a:focus {
                outline: none;
            }

            ::-webkit-input-placeholder {
                color: rgba(0, 0, 0, .7);
            }

            textarea {
                resize: none !important;
            }

            :placeholder {
                /* Firefox 18- */
                color: rgba(0, 0, 0, .7);
            }

            /* ==========================================================================
                                                                                                                                   Author's custom styles
                                                                                                                                   ========================================================================== */

            /* #board {
                                                                                                                                            padding: 100px 30px 30px;
                                                                                                                                            margin-top: 40px;
                                                                                                                                            overflow-y: visible;
                                                                                                                                            @extend .noflick;
                                                                                                                                        } */
            .note {
                /* float: left; */
                display: block;
                position: relative;
                padding: 1em;
                /* width: 100%; */
                min-height: 300px;
                margin: 0 0px 0px 0;
                background: linear-gradient(top, rgba(0, 0, 0, .05), rgba(0, 0, 0, .25));
                background-color: #FCF8C7;
                box-shadow: 5px 5px 10px -2px rgba(33, 33, 33, .3);
                transform: rotate(2deg);
                transform: skew(0deg, 0deg);
                transition: transform .15s;
                /* z-index: -1; */
                /* height: 40rem;
                                        bottom: 28rem; */
                border-radius: 20px;
            }

            &.ui-draggable-dragging:nth-child(n) {
                box-shadow: 5px 5px 15px 0 rgba(0, 0, 0, .3);
                transform: scale(1.125) !important;
                z-index: 100;
                cursor: move;
                transition: transform .150s;
            }

            textarea {
                background-color: transparent;
                border: none;
                resize: vertical;
                /* font-family: "Gloria Hallelujah", cursive; */
                width: 100%;
                padding: 5px;
                font-size: 20px;
                height: 20rem;
                /* padding-top: 28rem; */
                border-radius: 20px;
            }

            &:focus {
                outline: none;
                border: none;
                box-shadow: 0 0 5px 1px rgba(0, 0, 0, .2) inset;
            }

            textarea {
                &.title {
                    font-size: 24px;
                    line-height: 1.2;
                    color: #000000;
                    height: 64px;
                    margin-top: 20px;
                    /* border: 1px solid black; */
                    box-shadow: 0 0 5px 1px rgba(0, 0, 0, .2) inset;
                    padding: 13px;
                }
            }

            &.cnt {
                min-height: 200px;
                font-size: 22px;
            }
            }

            &:nth-child(2n) {
                background: #FAAACA;
            }

            &:nth-child(3n) {
                background: #69F098;
            }
            }

            /* Button style  */
            .button {
                font: bold 16px Helvetica, Arial, sans-serif;
                color: #FFFFFF;
                padding: 1em 2em;
                background: linear-gradient(top, rgba(0, 0, 0, .15), rgba(0, 0, 0, .3));
                background-color: #00CC00;
                border-radius: 3px;
                box-shadow: 1px 1px 3px rgba(0, 0, 0, .3), inset 0 -1px 2px -1px rgba(0, 0, 0, .5), inset 0 1px 2px 1px rgba(255, 255, 255, .3);
                text-shadow: 0 -1px 0 rgba(0, 0, 0, .3), 0 1px 0 rgba(255, 255, 255, .3);
                text-decoration: none;
                transition: transform .150s, background .01s;
                @extend .noflick;

                &:hover {
                    background-color: #00EE00;
                    box-shadow:
                        0 0 0 0 rgba(0, 0, 0, .3),
                        inset 0 -1px 2px -1px rgba(0, 0, 0, .5),
                        inset 0 1px 2px 1px rgba(255, 255, 255, .3);
                }

                &:active {
                    background: linear-gradient(bottom, rgba(0, 0, 0, .15), rgba(0, 0, 0, .3));
                    background-color: #00CC00;
                    text-shadow: 0 1px 0 rgba(0, 0, 0, .3), 0 -1px 0 rgba(255, 255, 255, .3);
                    box-shadow: inset 0 1px 2px rgba(0, 0, 0, .3), inset 0 -1px 2px rgba(255, 255, 255, .3);
                    outline: none;
                }

                &.remove {
                    position: absolute;
                    top: 5px;
                    right: 5px;
                    width: 36px;
                    height: 36px;
                    border-radius: 50%;
                    background-color: #E01C12;
                    text-align: center;
                    line-height: 16px;
                    padding: 10px;
                    border-color: #B30000;
                    font-style: 1.6em;
                    font-weight: bolder;
                    font-family: Helvetica, Arial, sans-serif;

                    &:hover {
                        background-color: #EF0005;
                    }
                }
            }

            /* #add_new {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 100;
            } */

            .author {
                position: absolute;
                top: 20px;
                left: 20px;
            }
        </style>
    @endif
    @if (
        $activeMenu != 'student' &&
            $activeMenu != 'workFlows' &&
            $activeMenu != 'guidelines' &&
            $activeMenu != 'healthAndWellbeing')
        <style>
            .custom-btn {
                font-size: 16px !important;
                padding: 13px 40px !important;
                border: 0.1px solid #404040 !important;
                font-weight: 400 !important;
            }

            div#scrollable {
                border: 5px red solid;
                width: 150px;
                height: 200px;
                overflow-y: scroll;
            }

            .background-active {
                background: linear-gradient(90deg, #d9aa59, rgba(65, 86, 83, 8));
            }

            ::-webkit-scrollbar {
                width: 10px;
            }

            ::-webkit-scrollbar-track {
                background: transparent;
            }

            ::-webkit-scrollbar-thumb {
                background: #B79150 !important;
                border-radius: 10px;
            }

            div:hover::-webkit-scrollbar-thumb {
                background: #B79150 !important;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #B79150 !important;
            }

            .btn:hover {
                color: var(--bs-btn-hover-color);
                background: linear-gradient(90deg, #d9aa59, rgba(65, 86, 83, 8));
                border-color: var(--bs-btn-hover-border-color);
            }

            .round {
                position: relative;
            }

            .round label {
                background-color: transparent;
                border: 1px solid #ccc;
                border-radius: 50%;
                cursor: pointer;
                height: 28px;
                position: absolute;
                top: 15px;
                right: 0px;
                width: 28px;
            }

            .round label:after {
                border: 2px solid #000000;
                border-top: none;
                border-right: none;
                content: "";
                height: 6px;
                left: 7px;
                opacity: 0;
                position: absolute;
                top: 8px;
                transform: rotate(-45deg);
                width: 12px;
            }

            .round input[type="checkbox"] {
                visibility: hidden;
            }

            .round input[type="checkbox"]:checked+label {
                background-color: #ffffff;
                border-color: #ffffff;
            }

            .round input[type="checkbox"]:checked+label:after {
                opacity: 1;
            }

            li.jhon-doe:hover {
                width: 100%;
            }

            li a:hover {
                font-size: 30px;
                background: transparent;
            }

            .assign-heading {
                color: #FFF;
                font-size: 28px;
                font-style: normal;
                font-weight: 300;
                line-height: 60px;
                text-transform: capitalize;
            }

            .video-badge {
                position: absolute;
                left: 10px;
                top: 12px;
            }



            .videoContainer {
                position: relative;
            }

            .playVideo {
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

            .float-right {
                float: right;
            }

            .assign-p {
                display: inline-block;
                color: #FFF;
                font-size: 17px;
                font-style: normal;
                font-weight: 400;
                line-height: 20px;
                text-transform: capitalize;
                padding-left: 30px;
            }

            .modal-content {
                border-radius: 30px !important;
                border: 1px solid #B79150 !important;
            }

            .textarea3#comment {
                height: auto !important;
            }

            .fs-22 {
                font-size: 22px;
            }

            input,
            button,
            select,
            optgroup,
            textarea {
                margin: 0;
                font-family: inherit;
                font-size: 23px !important;
                line-height: inherit;
            }

            textarea.cnt {
                font-size: 23px !important;
            }
        </style>
    @endif
@endsection

@section('content')
    <div class="content-body">

        @include('require_2.hashtag')

        <div class="container-fluid">

            <div class="row align-items-start">

                @if ($activeMenu == 'student')
                    <p class="step_into_">Disclaimer: All information provided in this section is provided is by
                        fellow
                        students and has not been verified by DIAN club so information should be used at your discretion</p>

                    {{-- <div class="row">
                            <div class="col-md-12">
                                <a href="javascript:;" class="button" id="add_new">Add New Note</a>
                                <div id="board">
                            </div>
                        </div>
                    </div> --}}
                    @foreach ($finalReels as $key => $finalReel)
                    {{-- {{$key}} --}}
                        @if ($finalReel->name == 'pastPapers')
                            <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                                <div>
                                    @php
                                        $imageSrc = asset('student/past papers/' . $finalReel->thumbnailName);
                                    @endphp

                                    <a href="{{ $finalReel->url }}"><img src="{{ $imageSrc }}" alt="Image"></a>

                                </div>
                            </div>
                        @elseif($finalReel->name == 'images')
                            <div class="col-md-4 col-sm-12 col-xs-12 " style="margin-bottom:20px;">

                                <div class="image-wrapper">
                                    <img style="cursor: pointer" class="note-img" data-target="note_{{ $key }}"
                                        src="{{ asset('images/student/note-edit.png') }}" alt="" />
                                    @php
                                        $imageSrc = asset('student/images/' . $finalReel->thumbnailName);
                                    @endphp
                                    <!-- Image -->
                                    <a href="javascript:;" class="open-modal button">
                                        <img class="student" src="{{ $imageSrc }}" alt="Image">
                                    </a>
                                    <!-- Note section -->
                                    <div class="note-section mt-4" id="note_{{ $key }}" style="display: none;">
                                        <div class="note">
                                            <div class="note_cnt">
                                                <textarea class="note-textarea" data-note-id="{{ $key }}" placeholder="Type..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($finalReel->name == 'lectures')
                            <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                                <div>
                                    @php
                                        $imageSrc = asset('student/lectures/' . $finalReel->thumbnailName);
                                    @endphp

                                    <a href="{{ $finalReel->url }}" download><img class="w-100" src="{{ $imageSrc }}"
                                            alt="Image"></a>

                                </div>
                            </div>
                        @elseif ($finalReel->name == 'Generic Notes')
                        <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                            <div>
                                @php
                                    $imageSrc = asset('student/generic-notes/' . $finalReel->thumbnailName);
                                @endphp

                                <a href="{{ $finalReel->url }}" download><img class="w-100" src="{{ $imageSrc }}"
                                        alt="Image"></a>

                            </div>
                        </div>
                        @else
                            <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                                <div style="padding:56.25% 0 0 0;position:relative;"><iframe src={{ $finalReel->url }}
                                        frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                                        style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                        title="Test"></iframe>
                                </div>
                                <script src="https://player.vimeo.com/api/player.js"></script>
                                <!-- <h1 class="dashboard-name">{{ $finalReel->name }}</h1> -->
                            </div>
                        @endif
                    @endforeach
                @endif

                @if ($activeMenu == 'guidelines')
                    @foreach ($finalReels as $file)
                        <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                            <div>
                                @php
                                    $imageSrc = asset('guidelines/' . $file->thumbnailName);
                                @endphp

                                <a target="_blank" href="{{ $file->url }}">
                                    <img class="w-100" src="{{ $imageSrc }}" alt="Image">
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif

                @if ($activeMenu == 'blogs')
                    @foreach ($finalReels as $blog)
                        <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                            <form id="blogForm" action="{{ route('single-blog') }}" style='display:inline !important;'
                                method="POST">

                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="blogId" class="form-control" value="{{ $blog->id }}">
                                </div>
                                <?php
                                $data = json_decode($blog->data, true);
                                ?>
                                <div class="grid-item">
                                    @php
                                        $imageSrc = asset('blogs/thumbnails/' . $blog->thumbnail);
                                        $blogImgId = 'blogImgId';
                                    @endphp

                                    <img class="w-100" style="cursor:pointer; margin-top:15px;" id="{{ $blogImgId }}"
                                        src=  "{{ $imageSrc }}" alt="Image">
                                    <!-- <h1 class="blogTitle">{{ $data[0]['title'] }}</h1> -->

                                </div>

                            </form>
                        </div>
                    @endforeach
                @else
                    @if ($activeMenu != 'student' && $activeMenu != 'workFlows' && $activeMenu != 'guidelines')

                        @if (
                            $activeMenu != 'student' &&
                                $activeMenu != 'workFlows' &&
                                $activeMenu != 'guidelines' &&
                                $activeMenu != 'healthAndWellbeing')
                            @if (session('privilege') == 3)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="py-4">
                                            <button type="button" class="btn btn-outline-light custom-btn selectVideosBtn"
                                                id="selectVideosBtn">Assign</button>
                                            <p class="assign-p" style="display: none;">Please select the videos you’d like
                                                to assign</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="py-4 float-right">
                                            <button type="button"
                                                class="btn btn-outline-light custom-btn background-active openAssignModalBtn"
                                                style="display: none;">Assign Now</button>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @if (session()->has('filter'))
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="py-4">
                                                <button type="button" id="filterButton"
                                                    class="btn btn-outline-light custom-btn background-active">Filter Assign
                                                    Videos</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endif
                        @php
                            $check =
                                $activeMenu != 'student' &&
                                $activeMenu != 'workFlows' &&
                                $activeMenu != 'guidelines' &&
                                $activeMenu != 'healthAndWellbeing';
                        @endphp
                        @foreach ($finalReels as $finalReel)
                            <div
                                class="col-md-4 col-sm-12 col-xs-12 videoContainer  @if ($check && in_array($finalReel->id, $assignedVideos)) assign-borders @endif">
                                @if ($check)
                                    <div class="round" style="display: none">
                                        <input type="checkbox" class="selectButton" id="checkbox{{ $finalReel->id }}"
                                            data-video-id="{{ $finalReel->id }}" data-src="{{ $finalReel->url }}"
                                            @if ($activeMenu == 'podcast') data-video-type="podcast" @else data-video-type="reel" @endif />
                                        <label class="selectCheckbox" for="checkbox{{ $finalReel->id }}"
                                            style="display: none;"></label>
                                    </div>
                                @endif
                                <div class="mt-5" style="padding:56.25% 0 0 0;position:relative;">
                                    <iframe class="videoIframe" id="videoIframe-{{ $finalReel->id }}"
                                        src="{{ $finalReel->url }}"
                                        @if (
                                            $activeMenu != 'healthAndWellbeing' &&
                                                $activeMenu != 'guidelines' &&
                                                $activeMenu != 'workFlows' &&
                                                $activeMenu != 'student') data-reel-duration="{{ $finalReel->duration }}" @endif
                                        data-video-id="{{ $finalReel->id }}"
                                        @if ($activeMenu == 'podcast') data-video-type="podcast" @else data-video-type="reel" @endif
                                        frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                                        style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                        title="Test"></iframe>
                                    {{-- <h1 class="dashboard-name fs-20">{{ $finalReel->name }}</h1> --}}
                                </div>
                                @if ($check)
                                    <div class="row pt-3">
                                        <div class="col-md-6">
                                            @if (isset($assignedVideosData[$finalReel->id]))
                                                <p class="deadline-fonts">End Time:
                                                    {{ \Carbon\Carbon::parse($assignedVideosData[$finalReel->id]['end_time'])->format('h:i A') }}
                                                </p>
                                                <p class="deadline-fonts2">End Date:
                                                    {{ $assignedVideosData[$finalReel->id]['end_date'] }}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <p class="percentage" id="percentageWatched-{{ $finalReel->id }}">Watched: 0%
                                            </p>

                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <div class="modal fade assignModal" id="assignModal" tabindex="-1" role="dialog"
                            aria-hidden="true"
                            @if ($activeMenu == 'podcast') data-video-type="podcast" @else data-video-type="reel" @endif>
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <form action="" name="assign-form" method="POST">
                                        <div class="modal-body anek-telugu lorem-ipsum-dolor">Assign Video
                                            {{-- <div class="notes2">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                                sed do eiusmod tempor
                                                incididunt ut more labore et dolore magna aliqua. Ut enim ad minim veniam
                                            </div> --}}
                                            <div class="assign-heading py-4">Selected Videos</div>
                                            <div class="row" id="selectedVideosContainer">
                                                <!-- Video items will be dynamically added here -->
                                            </div>
                                            <div class="assign-heading">Assign To</div>
                                            <ul class="userContainer" id="userContainer">
                                            </ul>
                                            <div class="assign-heading py-1 pt-3">Dead Line</div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <input type="date" class="form-control"
                                                            placeholder="Dentist Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <input type="time" class="form-control"
                                                            placeholder="Practice Email">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary assign-btn">Assign Now</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <div class="modal fade surveryFormModal" id="surveryFormModal" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button> --}}
                                    </div>
                                    <form action="#" method="POST" id="survey_form">
                                        @csrf
                                        <input type="hidden" name="videoId" id="modalVideoId" value="">
                                        <input type="hidden" name="userId" id="modalUserId" value="">
                                        <input type="hidden" name="videoType" id="modalVideoType" value="">

                                        <div class="modal-body anek-telugu lorem-ipsum-dolor">Survey for CPD Certificate
                                            <div class="m-4">
                                                <div class="accordion" id="myAccordion">
                                                    <div class="accordion-item">
                                                        <h2 class="anek-telugu fs-22">
                                                            How will this video help your clinical and non clinical skills ?
                                                        </h2>
                                                        <textarea name="question1" class="textarea3 form-control" rows="4" id="comment"></textarea>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="anek-telugu fs-22">
                                                            What is the main point you have learnt ?
                                                        </h2>
                                                        <textarea name="question2" class="textarea3 form-control" rows="4" id="comment"></textarea>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="anek-telugu fs-22">
                                                            In what way will you change or improve your work flow ?
                                                        </h2>
                                                        <div id="collapse3"
                                                            class="accordion-collapse collapse anek-telugu"
                                                            data-bs-parent="#myAccordion">
                                                        </div>
                                                        <textarea name="question3" class="textarea3 form-control" rows="4" id="comment"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                {{-- @if ($activeMenu == 'workFlows')
                    @foreach ($finalReels as $finalReel)
                        <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                            <div class="studentHashtag">
                                <p><?php $imageSrc = '../public/workFlows/' . $selectedHashtagValue . '/' . $finalReel->thumbnailName; ?></p>
                                <p><?php echo '<a href="' . $imageSrc . '" download><img src="' . $imageSrc . '" alt="Image"></a>'; ?></p>
                            </div>
                        </div>
                    @endforeach
                @endif --}}

            </div>
            <div class="row py-4">
                <div class="col-md-12">
                    <button type="button" class="btn1 btn-secondary anek-telugu">New content released every
                        month</button>
                </div>
            </div>

        </div>

    </div>

    <script>
        // Get all elements with the class .note-img
        const noteImages = document.querySelectorAll('.note-img');

        // Loop through each .note-img element
        noteImages.forEach(function(noteImg) {
            // Add click event listener to each .note-img element
            noteImg.addEventListener('click', function() {
                // Toggle the 'active' class on click
                this.classList.toggle('active');
            });
        });
    </script>
    <script>
        // Adding numeric to ID
        var blogForm = document.querySelectorAll("#blogForm");
        var img = document.querySelectorAll("#blogImgId");
        for (var i = 0; i < blogForm.length; i++) {
            blogForm[i].setAttribute("id", "blogForm" + i);
            img[i].setAttribute("blogImgId", "blogForm" + i);
        }

        $('#blogImgId[blogImgId]').click(function() {
            $blogFormId = $(this).attr('blogImgId');
            $("#" + $blogFormId).submit();
        });
    </script>
    <script>
        // Get modal and image elements
        var modal = document.getElementById('imageModal');
        var modalImage = document.getElementById('modalImage');

        // Get all elements that can open modal
        var openModalLinks = document.querySelectorAll('.openModal');

        // Attach click event listener to each link
        openModalLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link behavior

                // Set image source in modal
                // var imageSrc = this.querySelector('img').src;
                // modalImage.src = imageSrc;

                // Display modal
                modal.style.display = 'block';
            });
        });

        // Get the close button for modal
        var closeModal = document.getElementsByClassName('closeModal')[0];

        // Attach click event listener to close button
        closeModal.addEventListener('click', function() {
            // Hide modal
            modal.style.display = 'none';
        });
    </script>


    @if ($activeMenu == 'student')
        @include('require_2.notes_scripts')
    @endif


    @if (
        $activeMenu != 'student' &&
            $activeMenu != 'workFlows' &&
            $activeMenu != 'guidelines' &&
            $activeMenu != 'healthAndWellbeing')
        @include('require_2.video_scripts')
    @endif
@endsection
