@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection
@section('custom_style')
    <style>
        .custom-btn {
            font-size: 16px !important;
            padding: 13px 40px !important;
            border: 0.1px solid #404040 !important;
            font-weight: 400 !important;
        }

        .custom-btn:hover {
            color: white !important;
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

        /* ::-webkit-scrollbar {
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
                            } */

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
            /* font-size: 30px; */
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

        .percentage {
            font-size: 20px;
            color: white;
            font-weight: 600;
            display: flex;
            justify-content: end;
            /* padding-top: 12px; */

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

        textarea#comment {
            font-size: 22px;
            color: white;
        }

        .assign-borders {
            border: 3px solid #d9aa59;
        }
    </style>
@endsection


@section('content')
    <div class="content-body">

        @include('require_2.hashtag')

        <div class="container-fluid ">
            <div class="row">
                <div
                    class="col-md-4 col-sm-12 col-xs-12 videoContainer @if (in_array($reel->id, $assignedVideos)) assign-borders @endif">
                    <div class="round" style="display: none">
                        <input type="checkbox" class="selectButton" id="checkbox{{ $reel->id }}"
                            data-video-id="{{ $reel->id }}" data-src="{{ $reel->url }}" data-video-type="reel" />
                        <label class="selectCheckbox" for="checkbox{{ $reel->id }}" style="display: none;"></label>
                    </div>
                    <div class="mt-5" style="padding:56.25% 0 0 0;position:relative;">
                        <iframe class="videoIframe" id="videoIframe-{{ $reel->id }}" src="{{ $reel->url }}"
                            data-video-id="{{ $reel->id }}" data-video-type="reel" data-reel-duration="{{ $reel->duration }}" frameborder="0"   
                            allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                            style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Test"></iframe>
                        {{-- <h1 class="dashboard-name fs-20">{{ $reel->name }}</h1> --}}
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-6">
                            @if (isset($assignedVideosData[$reel->id]))
                                <p class="deadline-fonts">End Time:
                                    {{ \Carbon\Carbon::parse($assignedVideosData[$reel->id]['end_time'])->format('h:i A') }}
                                </p>
                                <p class="deadline-fonts2">End Date: {{ $assignedVideosData[$reel->id]['end_date'] }}
                                </p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p class="percentage" id="percentageWatched-{{ $reel->id }}">Watched: 0%</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade assignModal" id="assignModal" tabindex="-1" role="dialog" aria-hidden="true"
        data-video-type="reel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <form action="" name="assign-form" method="POST">
                    <div class="modal-body anek-telugu lorem-ipsum-dolor">Lorem ipsum dolor
                        <div class="notes2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut more labore et dolore magna aliqua. Ut enim ad minim veniam</div>
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
                                    <input type="date" class="form-control" placeholder="Dentist Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="time" class="form-control" placeholder="Practice Email">
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

    <div class="modal fade surveryFormModal" id="surveryFormModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
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
                                    <div id="collapse3" class="accordion-collapse collapse anek-telugu"
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
    @include('require_2.video_scripts')
@endsection
