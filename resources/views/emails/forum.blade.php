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

@section('head')
    <title>Posts &#8211; Dian</title>
@endsection

@section('content')
    <script>
        var activeUserId = {{ $activeUserId }};
    </script>
    <div class="content-body anek-telugu">
        <div class="container-fluid">
            <div class="row">

                <div class="py-4">
                    <p class="step_into_">Disclaimer: In this section we have created simulation videos of common procedures
                        and issues you may want to use as visual aid to show your patients to help improve the patient
                        experience and allow them to have a better understanding.
                    </p>
                </div>
            </div>
            <div class="bg1">
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
                                        $file_extension = pathinfo($post->media_url, PATHINFO_EXTENSION);

                                        if (in_array($file_extension, ['png', 'jpeg', 'jpg', 'gif', 'webp'])) {
                                            echo '<img class="w-100" src="https://www.dentistryinanutshell.com/dian/' .
                                                $post->media_url .
                                                '" alt="Uploaded Image" >';
                                        } elseif (in_array($file_extension, ['mov', 'webm', 'mp4', 'webM', 'AVI'])) {
                                            echo '<video class="w-100" controls>';
                                            echo '<source src="https://www.dentistryinanutshell.com/dian/' .
                                                $post->media_url .
                                                '" type="video/' .
                                                $file_extension .
                                                '">';
                                            echo 'Your browser does not support the video.';
                                            echo '</video>';
                                        } else {
                                            echo 'Unsupported file type.';
                                        }
                                    @endphp
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


        $('#post-btn').on('click', function() {
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
@endsection
