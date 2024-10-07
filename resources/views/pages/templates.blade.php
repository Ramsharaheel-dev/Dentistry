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

            .w-100 {
                width: 50% !important;
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
        }

        .save-templates {
            display: none
        }

        .showTemplates {
            width: 14%;
            background: white;
            color: black;
        }
    </style>
@endsection

@section('content')
    <div class="content-body">

        <div class="container-fluid">

            <div class="py-4">
                <button type="button" class="btn2 anek-telugu showTemplates">Select Template</button>
                <button type="button" class="btn2 anek-telugu mr-13 saveTemplates">Save</button>
                {{-- <button type="button" class="btn2 anek-telugu mr-13 ">Save</button> --}}
            </div>
            <div class="row">
                <div class="all-templates">
                    <div class="col-md-12">
                        <div class="bootstrap-badge">
                            <div class="row">
                                @php
                                    $img = 1;
                                @endphp
                                @foreach ($allTemplates as $template)
                                    <div class="col-md-2 col-sm-12 col-xs-12"
                                        style="margin-bottom: 20px; text-align: center;">
                                        <form method="POST" target="_blank" action="{{ route('templateNotes') }}">
                                            @csrf
                                            <input type="hidden" name="templateId" value="{{ $template->id }}" />
                                            <button type="submit" name="templateName" style="display: contents;"
                                                value="{{ $template->title }}">
                                                <div style="position: relative;">
                                                    <img class="w-100" src="{{ asset('images/template/dynamic.png') }}"
                                                        alt="Template Thumbnail">
                                                    <div
                                                        style="position: absolute; bottom: 10px; width: 100%; text-align: center; color: white; font-weight: bold;">
                                                        {{ $template->title }}
                                                    </div>
                                                </div>
                                            </button>
                                        </form>

                                        @php
                                            $img++;
                                        @endphp
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
                <div class="save-templates">
                    <div class="col-md-12">
                        <div class="bootstrap-badge">
                            <p style="color:#a0a0a0; font-size: 22px;">NOTE: All saved templates will delete after 24hours
                            </p>
                            <div class="row">
                                @if (empty($savedTemplates))
                                    <p class="noSavedNotes">No saved notes</p>
                                @else
                                    @foreach ($savedTemplates as $savedTemplate)
                                        <div class="col-md-2 col-sm-12 col-xs-12"
                                            style="margin-bottom: 20px; text-align: center;">
                                            <form method="POST" target="_blank" action="{{ route('templateNotes') }}">
                                                @csrf
                                                <input type="hidden" name="templateId"
                                                    value="{{ $savedTemplate->templateId }}" />
                                                <input type="hidden" name="data" value="{{ $savedTemplate->data }}" />
                                                <input type="hidden" name="templateName"
                                                    value="{{ $savedTemplate->templateName }}" />
                                                <button type="submit" name="templateName" style="display: contents;"
                                                    value="{{ $savedTemplate->templateName }} {{ $savedTemplate->created_at }}">
                                                    <div style="position: relative;">
                                                        <img class="w-100"
                                                            src="{{ asset('images/template/dynamic.png') }}"
                                                            alt="Template Thumbnail">
                                                        <div
                                                            style="position: absolute; bottom: 10px; width: 100%; text-align: center; color: white; font-weight: bold;">
                                                            {{ $savedTemplate->templateName }}<br>

                                                        </div>
                                                    </div>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            // $("#showTemplates").css({
            //     "background": "white",
            //     "color": "black",
            // });
            $(".showTemplates").click(function() {
                $(".all-templates").css({
                    "display": "block"
                });
                $(".showTemplates").css({
                    "background": "white",
                    "color": "black"
                });
                $(".saveTemplates").css({
                    "background": "#102335",
                    "color": "white"
                });
                $(".save-templates").css({
                    "display": "none"
                });
            });

            $(".saveTemplates").click(function() {
                $(".all-templates").css({
                    "display": "none"
                });
                $(".saveTemplates").css({
                    "background": "white",
                    "color": "black"
                });
                $(".showTemplates").css({
                    "background": "#102335",
                    "color": "white"
                });
                $(".save-templates").css({
                    "display": "block"
                });
            });

        });
    </script>
@endsection
