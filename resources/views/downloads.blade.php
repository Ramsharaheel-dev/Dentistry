@extends ('layouts.layout')

@section('head')
    <title>Downloads &#8211; Dian</title>
@endsection

@section('content')
    @include('requires.header')
    @include('requires.content-section')

    <style>
        .downloads-container {
            cursor: pointer;
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
    <div class="downloads-page">
        <div id="activeMenu" value="downloads"></div>
        <div class="row" style="margin-top:10px">

            <?php $i = 0; ?>
            @foreach ($thumbnailFiles as $thumbnailFile)
                <?php $path = './downloads/' . $files[$i]; ?>

                <div class=" col-md-4 col-sm-12 col-xs-12 downloads-container" style="margin-top:20px;">
                    <div style="position:relative;"></div>
                    <a href="{{ $path }}" download>
                        <img src="{{ asset('downloads/thumbnails') . '/' . $thumbnailFile }}" style="margin-bottom:15px" />
                        <!-- <h1 class="downloadFileName" style="text-align: center;">{{ $thumbnailFile }}</h1> -->
                    </a>
                </div>

                <?php $i = $i + 1; ?>
            @endforeach

        </div>
        <p class="new-content-disclaimer">New content released every month</p>
    </div>
@endsection
