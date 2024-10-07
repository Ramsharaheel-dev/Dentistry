<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Thread</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <style>
        .blogs {
            /* display: flex;
            justify-content: center;
            align-items: center; */
            margin: 50px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial;
            padding: 20px;
            background: #000;
        }

        /* Header/Blog Title */
        .header {
            color: white;
            font-size: 35px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        /* Create two unequal columns that floats next to each other */
        /* Left column */
        .leftcolumn {
            width: 100%;
        }

        /* Right column */
        .rightcolumn {
            float: left;
            width: 25%;
            padding-left: 20px;
        }

        /* Fake image */
        .fakeimg {
            background-color: #aaa;
            width: 100%;
            padding: 20px;
        }

        /* Add a card effect for articles */
        .card {
            background-color: #20201f;
            padding: 60px 100px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Footer */
        .footer {
            padding: 20px;
            text-align: center;
            background: #ddd;
            margin-top: 20px;
        }

        .description {
            color: #dadada;
            font-size: 19px;
            font-weight: 400;
            margin-top: 25px;
        }

        .content {
            color: #dadada;
        }

        .publishingDetails {
            color: white;
            align-self: flex-start;
            margin-bottom: 10px;
        }

        .img {
            margin-top: 20px;
        }

        .threads {
            display: flex;
            padding: 5px 15px;
            background-color: #303030;
            margin-top: 10px;
        }

        .image {
            border-radius: 50% !important;
            height: 55px !important;
            object-fit: cover !important;
            width: 55px !important;
        }

        .row {
            padding: 9px 0px;
            display: flex;
            align-items: center;
        }

        p {
            margin: 0;
        }

        .form {
            margin-top: 20px;
        }

        textarea,
        select,
        input,
        button {
            outline: none;
        }

        .text {
            margin-left: 25px;
        }

        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 800px) {

            .leftcolumn,
            .rightcolumn {
                width: 100%;
                padding: 0;
            }

            .content1 {
                margin-left: 10px;
                margin-top: 5px;
            }

            .col-10 {
                width: 95%;
            }

            .threads {
                padding: 5px 5px;
            }

            .deletePost {
                color: white;
                text-decoration: none;
                background-color: #D70040;
                padding: 10px 20px;
                border-radius: 5px;

            }
        }
    </style>

</head>

<body>


    <section>
        <div class="container">
            <div class="blogs">
                <div class="row">
                    <div class="leftcolumn">
                        <div class="card">
                            <div class="row">
                                <div class="col-lg-1">
                                    <img class="image " src="../../storage/app/profile_pics/{{ $user->profilePic }}">
                                </div>
                                @if ($privilege == '3')
                                    <div class="col-lg-9" style="padding:0">
                                        <span class="content" style="margin-left:5px">{{ $user->name }}</span>
                                    </div>
                                    <div class="col-lg-2" style="padding:0">
                                        <a class="deletePost"
                                            style="color: white;
                                        text-decoration: none;
                                        background-color: #D70040;
                                        padding: 10px 20px;
                                        border-radius: 5px;"
                                            href="{{ route('delete-forum-question', ['questionId' => $questionId]) }}">Delete</a>
                                    </div>
                                @else
                                    <div class="col-lg-11" style="padding:0">
                                        <span class="content" style="margin-left:5px">{{ $user->name }}</span>
                                    </div>
                                @endif
                            </div>
                            <h2 class="header">{{ $question->question }}</h2>

                            <p class="content" style="margin-bottom:20px;">{{ $question->content }}</p>

                            @foreach ($threads as $thread)
                                <div class="threads">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-4 col-xs-4">
                                                <div class="row">
                                                    <div class="col-lg-1">
                                                        <img class="image"
                                                            src="../../storage/app/profile_pics/{{ $thread->userProfile }}">
                                                    </div>
                                                    <div class="col-lg-11" style="padding:0">
                                                        <span class="content"
                                                            style="margin-left:10px">{{ $thread->userName }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-10 col-sm-12 col-xs-12">
                                                <div class="text">
                                                    <p class="content content1">{{ $thread->content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            <div class="form">
                                <!-- SUBSCRIBE FORM -->
                                <form action="{{ route('submit-thread') }}" method="POST">
                                    @csrf
                                    <style>
                                        .elementor-340 .elementor-element.elementor-element-bb9341f>.elementor-widget-container {
                                            margin: 20px 0px 0px 10px;
                                        }

                                        input[type="text"] {
                                            padding-right: 50px;
                                            border-radius: 40px;
                                            width: 50%;
                                            padding: 15px 20px;
                                            background-color: #232323;
                                            color: white;
                                            border: 1px solid white;
                                            margin-top: 15px;
                                            padding-right: 60px;
                                        }

                                        input[type="submit"] {
                                            margin-left: -40px;
                                            width: 85px;
                                            background: #d9aa5a;
                                            color: white;
                                            border-left: 0;
                                            border-radius: 0 40px 40px 0;
                                            -webkit-appearance: none;
                                            padding: 15px;
                                            border: 1px solid white;
                                        }

                                        @media (max-width: 767px) {
                                            .blogs {
                                                margin: 15px 20px;
                                            }

                                            .card {
                                                padding: 35px 25px;
                                            }

                                            body {
                                                padding: 0px !important;
                                            }

                                            input[type="text"] {
                                                width: 100%;
                                                padding: 15px 20px;
                                                margin-top: 15px;
                                                padding-right: 60px;
                                            }

                                            input[type="submit"] {
                                                display: none;
                                            }
                                        }
                                    </style>
                                    <input type="text" name="content" placeholder="Enter text here...">
                                    <input type="hidden" name="userId" value="{{ $user->id }}">
                                    <input type="hidden" name="questionId" value="{{ $question->id }}">
                                    <input type="submit">

                                </form>

                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
</body>

</html>
