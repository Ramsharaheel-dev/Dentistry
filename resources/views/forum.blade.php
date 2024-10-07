@extends ('layouts.layout')

@section('head')
    <title>Forum &#8211; Dian</title>
@endsection

@section('content')
    @include('requires.header')
    @include('requires.forum-content-section')

    <style>
        .forum-disclaimer {
            color: #a0a0a0;
        }
        .container {
                    padding: 5px 15px;
                    max-width: 100%;
                }

                .image {
                    width: 65px;
                    align-self: flex-start;
                    border-radius: 50% !important;
                    height: 65px !important;
                    object-fit: cover !important;
                }

                .text {
                    text-align: justify;
                }

                .categories {
                    background-color: #232323;
                    margin: 0 0 20px 0;
                    color: white;
                    border-radius: 10px;
                }

                .categories-question {
                    color: #fafafa;
                    margin-right: 15px;
                    /* margin-top: 15px;
                        margin-bottom: 5px; */
                    display: flex;
                    font-size: 20px;
                }

                .categories-content {
                    color: #fafafa;
                    margin-right: 15px;
                    margin-bottom: 15px;
                    display: flex;
                    font-size: 17px;
                }

                .row {
                    display: flex;
                    align-items: center;
                }
    </style>
    <!-- FORUM CODE -->
    <div class="container text-center">
        <p class="forum-disclaimer">Disclaimer: All information provided in this section is provided is by fellow students
            and has not been verified by DIAN club so information should be used at your discretion</p>
        <div class="row align-items-start">

            <div id="activeMenu" value="forums"></div>
            @foreach ($questions as $question)
                <div class=" container categories">
                    <div class="row">
                        <div class="col-md-12 col-sm-8 col-xs-8" style="display: grid;margin-top: 15px;">
                            <img class="image" src="../storage/app/profile_pics/{{ $question->userProfile }}">
                            <a href="{{ route('single-category', ['questionId' => $question->id]) }}" target="_blank">
                                <div class="text">
                                    <h2 class="categories-question">{{ $question->question }}</h2>
                                    <p class="categories-content" maxlength="50">{{ $question->content }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
