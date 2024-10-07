@extends ('layouts.layout')

@section('head')
    <title>Assist &#8211; Dian</title>
    <style>
        .template {
            background-color: #a48234 !important;
            color: white !important;
            padding: 15px !important;
            border-radius: 5px !important;
            font-weight: 400 !important;
        }

        .allTemplates h3 {
            color: white;
        }

        .allTemplatesContainer {
            background-color: #d9aa5a;
            padding: 50px 35px;
        }

        .allTemplateshrTag {
            color: white;
            height: 2px;
            background-color: white !important;
        }

        .row {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .allTemplatesContainer .row h3 {
            color: white;
            font-size: 19px;
            font-weight: 600;
        }

        .noSavedNotes {
            color: white;
            font-weight: 400;
            font-size: 14px;
            font-style: italic;
        }

        .allTemplatesContainer .savedTemplatesContainer,
        {
        display: flex !important;
        gap: 5px;
        }

        .savedTemplatesContainer form {
            margin-bottom: 5px;
        }

        @media (max-width: 767px) {
            .template {
                margin-bottom: 5px !important;
            }

            .allTemplatesContainer .row {
                text-align: center;
            }

                    /* .w-100 {
            width: 50% !important;
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
        } */
        }
    </style>
@endsection

@section('content')

    @include('requires.header')
    @include('requires.content-section')

    <!-- REELS -->
    <div style="width:100%">
        <div id="activeMenu" value="assist"></div>
        <div class="allTemplatesContainer">

            <hr class="allTemplateshrTag">

            <div class="row">
                <div class="col-lg-12">
                    <h3>SAVED NOTES</h3>
                    <div class="savedTemplatesContainer">
                        @if (empty($savedTemplates))
                            <p class="noSavedNotes">No saved notes</p>
                        @else
                            <p style="color:#a0a0a0;">NOTE: All saved templates will delete after 24hours</p>
                            @foreach ($savedTemplates as $savedTemplate)
                                <form method="POST" target="_blank" action="{{ route('templateNotes') }}">
                                    @csrf
                                    <input type="hidden" name="templateId" value="{{ $savedTemplate->templateId }}" />
                                    <input type="hidden" name="data" value="{{ $savedTemplate->data }}" />
                                    <input type="hidden" name="templateName" value="{{ $savedTemplate->templateName }}" />
                                    <input type="submit" class="template"
                                        value="{{ $savedTemplate->templateName }} {{ $savedTemplate->created_at }}" />
                                </form>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>

            <hr class="allTemplateshrTag">
            <div class="row">
                <div class="col-lg-12">
                    <h3>SELECT TEMPLATE</h3>
                    <div class="savedTemplatesContainer">
                        @foreach ($allTemplates as $template)
                            <form method="POST" target="_blank" action="{{ route('templateNotes') }}">
                                @csrf

                                <input type="hidden" name="templateId" value="{{ $template->id }}" />
                                <input type="submit" name="templateName" class="template" value="{{ $template->title }}" />

                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr class="allTemplateshrTag">
        </div>
        <p class="new-content-disclaimer">New content released every month</p>
    </div>

@endsection
