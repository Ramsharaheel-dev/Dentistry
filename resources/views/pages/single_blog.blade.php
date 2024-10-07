@extends ('layouts.layout_2')

@section('head')
    <title>Blog &#8211; Dian</title>
@endsection


@section('content')
    <div class="content-body">

        @include('require_2.hashtag')

        <div class="container">
            <div class="blogs-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                            @php
                                $data = json_decode($blogs->data, true);
                            @endphp

                            <p class="notes1 anek-telugu text-center">{{ $data[0]['shortTitle'] }}</p>
                            <h2 class="speech_to_ text-center">{{ $data[0]['title'] }}</h2>
                            @if ($data[0]['shortDescription'] != '-' || $data[0]['shortDescription'] != '')
                                <p class="step_into_2 anek-telugu text-center">{{ $data[0]['shortDescription'] }}</p>
                            @endif
                            @foreach ($data[0]['content'] as $content)
                                @if ($content['image'] != '-')
                                    <div class="py-4">
                                        @php
                                            $imagePath = 'general';
                                            $imageSrc = asset(
                                                'blogs/blogImages/' . $imagePath . '/' . $content['image'] . '.png',
                                            );
                                        @endphp

                                        <img class="w-100" src="{{ $imageSrc }}" alt="Image">
                                    </div>
                                @endif

                                @if ($content['heading'] == '-' || $content['heading'] == '')
                                @else
                                    <p class="speech_to_ text-center">{{ $content['heading'] }}</p>
                                @endif
                                @if ($content['description'] == '-' || $content['description'] == '')
                                @else
                                    @if (is_array($content['description']))
                                    @else
                                        <p class="step_into_2 anek-telugu text-center">{!! nl2br(e($content['description'])) !!}</p>
                                    @endif
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
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
