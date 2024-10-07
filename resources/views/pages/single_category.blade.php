@extends ('layouts.layout_blank')

@section('head')
    <title>Forum Thread &#8211; Dian</title>
@endsection


@section('custom_style')
    <style>
        .badge-primary {
            background-color: #102335;
            /* padding: 10px; */
        }

        .badge {
            font-size: 18px !important;
            padding-left: 17px;
            padding: 6px 35px !important;
            display: inline-flex;
            margin-right: 18px;
        }

        .deletePost {
            display: flex;
            justify-content: end
        }

        .deletePost a {
            background: black;
            padding: 10px 40px;
            font-size: 20px;
        }

        .thread-bg {
            background: #243748;
            border-radius: 8px;
            padding: 10px 21px;
            margin-bottom: 20px;

        }
        .content-body{
            margin: 20px 6rem !important;
        }
    </style>
@endsection

@section('content')
    <div class="content-body">

        <div class="container-fluid">

            <div class="row">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <div class="pt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="description">
                                        <div class="box ">
                                            <div>
                                                @if (session('privilege') >= '3')
                                                    <div class="row py-3">
                                                        <div class="col-lg-9" style="padding:0">
                                                            <img class="image" src="{{ asset('images/shop/user.png') }}">
                                                            <span class="jhon-doe "
                                                                style="margin-left:5px">{{ $user->name }}</span>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="deletePost">
                                                                <a
                                                                    href="{{ route('delete-forum-question', ['questionId' => $questionId]) }}">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h2 class="jhon-doe">{{ $question->question }}</h2>

                                                    <p class="step_into_" style="margin-bottom:20px;">
                                                        {{ $question->content }}</p>
                                                @else
                                                    <img class="image" src="{{ asset('images/shop/user.png') }}">

                                                    <div class="col-lg-11 py-3  ">
                                                        <span class="jhon-doe"
                                                            style="margin-left:5px">{{ $user->name }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            @foreach ($threads as $thread)
                                                <div class="thread-bg">

                                                    <img class="image" src="{{ asset('images/shop/user.png') }}">
                                                    <div class="col-lg-11 py-3  ">
                                                        <span class="jhon-doe"
                                                            style="margin-left:5px">{{ $thread->userName }}</span>
                                                    </div>
                                                    <div class="col-lg-11">
                                                        <p class="step_into_" style="margin-bottom:20px;">
                                                            {{ $thread->content }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="{{ route('submit-thread') }}" method="POST">
                                                        @csrf
                                                        <div class="input-group search-area">
                                                            <input type="hidden" name="userId"
                                                                value="{{ $user->id }}">
                                                            <input type="hidden" name="questionId"
                                                                value="{{ $question->id }}">
                                                            <input type="text" class="form-control input-default "
                                                                name="content" placeholder="Enter Text Here....">
                                                            <button type="submit" class="btn btn-primary ">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        @endsection
