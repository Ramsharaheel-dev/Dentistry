@extends ('layouts.layout_2')

@section('head')
    <title>Patient Notes &#8211; Dian</title>
@endsection

@section('custom_style')
    <style>
        .please_acc {
            font-size: 18px;
            font-weight: 400;
            color: rgba(255, 255, 255, 1);
            line-height: 26px;
        }

        li {
            display: inline-block;

        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        li.noti {
            display: block;
        }

        .card-body1 {
            padding-left: 21.25px;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #B79150 !important;
            border-radius: 10px;
        }

        div:hover::-webkit-scrollbar-thumb {
            background: #B79150 !important;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #B79150 !important;
        }

        .background-active {
            background: linear-gradient(90deg, #d9aa59, rgba(65, 86, 83, 8));
        }

        td h3 {
            font-size: 18px;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .template-p {
            font-size: 18px;
            font-weight: 400;
            color: rgba(183, 183, 183, 1);
        }

        .discussion {
            position: relative;
            left: -94%;
            width: 3rem;
            bottom: 18px;
        }
    </style>
    <style>
        table {
            /* font-family: arial, sans-serif; */
            border-collapse: collapse;
            width: 100%;
        }

        .btn5 {
            padding: 11px 16px 7px;
            border-radius: 10px;
            font-weight: 400;
            font-size: 16px;
            line-height: 20px;
            border-color: transparent;
            width: auto;
            background-color: #102335;
            color: white;
        }

        h1,
        .h1,
        h2,
        .h2,
        h3,
        .h3,
        h4,
        .h4,
        h5,
        .h5,
        h6,
        .h6 {

            margin-bottom: -0.5rem !important;
        }

        .fs-17 {
            color: white;
            font-size: 17px;
            margin-bottom: 0px !important;
        }

        td,
        tbody,
        thead,
        tr,
        th {
            border: 1px solid #dddddd !important;
            text-align: left;
            padding: 8px;
        }

        [data-theme-version="dark"] .table thead th {
            border-color: #dddddd !important;
        }

        tr:nth-child(even) {
            /* background-color: #dddddd; */
        }
    </style>
@endsection

@section('content')
    <div class="content-body">

        <div class="container-fluid">
            @php
                $count = 0;
            @endphp
            <form method="post" action="{{ route('savePatientNotes') }}">
                @csrf
                <input type="hidden" name="templateId" value="{{ $templateId }}">
                <input type="hidden" name="templateName" value="{{ $templateName }}">
                <textarea style="width:100%;display:none" id="transcription" name="emailContent" rows="5" cols="50"></textarea>
                @php $title = 0; @endphp
                <p class="template-p">Disclaimer: We are aware that the template has not been updated. It should be updated
                    within the next two weeks. Thank you for your understanding.</p>

                @foreach ($data as $titleContent)
                    <div class="card1" id="card-title-1" style="margin-bottom: 20px;">
                        <div class="card-header border-0 pb-0 ">
                            <p class="speech_to_1">{{ $titleContent['title'] }}</p>
                        </div>
                        @php
                            $heading = 0;
                            $title++;
                            $titleId = 't' . $title;
                        @endphp
                        <div class="card-body1">
                            <ul class="py-1">
                                <input question="{{ $titleContent['title'] }}" dataType="title"
                                    uniqName="{{ $titleId }}" title="{{ $titleContent['title'] }}" type="hidden">

                                @if (array_key_exists('headings', $titleContent))
                                    @foreach ($titleContent['headings'] as $headingTitle)
                                        @php
                                            $subHeading = 0;
                                            $heading++;
                                            $headingId = $titleId . '-h' . $heading;
                                            $selectContent = ''; // Initialize $selectContent with an empty string
                                        @endphp

                                        @if (isset($headingTitle['heading']))
                                            <div style="display: inline-block">
                                                <li>
                                                    <p class="please_acc anek-telugu pr-10">
                                                        {{ $headingTitle['heading'] }}
                                                    </p>
                                                </li>
                                            </div>
                                        @endif

                                        @if (isset($headingTitle['content']))
                                            @if ($headingTitle['content'] == 'InputText')
                                                @if ($headingTitle['heading'] == 'Comments:')
                                                    <br>
                                                    <li class="w-80">
                                                        <input title="{{ $titleContent['title'] }}" content="InputText"
                                                            uniqName="{{ $headingId }}" dataType="comments"
                                                            question="{{ $headingTitle['heading'] }}"
                                                            typeVal="speechToText" class="form-control" id='output'
                                                            type="text" name="" placeholder="Insert Comments">
                                                    <li><img style="cursor: pointer" class="left-2" id="toggleButton"
                                                            onclick="recordNow(event)"
                                                            src="{{ asset('images/open-mic.png') }}"></li>
                                                    </li>
                                                @else
                                                    <br>
                                                    <li class="w-80">
                                                        <input title="{{ $titleContent['title'] }}" content="InputText"
                                                            uniqName="{{ $headingId }}"
                                                            question="{{ $headingTitle['heading'] }}"
                                                            typeVal="speechToText" class="form-control" id='output'
                                                            type="text" name="" placeholder="Insert Comments">
                                                    <li><img style="cursor: pointer" class="left-2 toggleButton"
                                                            id="toggleButton" onclick="recordNow(event)"
                                                            src="{{ asset('images/open-mic.png') }}"> </li>
                                                    </li>
                                                @endif
                                            @elseif ($headingTitle['content'] == 'longText')
                                                <br>
                                                <li class="w-80">
                                                    <textarea title="{{ $titleContent['title'] }}" content="InputText" uniqName="{{ $headingId }}" dataType="comments"
                                                        question="{{ $headingTitle['heading'] }}" typeVal="speechToText" class="form-control" id='output' type="text"
                                                        name="" placeholder="Insert"></textarea>
                                                <li><img style="cursor: pointer" class="discussion" id="toggleButton"
                                                        onclick="recordNow(event)"
                                                        src="{{ asset('images/open-mic.png') }}"></li>
                                                </li>
                                            @elseif ($headingTitle['content'] == 'table')
                                                <table id="myTable">
                                                    <tr>
                                                        <th>Ref Pt</th>
                                                        <th>Patent</th>
                                                        <th>EWL</th>
                                                        <th>CWL</th>
                                                        <th>MAF</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3>incisal edge</h3>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button type="button"
                                                                        class="btn5 anek-telugu mr-13 selectOption">Yes</button>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button type="button"
                                                                        class="btn5 anek-telugu mr-13 selectOption">No</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-7">
                                                                    <input type="text" class="form-control"
                                                                        name="ewl_1">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="cwl_1">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <p class="fs-17">(K) at</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="cwl_mm_1">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="maf_mm_1">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="maf_k_1">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">K</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3>mb mbc</h3>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button type="button"
                                                                        class="btn5 anek-telugu mr-13 selectOption">Yes</button>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button type="button"
                                                                        class="btn5 anek-telugu mr-13 selectOption">No</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-7">
                                                                    <input type="text" class="form-control"
                                                                        name="ewl_2">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="cwl_2">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <p class="fs-17">(K) at</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="cwl_mm_2">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="maf_mm_2">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="maf_k_2">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">K</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3>ml mlc</h3>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button type="button"
                                                                        class="btn5 anek-telugu mr-13 selectOption">Yes</button>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button type="button"
                                                                        class="btn5 anek-telugu mr-13 selectOption">No</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-7">
                                                                    <input type="text" class="form-control"
                                                                        name="ewl_3">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="cwl_3">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <p class="fs-17">(K) at</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="cwl_mm_3">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="maf_mm_3">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="maf_k_3">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">K</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3>d dbc</h3>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button type="button"
                                                                        class="btn5 anek-telugu mr-13 selectOption">Yes</button>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button type="button"
                                                                        class="btn5 anek-telugu mr-13 selectOption">No</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-7">
                                                                    <input type="text" class="form-control"
                                                                        name="ewl_4">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="cwl_4">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <p class="fs-17">(K) at</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="cwl_mm_4">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="maf_mm_4">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="maf_k_4">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">K</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3>p mpc</h3>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button type="button"
                                                                        class="btn5 anek-telugu mr-13 selectOption">Yes</button>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button type="button"
                                                                        class="btn5 anek-telugu mr-13 selectOption">No</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-7">
                                                                    <input type="text" class="form-control"
                                                                        name="ewl_5">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="cwl_5">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <p class="fs-17">(K) at</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="cwl_mm_5">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row align-items-center">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="maf_mm_5">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">mm</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="maf_k_5">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="fs-17">K</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            @else
                                                @php
                                                    $selectContent = implode(', ', $headingTitle['content']);
                                                @endphp
                                                @foreach ($headingTitle['content'] as $content)
                                                    <div style="display: inline-block">
                                                        <li class="mr-13 mb-10">
                                                            <button type="button"
                                                                class="btn5 anek-telugu mr-13 selectOption {{ $content }}"
                                                                value="{{ $content }}"
                                                                title="{{ $titleContent['title'] }}"
                                                                content="{{ $selectContent }}"
                                                                uniqName="{{ $headingId }}" dataType="content"
                                                                question="{{ isset($headingTitle['heading']) ? $headingTitle['heading'] : '' }}"
                                                                id="myData">{{ $content }}</button>
                                                        </li>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <br>
                                        @endif
                                        <br>

                                        {{-- Handle subHeadings --}}
                                        @if (isset($headingTitle['subHeadings']))
                                            @foreach ($headingTitle['subHeadings'] as $subHeading)
                                                @php
                                                    if (is_array($subHeading)) {
                                                        $subHeadingId = $headingId . '-sh' . $loop->index;
                                                    } else {
                                                        $subHeadingId = $headingId . '-sh' . $subHeading;
                                                    }
                                                @endphp
                                                <div style="display: inline-block">
                                                    <li class="please_acc anek-telugu pr-10">
                                                        {{ $subHeading['subHeading'] }}
                                                    </li>
                                                </div>

                                                {{-- Check if the content in subHeading is InputText or longText --}}
                                                @if (isset($subHeading['content']))
                                                    @if ($subHeading['content'] == 'InputText')
                                                        <br>
                                                        <li class="w-80">
                                                            <input title="{{ $titleContent['title'] }}"
                                                                content="InputText" uniqName="{{ $subHeadingId }}"
                                                                question="{{ $subHeading['subHeading'] }}"
                                                                typeVal="speechToText" class="form-control"
                                                                id='output' type="text" name=""
                                                                placeholder="Insert Comments">
                                                        <li> <img style="cursor: pointer" class="left-2 toggleButton"
                                                                id="toggleButton" onclick="recordNow(event)"
                                                                src="{{ asset('images/open-mic.png') }}"> </li>
                                                        </li>
                                                    @elseif ($subHeading['content'] == 'longText')
                                                        <br>
                                                        <li class="w-80">
                                                            <textarea title="{{ $titleContent['title'] }}" content="InputText" uniqName="{{ $subHeadingId }}"
                                                                dataType="comments" question="{{ $subHeading['subHeading'] }}" typeVal="speechToText" class="form-control"
                                                                id='output' type="text" name="" placeholder="Insert"></textarea>
                                                        <li><img style="cursor: pointer" class="discussion"
                                                                id="toggleButton" onclick="recordNow(event)"
                                                                src="{{ asset('images/open-mic.png') }}"></li>
                                                        </li>
                                                    @else
                                                        {{-- Handle other types of content if needed --}}
                                                        @php
                                                            $selectContent = implode(', ', $subHeading['content']);
                                                        @endphp
                                                        @foreach ($subHeading['content'] as $content)
                                                            <div style="display: inline-block">
                                                                <li class="mr-13 mb-10">
                                                                    <button type="button"
                                                                        class="btn5 anek-telugu mr-13 selectOption {{ $content }}"
                                                                        value="{{ $content }}"
                                                                        title="{{ $titleContent['title'] }}"
                                                                        uniqName="{{ $subHeadingId }}"
                                                                        content="{{ $selectContent }}"
                                                                        subHeadQuestion="{{ $subHeading['subHeading'] }}"
                                                                        question="{{ isset($subHeading['subHeading']) ? $subHeading['subHeading'] : '' }}"
                                                                        aria-label=".form-select-lg example">{{ $content }}</button>
                                                                </li>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                                <br><br>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <br>
                @endforeach

                <div class="py-4">
                    <div id="inputbox" style="display:none"></div>

                    <input type="hidden" name="patientNotesJson" id="savedJsonText" value="">
                    <button type="button" id="generateJsonText" class="btn2 anek-telugu mr-13">Save</button>

                    <input type="submit" id="submitPatientNotes" style="display:none;" class="copyTextBtn"
                        value="Save" />
                    <button type="button" onclick="copyContent()" class="btn3 anek-telugu">Copy text</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('customjs')
    <script>
        $('.selectOption').on('click', function() {
            // Toggle class for styling
            $(this).toggleClass('background-active');
            generateTextNow();
        });

        // $(document).ready(function() {
        // Adding numeric to ID
        var output = document.querySelectorAll("#output");
        var img = document.querySelectorAll("#toggleButton");
        for (var i = 0; i < output.length; i++) {
            output[i].setAttribute("id", "output" + i);
            img[i].setAttribute("clickedId", "output" + i);
            img[i].setAttribute("id", "toggleButton" + i);
        }

        var voiceStatus = document.querySelectorAll("#status");
        for (var i = 0; i < voiceStatus.length; i++) {
            voiceStatus[i].setAttribute("id", "status" + i);
        }

        $('select').change(function() {
            generateTextNow();
        });
        $('input').change(function() {
            generateTextNow();
        });

        function recordNow(event) {
            var image = event.target;
            var currentSrc = image.src;

            var firstImage = '{{ asset('images/open-mic.png') }}';
            var secondImage = '{{ asset('images/shop/mic.png') }}';

            isListening = !isListening;

            image.src = isListening ? secondImage : firstImage;

            if (isListening) {
                var clickedId = $(event.target).attr('clickedId');
                startRecording(clickedId);
            } else {
                stopRecording();
            }
        }

        var isListening = false;
        var recognition = null;
        var toggleButton = document.getElementById("toggleButton0");

        var transcriptionDiv = document.getElementById("transcription");

        function startRecording(clickedId) {
            try {
                recognition = new webkitSpeechRecognition();
                recognition.continuous = true;

                recognition.onstart = function(event) {
                    toggleButton.textContent = "Stop Speech Recognition";
                    statusDiv.textContent = "Speech recognition in progress...";
                };

                // recognition.onresult = function(event) {
                //     var transcription = "";
                //     for (var i = event.resultIndex; i < event.results.length; ++i) {
                //         transcription += event.results[i][0].transcript;
                //     }
                //     transcriptionDiv.innerHTML =
                //         transcriptionDiv.innerHTML + " " + transcription;
                //     $('#' + clickedId).attr('value', $('#' + clickedId).val() + " " + transcription)

                // };

                recognition.onresult = function(event) {
                    var transcription = "";
                    for (var i = event.resultIndex; i < event.results.length; ++i) {
                        transcription += event.results[i][0].transcript;
                    }
                    transcriptionDiv.innerHTML =
                        transcriptionDiv.innerHTML + " " + transcription;

                    // Get the clicked element
                    var clickedElement = $('#' + clickedId);

                    // Check if it's an input or a textarea
                    if (clickedElement.is('input')) {
                        // If it's an input, use .val()
                        clickedElement.val(clickedElement.val() + " " + transcription);
                    } else if (clickedElement.is('textarea')) {
                        // If it's a textarea, use .text()
                        clickedElement.text(clickedElement.text() + " " + transcription);
                    }
                };

                recognition.onerror = function(event) {
                    console.error(
                        "An error occurred during speech recognition: ",
                        event.error
                    );
                    statusDiv.textContent = "Error: Speech recognition encountered an error.";
                    stopRecording();
                };

                recognition.onnomatch = function(event) {
                    console.error("No speech recognized: ", event);
                    statusDiv.textContent =
                        "Error: No speech recognized. Please check your microphone permissions.";
                };

                recognition.onend = function() {
                    toggleButton.textContent = "Start Speech Recognition";
                    statusDiv.textContent = "Speech recognition stopped.";
                    isListening = false;
                };

                recognition.start();
                isListening = true;
            } catch (error) {
                console.error(
                    "An error occurred while starting speech recognition: ",
                    error
                );
                statusDiv.textContent = "Error: Speech recognition could not be started.";
            }
        }

        function stopRecording() {
            console.log(isListening + "hhh");
            if (recognition) {
                console.log(isListening);
                recognition.stop();
                recognition = null;
            }
            toggleButton.textContent = "Start Speech Recognition";
            // statusDiv.textContent = "";
            isListening = false;
        }


        // --------------------------------------------------
        // Audio Record
        // });

        generateTextNow();


        function generateTextNow() {

            var generateText = '';

            $("input[type='text'],input[type='hidden'],select,button.background-active,textarea").each(function() {

                if ($(this).attr('title') && $(this).attr("type") == 'hidden') {
                    $titleId = $(this).attr("uniqName");

                    if ($(this).attr("uniqName")) {
                        generateText += $(this).attr("title") + "\n";
                    }

                } else {
                    if ($(this).attr("uniqName")) {
                        if ($(this).val() == '' || $(this).val() == 'InputText') {
                            if ($(this).attr('typeVal') == 'speechToText') {} else {
                                generateText += $(this).attr("question") + '-' + "\n";
                            }
                        } else {
                            generateText += $(this).attr("question") + ': ' + $(this).val() + "\n";
                        }
                    }
                }

                if ($(this).attr('typeVal') == 'speechToText') {
                    generateText += '\n';
                }

            });
            // alert(generateText);

            $('#inputbox').text(generateText);
        }

        $('#generateJsonText').click(function() {
            generateJsonText();
        });

        // function generateJsonText() {
        //     var generateJsonText = [];
        //     $section1 = 0;
        //     $section2 = 0;

        //     $("input[type='text'],input[type='hidden'],button.background-active,textarea").each(function() {
        //         if ($(this).attr('title') && $(this).attr("type") == 'hidden') {
        //             $titleId = $(this).attr("uniqName");
        //             var title = {};

        //             title = {
        //                 "title": $(this).attr('title'),
        //                 "headings": []
        //             };

        //             generateJsonText.push(title);
        //         } else {


        //             if ($("input[type='text'") || $("select") || $("textarea")) {

        //                 if ($("input[type='text'") && $(this).attr('question') == 'Speech to text') {
        //                     $speechToTextHeading = 'Speech to text';
        //                     $speechToTextValue = $(this).val();
        //                 } else {
        //                     $heading = {};
        //                     $ques = $(this).attr('question');
        //                     $content = $(this).attr('content');
        //                     $val = $(this).val();
        //                     $speechToTextHeading = '-';
        //                     $speechToTextValue = '-';
        //                 }
        //                 $length = generateJsonText.length;

        //                 if ($(this).attr("uniqName")) {
        //                     $uniqName = $(this).attr("uniqName");
        //                     $stringSplit = $uniqName.split('-');

        //                     $headingIdAlone = $stringSplit[1];

        //                     //Checking if its subheading
        //                     if ($stringSplit.length > 2) {

        //                         if ($stringSplit[0] == $titleId && $stringSplit[1] == $headingIdAlone && $(this)
        //                             .attr('question') != 'Speech to text') {
        //                             $heading = {
        //                                 "heading": $(this).attr('subHeadQuestion'),
        //                                 "subHeadings": [],
        //                             };
        //                             $headingLength = generateJsonText[$length - 1].headings.length;
        //                             generateJsonText[$length - 1].headings.push($heading);

        //                             $subHeading = {
        //                                 "subHeading": $ques,
        //                                 "content": $content,
        //                                 "value": $val,
        //                                 "speechToTextHeading": $speechToTextHeading,
        //                                 "speechToTextValue": $speechToTextValue
        //                             }
        //                             // console.log($headingLength);
        //                             // console.log(generateJsonText[$length - 1].headings[$headingLength].subHeadings);

        //                             generateJsonText[$length - 1].headings[$headingLength].subHeadings.push(
        //                                 $subHeading);

        //                         } else {

        //                             $headingLength = generateJsonText[$length - 1].headings.length;

        //                             // console.log(generateJsonText[$length - 1].headings);

        //                             $subHeadingLength = generateJsonText[$length - 1].headings[$headingLength - 1]
        //                                 .subHeadings.length;

        //                             generateJsonText[$length - 1].headings[$headingLength - 1].subHeadings[
        //                                 $subHeadingLength - 1].speechToTextHeading = 'Speech to text';
        //                             generateJsonText[$length - 1].headings[$headingLength - 1].subHeadings[
        //                                 $subHeadingLength - 1].speechToTextValue = $(this).val();
        //                         }

        //                     } else {
        //                         //Just headings
        //                         $heading = {
        //                             "heading": $ques,
        //                             "content": $content,
        //                             "value": $val,
        //                             "speechToTextHeading": $speechToTextHeading,
        //                             "speechToTextValue": $speechToTextValue
        //                         };

        //                         // Check its not speech to text
        //                         if ($stringSplit[0] == $titleId && $(this).attr('question') != 'Speech to text') {
        //                             generateJsonText[$length - 1].headings.push($heading);
        //                             // console.log(generateJsonText);
        //                         } else {
        //                             // If its Speech to text
        //                             // $heading = {
        //                             // "heading" : $prevQues,
        //                             // "content" : $prevContent,
        //                             // "value" : $preVal,
        //                             // "speechToTextHeading" : 'Speech to text',
        //                             // "speechToTextValue" : $(this).val()
        //                             // };
        //                             $headingLength = generateJsonText[$length - 1].headings.length;
        //                             // console.log(generateJsonText[$length - 1].headings[$headingLength - 1]
        //                             generateJsonText[$length - 1].headings[$headingLength - 1].speechToTextHeading =
        //                                 'Speech to text';
        //                             generateJsonText[$length - 1].headings[$headingLength - 1].speechToTextValue =
        //                                 $(this).val();
        //                         }
        //                     }
        //                 }

        //                 if ($("input[type='text'") && $(this).attr('question') != 'Speech to text') {
        //                     $prevUniqName = $(this).attr("uniqName");
        //                     $prevQues = $ques;
        //                     $prevContent = $content;
        //                     $preVal = $val;
        //                 }

        //             }
        //         }

        //     });
        //     console.log(generateJsonText);
        //     $('input[name=patientNotesJson]').val(JSON.stringify(generateJsonText));
        //     // $("#submitPatientNotes").click();
        // }
        function generateJsonText() {
            var generateJsonText = [];
            $section1 = 0;
            $section2 = 0;
            var canalLengthAdded = false;

            $("input[type='text'],input[type='hidden'],button.background-active,textarea").each(function() {
                if ($(this).attr('title') && $(this).attr("type") == 'hidden') {
                    $titleId = $(this).attr("uniqName");
                    var title = {
                        "title": $(this).attr('title'),
                        "headings": []
                    };
                    generateJsonText.push(title);
                } else {
                    if ($("input[type='text'") || $("select") || $("textarea")) {
                        if ($("input[type='text'") && $(this).attr('question') == 'Speech to text') {
                            $speechToTextHeading = 'Speech to text';
                            $speechToTextValue = $(this).val();
                        } else {
                            $heading = {};
                            $ques = $(this).attr('question');
                            $content = $(this).attr('content');
                            $val = $(this).val();
                            $speechToTextHeading = '-';
                            $speechToTextValue = '-';
                        }
                        $length = generateJsonText.length;

                        if ($(this).attr("uniqName")) {
                            $uniqName = $(this).attr("uniqName");
                            $stringSplit = $uniqName.split('-');

                            $headingIdAlone = $stringSplit[1];

                            //Checking if its subheading
                            if ($stringSplit.length > 2) {
                                if ($stringSplit[0] == $titleId && $stringSplit[1] == $headingIdAlone && $(this)
                                    .attr('question') != 'Speech to text') {
                                    $heading = {
                                        "heading": $(this).attr('subHeadQuestion'),
                                        "subHeadings": [],
                                    };
                                    $headingLength = generateJsonText[$length - 1].headings.length;
                                    generateJsonText[$length - 1].headings.push($heading);

                                    $subHeading = {
                                        "subHeading": $ques,
                                        "content": $content,
                                        "value": $val,
                                        "speechToTextHeading": $speechToTextHeading,
                                        "speechToTextValue": $speechToTextValue
                                    };

                                    generateJsonText[$length - 1].headings[$headingLength].subHeadings.push(
                                        $subHeading);
                                } else {
                                    $headingLength = generateJsonText[$length - 1].headings.length;
                                    $subHeadingLength = generateJsonText[$length - 1].headings[$headingLength - 1]
                                        .subHeadings.length;

                                    generateJsonText[$length - 1].headings[$headingLength - 1].subHeadings[
                                        $subHeadingLength - 1].speechToTextHeading = 'Speech to text';
                                    generateJsonText[$length - 1].headings[$headingLength - 1].subHeadings[
                                        $subHeadingLength - 1].speechToTextValue = $(this).val();
                                }
                            } else {
                                //Just headings
                                $heading = {
                                    "heading": $ques,
                                    "content": $content,
                                    "value": $val,
                                    "speechToTextHeading": $speechToTextHeading,
                                    "speechToTextValue": $speechToTextValue
                                };

                                if ($stringSplit[0] == $titleId && $(this).attr('question') != 'Speech to text') {
                                    generateJsonText[$length - 1].headings.push($heading);
                                } else {
                                    $headingLength = generateJsonText[$length - 1].headings.length;
                                    generateJsonText[$length - 1].headings[$headingLength - 1].speechToTextHeading =
                                        'Speech to text';
                                    generateJsonText[$length - 1].headings[$headingLength - 1].speechToTextValue =
                                        $(this).val();
                                }
                            }
                        }

                        if ($("input[type='text'") && $(this).attr('question') != 'Speech to text') {
                            $prevUniqName = $(this).attr("uniqName");
                            $prevQues = $ques;
                            $prevContent = $content;
                            $preVal = $val;
                        }
                    }
                }

                // Add the code block for "Canal length" title only once
                if ($(this).attr('title') === 'Canal length:' && !canalLengthAdded) {
                    var table = [];
                    var rows = document.getElementById("myTable").rows;
                    for (let i = 1; i < rows.length; i++) {
                        let row = rows[i];
                        let ewlValue = row.cells[2].querySelector('input[name="ewl_' + i + '"]').value;
                        let cwlValue = row.cells[3].querySelector('input[name="cwl_' + i + '"]').value;
                        let cwlAt = row.cells[3].querySelector('input[name="cwl_mm_' + i + '"]').value;
                        let mafValue = row.cells[4].querySelector('input[name="maf_mm_' + i + '"]').value;
                        let mafK = row.cells[4].querySelector('input[name="maf_k_' + i + '"]').value;
                        let ewlFormatted = ewlValue ? `${ewlValue} mm` : '_ mm';
                        let cwlFormatted = cwlValue && cwlAt ? `${cwlValue} (K) at ${cwlAt} mm` : '_ (K) at _ mm';
                        let mafFormatted = mafValue && mafK ? `${mafValue} mm ${mafK} K` : '_ mm _ K';

                        let obj = {
                            "Ref Pt": row.cells[0].innerText.trim(),
                            "Patent": row.cells[1].querySelector('button.background-active').innerText,
                            "EWL": ewlFormatted,
                            "CWL": cwlFormatted,
                            "MAF": mafFormatted
                        };

                        table.push(obj);
                    }

                    generateJsonText.push({
                        "title": "Canal length:",
                        "headings": [{
                            "heading": "",
                            "content": "table",
                            "table": table
                        }]
                    });

                    // Set canalLengthAdded to true to ensure it's only added once
                    canalLengthAdded = true;
                }
            });

            $('input[name=patientNotesJson]').val(JSON.stringify(generateJsonText));
            $("#submitPatientNotes").click();
        }


        function copyContent() {
            var copyText = $("#inputbox").text();
            navigator.clipboard.writeText(copyText);
            // alert("Text copied successfully");
            console.log("COPY :", copyText)
            // alert("Copied the text: " + copyText);
        }
    </script>
@endsection
