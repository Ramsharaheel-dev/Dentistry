@extends ('layouts.layout')

@section('head')
    <title>Guidelines &#8211; Dian</title>
@endsection

@section('content')
    @include('requires.header')
    @include('requires.content-section')
    @include('requires.hashtag')

    <style>
        .container h2 {
            font-size: 25px;
            color: white;
            margin-top: 25px;
        }

        .downloads-page h2 {
            margin-top: 10px;
            color: white;
        }

        .downloadFileName {
            font-size: 20px;
            color: white;
            text-transform: lowercase;
        }

        .downloadFileName::first-line {
            text-transform: capitalize;
        }

        .downloads-container a:hover {
            color: white;
            text-decoration: none;
        }

        .downloads-container h1 {
            font-size: 17px;
            color: white;
            margin-top: 0px;
            margin-bottom: 30px;
        }
    </style>

    <!-- REELS -->
    <div class="container">

        <div class="text-center">
            <div id="activeMenu" value="guidelines"></div>
            <div class="row" style="margin-top:10px">

                <?php $i = 0; ?>
                @foreach ($fileNames as $file)
                    <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                        <div>
                            <?php $imageSrc = '../public/guidelines/' . $file->thumbnailName; ?>
                            <?php echo '<a target="_blank" href="' . $file->url . '"><img src="' . $imageSrc . '" alt="Image"></a>'; ?>
                        </div>
                    </div>


                    <?php $i = $i + 1; ?>
                @endforeach

            </div>

        </div>
        <p class="new-content-disclaimer">New content released every month</p>
    </div>
@endsection
