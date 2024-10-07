@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection

<style>
    /* img,
    svg {
        vertical-align: middle;
        width: 100% !important;
    } */
</style>

@section('content')
    <div class="content-body">

        @include('require_2.hashtag')

        <div class="container-fluid">
            <div class="row" style="margin-top:10px">

                @php $i = 0; @endphp
                @foreach ($fileNames as $file)
                    <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                        <div>
                            @php $imageSrc  = asset('guidelines/' . $file->thumbnailName); @endphp
                            <a target="_blank" href="{{ $file->url }}"><img class="w-100" src="{{ $imageSrc }}" alt="Image"></a>
                        </div>
                    </div>
                    @php $i++; @endphp
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
@endsection
