@extends ('layouts.layout_blank')

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
            <div class=" py-4">
                <div class="card1 w-92" style="background-color: #0D1A27 !important">
                    <div class="row" style="align-items: baseline">
                        <div class="col-lg-1 col-md-1 col-sm-6 col-6">
                            <div class="image-container">
                                @if ($post->postUserProfilePic != ' ' || $post->postUserProfilePic !== '-')
                                    <img class=""
                                        src="https://www.dentistryinanutshell.com/dian/storage/app/profile_pics/{{ $post->postUserProfilePic }}">
                                @else
                                    <img class="" src="{{ asset('images/general/profile.png') }}">
                                @endif
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
                                        echo '<img class="w-100" src="https://www.dentistryinanutshell.com/dian' .
                                            $post->media_url .
                                            '" alt="Uploaded Image" >';
                                    } elseif (in_array($file_extension, ['mov', 'webm', 'mp4', 'webM', 'AVI'])) {
                                        echo '<video class="w-100" controls>';
                                        echo '<source src="https://www.dentistryinanutshell.com/dian' .
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
        </div>
    </div>
@endsection
@section('customjs')
    @include('require_2.forum_scripts')
@endsection
