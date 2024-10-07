@extends ('layouts.layout')

@section('head')
    <title>Blogs &#8211; Dian</title>
@endsection

@section('content')
    @include('requires.header')
    @include('requires.content-section')
    @include('requires.hashtag')
    <style>
        .blogs-container {
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
            background: #000;
        }

        /* Header/Blog Title */
        .header {
            color: white;
            font-size: 35px;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Create two unequal columns that floats next to each other */
        /* Left column */
        /* .leftcolumn {
                    width: 100%;
                } */

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
            display: flex;
            justify-content: center;
            align-items: center;
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
        }

        .shortDescription {
            color: white;
            font-size: 15px;
        }

        .heading {
            color: white;
            text-align: start;
            font-size: 17px;
            margin-top: 20px;
        }

        .content {
            color: white;
            text-align: start;
            font-size: 15px;
        }

        .title {
            color: white;
        }

        .img {
            margin-top: 20px;
            width: 60%;
        }

        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 800px) {
            .container {
                width: 350px;
                margin: 0 auto;
            }

            .blogs-container {
                margin: 0px;
            }

            /* .leftcolumn,
                    .rightcolumn {
                        width: 100%;
                        padding: 0;
                    } */

            .card {
                padding: 35px 25px;
            }

            .title {
                color: white;
                font-size: 20px;
                text-align: center;
            }

            .img {
                width: 300px;
                height: 200px;
            }

            .content {
                text-align: center;
                margin-top: 15px;
            }
        }
    </style>

    <section>
        <div class="container">
            <div id="activeMenu" value="blogs"></div>
            <div class="blogs-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <?php
                            $data = json_decode($blogs->data, true);
                            ?>
                            <p class="publishingDetails">{{ $data[0]['shortTitle'] }}</p>
                            <h2 class="title">{{ $data[0]['title'] }}</h2>
                            @if ($data[0]['shortDescription'] != '-' || $data[0]['shortDescription'] != '')
                                <h2 class="shortDescription">{{ $data[0]['shortDescription'] }}</h2>
                            @endif
                            @foreach ($data[0]['content'] as $content)
                                @if ($content['image'] != '-')
                                    @php
                                        $imagePath = 'general';
                                        $imageSrc = asset('blogs/blogImages/' . $imagePath . '/' . $content['image'] . '.png');
                                    @endphp

                                    <img style="width: 60%; margin-top: 15px;" src="{{ $imageSrc }}" alt="Image">

                                    {{-- <?php

                                    $imagePath = 'general';

                                    $imageSrc = '../public/blogs/blogImages/' . $imagePath . '/' . $content['image'] . '.png'; ?>
                                    <?php echo '<img style="width: 60%;margin-top: 15px;" src="' . $imageSrc . '" alt="Image">'; ?> --}}
                                    {{-- <!-- <img src=$imageSrc width="800px" height="500px" class="img" alt="" loading="lazy" /> --> --}}
                                @endif

                                @if ($content['heading'] == '-' || $content['heading'] == '')
                                @else
                                    <p class="heading">{{ $content['heading'] }}</p>
                                @endif
                                @if ($content['description'] == '-' || $content['description'] == '')
                                @else
                                    @if (is_array($content['description']))
                                    @else
                                        <p class="content">{!! nl2br(e($content['description'])) !!}</p>
                                    @endif
                                @endif
                            @endforeach



                        </div>
                    </div>


                </div>
            </div>
            <p class="new-content-disclaimer">New content released every month</p>
        </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
@endsection
