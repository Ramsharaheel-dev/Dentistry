@extends ('layouts.layout_2')

<style>
    .textarea2.form-control {
        min-height: auto !important;
        height: 200px !important;
    }

    .custom-file-upload {
        cursor: pointer;
        display: inline-block;
        padding: 10px 20px;
        /* background-color: #007bff; */
        color: #fff;
        border-radius: 5px;
    }

    .custom-file-upload:hover {
        /* background-color: #0056b3; */
    }

    .pointer {
        cursor: pointer;
    }

    /* Style for comments */
    .comment {
        margin-bottom: 20px;
    }

    .reply {
        margin-left: 20px;
        border-left: 2px solid #F8B940;
        padding-left: 10px;
    }

    .comment-font-size {
        font-size: 16px;
        color: #AEAEAE;
    }

    .fa-trash {
        padding-left: 12px;
        color: #ff6048;
    }

    .w-92 {
        width: 92%;
    }

    [data-theme-version="dark"] .form-control {
        background-color: #0A2844 !important;
    }

    .btn.btn-primary {
        font-size: 15px !important;
        padding: 10px 30px !important;
        border-radius: 7px !important;
    }

    .card1 {
        border-radius: 10px !important;
    }

    hr {
        opacity: 1.25;
        border-color: white !important;
    }

    .time-elapsed {
        font-size: 16px;
        padding-left: 8px;
    }
</style>

<style>
    *,
    *:before,
    *:after {
        /* box-sizing: inherit; */
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        background-color: #ddd;
        font-size: 1rem;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }

    button+button {
        margin-left: 0.75em;
    }

    .upload {
        text-align: center;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .video-box {
        margin-top: 3em;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .player {
        width: 60%;
        max-width: 50rem;
        border: 0.25rem solid rgba(0, 0, 0, 0.445);
        position: relative;
        font-size: 0;
        overflow: hidden;
    }

    .player_video {
        width: 100%;
        cursor: pointer;
    }

    .fa {
        color: white;
        font-size: 1rem;
    }

    .fa-play:hover,
    .fa-pause:hover,
    .fa-stop:hover,
    .fa-volume-up:hover,
    .fa-fast-backward:hover,
    .fa-fast-forward:hover {
        color: dodgerblue;
        cursor: pointer;
    }

    .player_button {
        background: none;
        border: 0;
        line-height: 1;
        color: white;
        text-align: center;
        outline: 0;
        padding: 0;
        cursor: pointer;
        max-width: 50px;
        font-size: 1rem;
    }

    .player_button:focus,
    .player_button:hover {
        border-color: #ffc600;
        border-color: blue;
    }

    .player_slider {
        width: 0.75rem;
        height: 3rem;
    }

    .player_controls {
        display: flex;
        position: absolute;
        bottom: 0;
        width: 100%;
        transform: translateY(100%) translateX(-5px);
        transition: all 0.3s;
        flex-wrap: wrap;
        background: rgba(0, 0, 0, 0.1);
        padding: 0 1.5rem;
    }

    .player:hover .player_controls {
        transform: translateY(0);
    }

    .player:hover .progress-range {
        height: 0.75rem;
    }

    .right-controls {
        display: flex;
        justify-content: flex-end;
    }

    .left-controls {
        display: flex;
        justify-content: flex-start;
    }

    .player_controls>* {
        flex: 1;
    }

    .progress-range {
        flex: 10;
        position: relative;
        display: flex;
        flex-basis: 100%;
        height: 1.5em;
        transition: height 0.3s;
        background: rgba(0, 0, 0, 0.25);
        cursor: pointer;
    }

    .progress-bar {
        background: dodgerblue;
        width: 50%;
        height: 100%;
        border-radius: 1.5em;
        transition: all 250ms ease;
    }

    .player:fullscreen {
        max-width: none;
        width: 100%;
    }

    .player:-webkit-full-screen {
        /*CHROME*/
        max-width: none;
        width: 100%;
    }

    .player:-moz-full-screen {
        /*FIREFOX*/
        max-width: none;
        width: 100%;
    }

    .time {
        text-align: right;
        position: relative;
        top: 0.85em;
        padding-left: 0.5em;
        margin-right: 1em;
        color: white;
        font-weight: 600;
        font-size: 1rem;
        /* user-select: none; */
    }

    .time-elapsed,
    .fa-fast-forward {
        padding-left: 0.75em;
    }

    /**/
    /*css to style input type="range"*/
    input[type='range'] {
        -webkit-appearance: none;
        background: transparent;
        width: 40%;
        margin: 0 20px;
    }

    input[type='range']:focus {
        outline: none;
    }

    input[type='range']::-webkit-slider-runnable-track {
        width: 100%;
        height: 5px;
        cursor: pointer;
        box-shadow: inset 1px 1px 1px rgba(0, 0, 0, 0), 0 0 1px rgba(13, 13, 13, 0);
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50px;
        border: 0.2px solid rgba(1, 1, 1, 0);
    }

    input[type='range']::-webkit-slider-thumb {
        height: 0.75em;
        width: 1em;
        border-radius: 0.25em;
        background: dodgerblue;
        cursor: pointer;
        -webkit-appearance: none;
        margin-top: -4px;
        box-shadow: 0 0 2px rgb(15, 14, 80);
    }

    input[type='range']::-moz-range-track {
        /*?*/
        width: 100%;
        height: 8.4px;
        cursor: pointer;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, 0), 0 0 1px rgba(13, 13, 13, 0);
        background: #ffffff;
        border-radius: 1.3px;
        border: 0.2px solid rgba(1, 1, 1, 0);
    }

    input[type='range']::-moz-range-thumb {
        /*?*/
        box-shadow: 0 0 0 rgba(0, 0, 0, 0), 0 0 0 rgba(13, 13, 13, 0);
        height: 12px;
        width: 17px;
        border-radius: 50px;
        /* background: #ffc600; */
        background: blue;
        cursor: pointer;
    }

    @media (max-width: 827px) {
        .fa {
            color: white;
            font-size: 0.9rem;
        }

        button+button {
            margin-left: 0;
        }

        .time {
            padding-left: 0;
            margin-right: 0.5em;
        }

        .time-elapsed,
        .fa-fast-forward {
            padding-left: 0.75em;
        }

        .player {
            width: 80%;
        }
    }

    @media (max-width: 600px) {
        .player {
            width: 95%;
        }
    }
</style>

@section('head')
    <title>Posts &#8211; Dian</title>
@endsection

@section('content')
    <script>
        var activeUserId = {{ $activeUserId }};
    </script>
    <div class="content-body anek-telugu">
        <div class="container-fluid">
            {{-- <div class="row">

                <div class="py-4">
                    <p class="step_into_">Disclaimer: In this section we have created simulation videos of common procedures
                        and issues you may want to use as visual aid to show your patients to help improve the patient
                        experience and allow them to have a better understanding.
                    </p>
                </div>
            </div> --}}
            <div class="bg1">
                <form id="post-form" enctype="multipart/form-data">
                    <div class="container">
                        <div class="row baseline">
                            <div class="col-md-1">
                                <div class="image-container">
                                    {{-- <img class="" src="http://localhost/dentistry/storage/app/profile_pics/{{ $user->profilePic }}"> --}}
                                    @if ($user->profilePic != ' ' || $user->profilePic !== '-')
                                        <img class=""
                                            src="https://www.dentistryinanutshell.com/dian/storage/app/profile_pics/{{ $user->profilePic }}"
                                            onerror="this.onerror=null; this.src='{{ asset('images/general/profile.png') }}';">
                                    @else
                                        <img class="" src="{{ asset('images/general/profile.png') }}">
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-11">
                                <input class="form-control" id="content" contenteditable="true"
                                    placeholder="What’s happening?">
                                {{-- </div> --}}
                                <div id="selected-file-container"></div>

                            </div>
                        </div>
                        <div class="row mt-2 pt-2">
                            <div class="col-md-5 offset-md-1 text-right">
                                <label for="media" class="custom-file-upload">
                                    <img class="" src="{{ asset('images/forum/file.png') }}">
                                </label>
                                <input id="media" class="media" type="file" name="media" accept="image/*,video/*"
                                    style="display:none;">
                            </div>
                            <div class="col-md-6 text-end">
                                <button type="submit" id="post-btn" class="btn24 anek-telugu">Post</button>
                            </div>
                        </div>
                        <br>

                    </div>

                </form>
            </div>
            <br>
            @foreach ($posts as $post)
                <div class=" py-4">
                    <div class="card1 w-92" style="background-color: #0D1A27 !important">
                        <div class="row" style="align-items: baseline">
                            <div class="col-lg-1 col-md-1 col-sm-6 col-6">
                                <div class="image-container">
                                    <img class="w-h-80"
                                        src="https://www.dentistryinanutshell.com/dian/storage/app/profile_pics/{{ $post->postUserPorfilePic }}"
                                        onerror="this.onerror=null; this.src='{{ asset('images/general/profile.png') }}';">
                                </div>
                            </div>

                            <div class="col-md-10">
                                <div class="panel panel-default admin">
                                    <h4 class="panel-title">
                                        <div class="ab">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <div class="title_wrapper anek-telugu"> <a
                                                        href="{{ route('forum.profile', ['id' => $post->postUserId]) }}"
                                                            target="_blank">{{ $post->postUserName }}</a> @<span
                                                            class="dentist">{{ $post->postUserDesignation ?? '' }}</span>
                                                        <span class="time-elapsed">{{ $post->time_elapsed }}</span>
                                                        @if ($post->postUserId === $activeUserId)
                                                            <i class="fa fa-trash btn-delete-post pointer"
                                                                data-post-id="{{ $post->id }}"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (!empty($post->content))
                                            <p class="dentist anek-telugu">
                                                @php
                                                    $highlightedContent = preg_replace_callback(
                                                        '/#([^ ]+)/',
                                                        function ($matches) {
                                                            return '<span style="color: #D9AA59;">' .
                                                                e($matches[0]) .
                                                                '</span>';
                                                        },
                                                        $post->content,
                                                    );
                                                    echo $highlightedContent;
                                                @endphp
                                            </p>
                                        @endif

                                    </h4>
                                </div>

                                @if (!empty($post->media_url))
                                    @php
                                        $fileExtension = pathinfo($post->media_url, PATHINFO_EXTENSION);
                                        $imageExtensions = ['png', 'jpeg', 'jpg', 'gif', 'webp'];
                                        $videoExtensions = ['mov', 'webm', 'mp4', 'AVI'];
                                    @endphp

                                    @if (in_array($fileExtension, $imageExtensions))
                                        <img class="w-100" src="{{ 'https://www.dentistryinanutshell.com/dian' . $post->media_url }}"
                                            alt="Uploaded Image">
                                    @elseif (in_array($fileExtension, $videoExtensions))
                                        <video class="w-100" controls>
                                            <source src="{{ 'https://www.dentistryinanutshell.com/dian' . $post->media_url }}"
                                                type="video/{{ $fileExtension }}">
                                            Your browser does not support the video.
                                        </video>
                                    @else
                                        Unsupported file type.
                                    @endif
                                @endif

                                <div class="py-sm-3">
                                    <div class="py-sm-3">
                                        <img style="cursor: pointer" class="mw-2 comment-icon"
                                            src="{{ asset('images/forum/comment.png') }}"
                                            data-post-id="{{ $post->id ?? '' }}">&nbsp;
                                        <span style="cursor: pointer" data-post-id="{{ $post->id ?? '' }}"
                                            class="comment-icon-text comment-icon comment-font-size">{{ $post->displayComments }}</span>
                                    </div>
                                </div>


                                <div class="comments-container" id="comments-{{ $post->id ?? '' }}">
                                    <!-- Comments will be loaded here -->
                                </div>

                                <div class="add-comment d-flex">
                                    <input type="text" class="form-control comment-input"
                                        data-post-id="{{ $post->id ?? '' }}" placeholder="Add a comment...">
                                    <button type="button" class="btn btn-primary btn-add-comment"
                                        data-post-id="{{ $post->id ?? '' }}">Post</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach

            {{-- <div class="row" style="align-items: baseline">
                <div class="col-lg-1 col-md-1 col-sm-6 col-6">
                    <img class="w-100 w-50"
                        src="http://localhost/dentistry/storage/app/profile_pics/{{ $post->postUserPorfilePic }}"
                        onerror="this.onerror=null; this.src='{{ asset('images/general/profile.png') }}';">
                </div>

                <div class="col-md-10">
                    <div class="panel panel-default admin">
                        <h4 class="panel-title">
                            <div class="ab">
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="title_wrapper">{{ $post->postUserName }} @<span
                                                class="dentist">{{ $post->postUserDesignation }} 3m</span></div>
                                    </div>
                                </div>
                            </div>
                            <p class="dentist">content here ....</p>
                        </h4>
                    </div>

                    <div class="py-sm-3">
                        <div class="py-sm-3">
                            <img class="mw-2 comment-icon" src="{{ asset('images/forum/comment.png') }}">&nbsp; 1
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
@endsection
@section('customjs')
    @include('require_2.forum_scripts')

    <script>
        let fileInput = document.getElementById('media');
        let label = document.querySelector('.custom-file-upload');

        label.addEventListener('click', function(event) {
            event.preventDefault();
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const fileType = file.type.split('/')[0];
                    let html = '';
                    if (fileType === 'image') {
                        html = '<img src="' + e.target.result +
                            '" alt="Selected Image" class="w-100">';
                    } else if (fileType === 'video') {
                        html = '<video controls  class="w-100"><source src="' + e
                            .target.result + '" type="' + file.type +
                            '">Your browser does not support the video tag.</video>';
                    }
                    document.getElementById("selected-file-container").innerHTML = html;
                }
                reader.readAsDataURL(file);
            }
        });

        fileInput.addEventListener('blur', function() {
            this.value = '';
        });


        document.getElementById('post-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var content = $('#content').val();
            var media = $('.media')[0].files[0];

            var formData = new FormData();

            formData.append('content', content);
            formData.append('media', media);

            Swal.fire({
                title: 'Please Wait...',
                allowOutsideClick: false,
                showConfirmButton: false,
                timer: 4000,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ route('posts.store') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success: function(data) {
                    Swal.close();

                    if (data.status === true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Post Created Successfully!',
                            showConfirmButton: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'There is something wrong!',
                            showConfirmButton: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    Swal.close();
                }
            });
        });
    </script>

    <script>
        /*target elements*/
        const player = document.querySelector('.player');
        const video = player.querySelector('.viewer');

        const progressRange = document.querySelector('.progress-range');
        const progressBar = document.querySelector('.progress-bar');
        const currentTime = document.querySelector('.time-elapsed');
        const duration = document.querySelector('.time-duration');

        const playBtn = document.getElementById('play-btn');
        const stopBtn = player.querySelector('.stop');

        const skipButtons = player.querySelectorAll('[data-skip]');

        const speakerIcon = player.querySelector('#speaker_icon');
        const ranges = player.querySelectorAll('.player_slider');
        /* MUTE button */
        const speaker = player.querySelector('.speaker');
        const volInput = player.querySelector('input[name="volume"]')
        //const speakerIcon = player.querySelector('#speaker_icon');

        // show play button when paused
        function showPlayIcon() {
            playBtn.classList.replace('fa-pause', 'fa-play');
            playBtn.setAttribute('title', 'Play');
        }

        // toggle between play and pause
        function togglePlay() {
            if (video.paused) {
                video.play();
                playBtn.classList.replace('fa-play', 'fa-pause');
                playBtn.setAttribute('title', 'Pause');
            } else {
                video.pause();
                showPlayIcon();
            }
        }

        // Stop video
        function stopVideo() {
            video.currentTime = 0;
            video.pause();
        }

        // not sure, is this for FF and REW?
        function skip() {
            video.currentTime += +(this.dataset.skip);
        }

        // volume functions
        function handleRangeUpdate() {
            video[this.name] = this.value;
            (video['volume'] === 0 ? speakerIcon.className = "fa fa-volume-off" :
                speakerIcon.className = "fa fa-volume-up")
        }

        let muted = false;

        function mute() {
            if (!muted) {
                video['volume'] = 0;
                volInput.value = 0;
                speakerIcon.className = "fa fa-volume-off"
                muted = true;
            } else {
                video['volume'] = 1;
                volInput.value = 1;
                muted = false;
                speakerIcon.className = "fa fa-volume-up"
            }
        }

        // update progress bar as the video plays
        function updateProgress() {
            progressBar.style.width = `${(video.currentTime / video.duration) * 100}%`;
            currentTime.textContent = `${displayTime(video.currentTime)} /`;
            duration.textContent = `${displayTime(video.duration)}`;
        }
        // Calculate display time format
        function displayTime(time) {
            const minutes = Math.floor(time / 60);
            let seconds = Math.floor(time % 60);
            seconds = seconds > 9 ? seconds : `0${seconds}`;
            return `${minutes}:${seconds}`;
        }

        // Click to seek within the video
        function setProgress(e) {
            const newTime = e.offsetX / progressRange.offsetWidth;
            progressBar.style.width = `${newTime * 100}%`;
            video.currentTime = newTime * video.duration;
        }

        function scrub(event) {
            const scrubTime = (event.offsetX / progressRange.offsetWidth) * video.duration;
            video.currentTime = scrubTime;
        }

        // Spacebar used to play and pause
        document.body.onkeyup = function(e) {
            if (e.keyCode == 32) {
                togglePlay();
            }
        }

        // =======================
        video.addEventListener('timeupdate', updateProgress);
        video.addEventListener('canplay', updateProgress);
        progressRange.addEventListener('click', setProgress);
        // ===================
        /*functions linked to elements*/
        // play, pause, stop
        video.addEventListener('click', togglePlay);
        video.addEventListener('keydown', (event) => event.keyCode === 32 && togglePlay());
        playBtn.addEventListener('click', togglePlay);
        stopBtn.addEventListener('click', stopVideo);
        // skip forward or backward
        skipButtons.forEach(button => button.addEventListener('click', skip));
        // volume
        ranges.forEach(range => range.addEventListener('change', handleRangeUpdate));
        ranges.forEach(range => range.addEventListener('mousemove', handleRangeUpdate));
        speaker.addEventListener('click', mute)

        // progress bar controls
        let mouseDown = false;
        progressRange.addEventListener('click', scrub);
        progressRange.addEventListener('mousemove', (event) => mouseDown && scrub(event));
        progressRange.addEventListener('mousedown', () => mouseDown = true);
        progressRange.addEventListener('mouseup', () => mouseDown = false);

        //fullscreen mode
        const screen_size = player.querySelector('.screenSize');
        const controls = player.querySelector('.player_controls');
        const screenSize_icon = player.querySelector('#screenSize_icon');

        function changeScreenSize() {
            if (player.mozRequestFullScreen) {

                player.mozRequestFullScreen();
                //change icon
                screenSize_icon.className = "fa fa-compress";
                /*control panel once fullscreen*/
                video.addEventListener('mouseout', () => controls.style.transform = 'translateY(100%) translateX(-5px)');
                video.addEventListener('mouseover', () => controls.style.transform = 'translateY(0)');
                controls.addEventListener('mouseover', () => controls.style.transform = 'translateY(0)');
                screen_size.addEventListener('click', () => {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                        screenSize_icon.className = "fa fa-expand";
                    }
                });
            } else if (player.webkitRequestFullScreen) {

                player.webkitRequestFullScreen();

                screenSize_icon.className = "fa fa-compress";

                video.addEventListener('mouseout', () => controls.style.transform = 'translateY(100%) translateX(-5px)');
                video.addEventListener('mouseover', () => controls.style.transform = 'translateY(0)');
                controls.addEventListener('mouseover', () => controls.style.transform = 'translateY(0)');
                screen_size.addEventListener('click', () => {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                        screenSize_icon.className = "fa fa-expand";
                    }
                });
            }
        }
        screen_size.addEventListener('click', changeScreenSize);
        /* end full screen */


        /*play rate button - NOT INTERESTED IN THESE CONTROLS */
        // const rate_icon = player.querySelector('.rate_icon')
        // const rateInput = player.querySelector('input[name="playbackRate"]')
        // let rateChanged = false;

        // function changeRate() {
        //   if (!rateChanged) {
        //     video['playbackRate'] = 0.5;
        //     rateInput.value = 0.5;
        //     rateChanged = true;
        //   } else {
        //     video['playbackRate'] = 1;
        //     rateInput.value = 1;
        //     rateChanged = false;
        //   }
        // }

        // rate_icon.addEventListener('click', changeRate)
        /**/
    </script>
@endsection
