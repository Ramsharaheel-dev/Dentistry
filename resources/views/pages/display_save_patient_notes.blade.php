@extends ('layouts.layout_2')

@section('head')
    <title>Patient Notes &#8211; Dian</title>
@endsection

@section('custom_style')
    <style>
        li {
            display: inline-block;

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

        .mb-10 {
            margin-bottom: 10px;
        }

        .input-active {
            background: none;
            border: none;
            width: 100%;
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
                @foreach ($data as $index => $titleContent)
                @if ($titleContent['title'] === 'Canal length:' && count($titleContent['headings']) === 0)
                    {{-- Skip displaying if "Canal length:" has no associated headings --}}
                    @continue
                @endif
                    <div class="card1" id="card-title-{{ $index + 1 }}" style="margin-bottom: 20px;">
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
                                    @php
                                        $displayedHeadings = [];
                                    @endphp
                                    @php
                                        $displayedSubHeadings = [];
                                    @endphp
                                    @foreach ($titleContent['headings'] as $headingTitle)
                                        @php
                                            $subHeading = 0;
                                            $heading++;
                                            $headingId = $titleId . '-h' . $heading;
                                        @endphp

                                        @if (isset($headingTitle['heading']) && $headingTitle['heading'] != 'Speech to text')
                                            @if (!in_array($headingTitle['heading'], $displayedHeadings))
                                                <input value="{{ $headingTitle['heading'] }}"
                                                    class="please_acc anek-telugu pr-10 input-active" disabled>
                                                @php
                                                    $displayedHeadings[] = $headingTitle['heading'];
                                                @endphp
                                                <br>
                                            @endif
                                        @endif

                                        @if (isset($headingTitle['content']))
                                            @if ($headingTitle['content'] == 'InputText')
                                                @if ($headingTitle['heading'] == 'Comments:')
                                                    <li class="w-80">
                                                        <input title="{{ $titleContent['title'] }}" content="InputText"
                                                            uniqName="{{ $headingId }}" dataType="comments"
                                                            question="{{ $headingTitle['heading'] }}"
                                                            value="{{ isset($headingTitle['value']) ? $headingTitle['value'] : 'no comments' }}"
                                                            typeVal="InputText" class="please_acc anek-telugu input-active"
                                                            id="myData" type="text" disabled>

                                                    </li>
                                                @else
                                                    <li class="w-80">
                                                        <input title="{{ $titleContent['title'] }}" content="InputText"
                                                            uniqName="{{ $headingId }}"
                                                            value="{{ isset($headingTitle['value']) ? $headingTitle['value'] : 'no comments' }}"
                                                            question="{{ $headingTitle['heading'] }}"
                                                            typeVal="speechToText"
                                                            class="please_acc anek-telugu input-active" id="output"
                                                            type="text" disabled>
                                                    </li>
                                                @endif
                                            @elseif ($headingTitle['content'] == 'table')
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            @foreach ($headingTitle['table'][0] as $key => $value)
                                                                <th>{{ $key }}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($headingTitle['table'] as $row)
                                                            <tr>
                                                                @foreach ($row as $column => $value)
                                                                    @if ($column === 'Patent')
                                                                        <td>
                                                                            @if ($value === 'Yes')
                                                                                Y
                                                                            @else
                                                                                N
                                                                            @endif
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            <div class="col-md-5"
                                                                                style="display: ruby-text">
                                                                                @php
                                                                                    $parts = explode('_', $value);
                                                                                    $count = count($parts);
                                                                                @endphp
                                                                                @foreach ($parts as $key => $part)
                                                                                    {{ $part }}
                                                                                @endforeach
                                                                            </div>
                                                                        </td>
                                                                    @endif
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                @php
                                                    $headingTitleContentArray = explode(',', $headingTitle['content']);
                                                @endphp

                                                @foreach ((array) $headingTitle['value'] as $content)
                                                    @if ($headingTitleContentArray)
                                                        <div style="display: inline-block">
                                                            <li class="mr-13 mb-10">
                                                                <input class="anek-telugu mr-13 please_acc input-active"
                                                                    value="{{ $content }}"
                                                                    title="{{ $titleContent['title'] }}"
                                                                    content="{{ $headingTitle['content'] }}"
                                                                    uniqName="{{ $headingId }}" dataType="content"
                                                                    multiple
                                                                    question="{{ isset($headingTitle['heading']) ? $headingTitle['heading'] : '' }}"
                                                                    id="myData" aria-label=".form-select-lg example"
                                                                    type="text" disabled>
                                                            </li>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                            {{-- <br>    --}}
                                        @endif
                                        <br>
                                        @if (isset($headingTitle['subHeadings']))
                                            @foreach ($headingTitle['subHeadings'] as $subHeading)
                                                @if (!in_array($subHeading['subHeading'], $displayedSubHeadings))
                                                    <div style="display: inline-block">
                                                        <li class="please_acc anek-telugu pr-10">
                                                            {{ $subHeading['subHeading'] }}
                                                        </li>
                                                        @php
                                                            $displayedSubHeadings[] = $subHeading['subHeading'];
                                                        @endphp

                                                    </div>
                                                @endif
                                                @php
                                                    if (is_array($subHeading)) {
                                                        $subHeadingId = $headingId . '-sh' . $loop->index;
                                                    } else {
                                                        $subHeadingId = $headingId . '-sh' . $subHeading;
                                                    }
                                                @endphp
                                                @if (isset($subHeading['value']))
                                                    <br>
                                                    @foreach ((array) $subHeading['value'] as $selectContent)
                                                        <div style="display: inline-block">
                                                            <li class="mr-13">
                                                                <input class="anek-telugu mr-13 please_acc input-active"
                                                                    value="{{ $selectContent }}"
                                                                    title="{{ $titleContent['title'] }}"
                                                                    uniqName="{{ $subHeadingId }}"
                                                                    content="{{ $selectContent }}"
                                                                    question="{{ isset($headingTitle['subHeadings']) ? $subHeading['subHeading'] : '' }}"
                                                                    aria-label=".form-select-lg example" type="text"
                                                                    disabled>
                                                            </li>
                                                        </div>
                                                    @endforeach
                                                @endif
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
                    {{-- <button type="button" id="generateJsonText" onclick="generateJsonText()"
                        class="btn2  anek-telugu mr-13">Save</button> --}}
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
        $(document).ready(function() {
            generateTextNow();
        });
        let buttonClicked = false;

        $('.selectOption').on('click', function() {

            $(this).toggleClass('background-active');

            buttonClicked = true;
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
            if (!isListening) {
                var clickedId = $(event.target).attr('clickedId');
                startRecording(clickedId);
            } else {
                stopRecording();
            }
        }

        //    recordNow = () => {
        //       alert($(this).attr('clickedid'));
        //        if (!isListening) {
        //         startRecording();
        //     } else {
        //         stopRecording();
        //     }

        //   }


        // ---------------------------------------------------

        // var isListening = false;
        // var recognition = null;
        // runSpeechRecog = (clickedId) => {
        //     var originalText = $("#"+clickedId).val();

        //     if(originalText != ''){
        //         final_transcript = originalText + ' ';
        //     }
        //     if (!isListening) {
        //     startRecording();
        // } else {
        //     stopRecording();
        // }

        // };



        var isListening = false;
        var recognition = null;
        var toggleButton = document.getElementById("toggleButton0");

        var transcriptionDiv = document.getElementById("transcription");

        /* toggleButton.addEventListener("click", function () {
                var clickedId = $(this).attr('clickedId');
                alert(clickedId);
            if (!isListening) {
                startRecording();
            } else {
                stopRecording();
            }
        });*/

        function startRecording(clickedId) {
            try {
                recognition = new webkitSpeechRecognition();
                recognition.continuous = true;

                recognition.onstart = function(event) {
                    toggleButton.textContent = "Stop Speech Recognition";
                    statusDiv.textContent = "Speech recognition in progress...";
                };

                recognition.onresult = function(event) {
                    var transcription = "";
                    for (var i = event.resultIndex; i < event.results.length; ++i) {
                        transcription += event.results[i][0].transcript;
                    }
                    transcriptionDiv.innerHTML =
                        transcriptionDiv.innerHTML + " " + transcription;
                    $('#' + clickedId).attr('value', $('#' + clickedId).val() + " " + transcription)
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

        function generateJsonText() {
            var generateJsonText = [];
            $section1 = 0;
            $section2 = 0;

            $("input[type='text'],input[type='hidden'],select").each(function() {

                if ($(this).attr('title') && $(this).attr("type") == 'hidden') {
                    $titleId = $(this).attr("uniqName");
                    var title = {};

                    title = {
                        "title": $(this).attr('title'),
                        "headings": []
                    };

                    generateJsonText.push(title);
                } else {

                    if ($("input[type='text'") || $("select")) {

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
                                    }
                                    console.log($headingLength);
                                    console.log(generateJsonText[$length - 1].headings[$headingLength].subHeadings);

                                    generateJsonText[$length - 1].headings[$headingLength].subHeadings.push(
                                        $subHeading);

                                } else {

                                    $headingLength = generateJsonText[$length - 1].headings.length;

                                    console.log(generateJsonText[$length - 1].headings);

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

                                // Check its not speech to text
                                if ($stringSplit[0] == $titleId && $(this).attr('question') != 'Speech to text') {
                                    generateJsonText[$length - 1].headings.push($heading);
                                    console.log(generateJsonText);
                                } else {
                                    // If its Speech to text
                                    // $heading = {
                                    // "heading" : $prevQues,
                                    // "content" : $prevContent,
                                    // "value" : $preVal,
                                    // "speechToTextHeading" : 'Speech to text',
                                    // "speechToTextValue" : $(this).val()
                                    // };
                                    $headingLength = generateJsonText[$length - 1].headings.length;
                                    console.log(generateJsonText[$length - 1].headings[$headingLength - 1]
                                        .speechToTextHeading);

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



            });
            console.log(generateJsonText);
            $('input[name=patientNotesJson]').val(JSON.stringify(generateJsonText));
            $("#submitPatientNotes").click();
        }

        function copyContent() {
            var copyText = $("#inputbox").text();
            navigator.clipboard.writeText(copyText);
            alert("Text copied successfully");
            console.log("COPY :", copyText)
            // alert("Copied the text: " + copyText);
        }
    </script>
@endsection
