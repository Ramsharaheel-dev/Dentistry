@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection

@section('content')
    <div class="content-body">

        <div class="container-fluid ">

            <div class="downloads-page">
                <div id="activeMenu" value="downloads"></div>
                <div class="row" style="margin-top:10px">

                    <?php $i = 0; ?>
                    @foreach ($thumbnailFiles as $thumbnailFile)
                        @php
                            $path = './downloads/' . $files[$i];
                        @endphp

                        <div class="col-md-4 col-sm-12 col-xs-12 downloads-container" style="margin-top:20px;">
                            <div style="position:relative;"></div>
                            <a href="{{ $path }}" download>
                                <img class="w-100" src="{{ asset('downloads/thumbnails') . '/' . $thumbnailFile }}"
                                    style="margin-bottom:15px" />
                                <!-- <h1 class="downloadFileName" style="text-align: center;">{{ $thumbnailFile }}</h1> -->
                            </a>
                        </div>

                        @php
                            $i++;
                        @endphp
                    @endforeach

                </div>
                <div class="row py-4">
                    <div class="col-md-12">
                        <button type="button" class="btn1 btn-secondary anek-telugu">New content released every
                            month</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
