@extends ('layouts.layout_2')

@section('head')
    <title>Assist &#8211; Dian</title>
@endsection

@section('custom_style')
    <style>
        .videoContainer {
            position: relative;
        }

        .playButton {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: none;
            border: none;
            font-size: 48px;
            /* Adjust the font size as needed */
            color: #fff;
            /* Adjust the color as needed */
            cursor: pointer;
        }

        @media (min-width: 300px) and (max-width: 480px) {

            img,
            svg {
                vertical-align: middle;
                width: 30% !important;
            }
        }
    </style>
@endsection



@section('content')
    <div class="content-body">

        <div class="container-fluid">

            <div class="py-4">
                <button type="button" class="btn3 btn-light anek-telugu">Select Template</button>
                <button type="button" class="btn2  anek-telugu mr-13">Save</button>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="bootstrap-badge">
                        <div class="row">
                            @php
                                $img = 1;
                            @endphp
                            @if (empty($savedTemplates))
                                <p class="noSavedNotes">No saved notes</p>
                            @else
                                @foreach ($savedTemplates as $savedTemplate)
                                    <div class="col-md-2 col-sm-12 col-xs-12" style="margin-bottom: 20px">
                                        <form method="POST" target="_blank" action="{{ route('templateNotes') }}">
                                            @csrf
                                            <input type="hidden" name="templateId" value="{{ $savedTemplate->id }}" />
                                            <button type="submit" name="templateName" style="display: contents;"
                                                value="{{ $savedTemplate->title }}">
                                                <img class="w-100" src="{{ asset('images/template/' . $img . '.png') }}"
                                                    alt="Video Thumbnail">
                                            </button>
                                        </form>

                                        @php
                                            $img++;
                                        @endphp
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
