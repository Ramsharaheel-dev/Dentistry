<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Notes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial;
            background: #000;
        }

        select {
            width: 445px;
        }

        .template-container {
            margin: 10px;
            width: 100%;
        }

        .templateTitle {
            color: White;
            font-size: 23px;
            font-weight: 600;
        }

        .templateHeading {
            color: #d2d2d2;
            font-size: 20px;
            font-weight: 500;
        }

        .content {
            color: white;
        }

        .templateSubHeadingTitle {
            color: #d2d2d2;
            font-size: 14px;
        }

        .templateFormSelect {
            background-color: #646464;
            color: #d2d2d2;
            height: 3.25em;
            border: none;
            font-size: 14px;
        }

        .templateFormInput {
            background-color: #646464;
            color: #d2d2d2;
            border: none;
            font-size: 14px;
            border-radius: 5px;
            height: 3.25em !important;
            padding: 5px 22.5px 5px 10px;
            font-style: italic;
            width: -webkit-fill-available;
        }

        .copyTextBtn {
            font-family: "Roboto", Sans-serif !important;
            font-size: 15px !important;
            font-weight: 500 !important;
            letter-spacing: 1px !important;
            text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3) !important;
            background-color: #d9aa5a !important;
            border-radius: 7px 7px 7px 7px !important;
            padding: 10px 15px 10px 15px !important;
            color: white;
        }

        .chosen-container-multi .chosen-choices {
            background: #646464 !important;
            color: #d2d2d2 !important;
            height: 3.25em !important;
            border: none !important;
            font-size: 14px;
            border-radius: 5px !important;
            padding-top: 9px !important;
            width: 103%;
        }

        .chosen-container-multi .chosen-choices li.search-choice {
            background: #949494 !important;
            border: none !important;
            color: white !important;
        }

        .recorder {
            cursor: pointer;
            width: 40px;
            height: 40px;
        }

        ::placeholder {
            color: #8c8c8c;
        }

        select.templateFormSelect option:hover {
            box-shadow: 0 0 10px 100px #D9AA5A;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="elementor-element elementor-element-1324fa7 elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
            data-id="1324fa7" data-element_type="widget" data-widget_type="divider.default">
            <div class="elementor-widget-container">
                <style>
                    /*! elementor - v3.10.2 - 29-01-2023 */
                    .elementor-widget-divider {
                        --divider-border-style: none;
                        --divider-border-width: 1px;
                        --divider-color: #2c2c2c;
                        --divider-icon-size: 20px;
                        --divider-element-spacing: 10px;
                        --divider-pattern-height: 24px;
                        --divider-pattern-size: 20px;
                        --divider-pattern-url: none;
                        --divider-pattern-repeat: repeat-x
                    }

                    .elementor-widget-divider .elementor-divider {
                        display: flex
                    }

                    .elementor-widget-divider .elementor-divider__text {
                        font-size: 15px;
                        line-height: 1;
                        max-width: 95%
                    }

                    .elementor-widget-divider .elementor-divider__element {
                        margin: 0 var(--divider-element-spacing);
                        flex-shrink: 0
                    }

                    .elementor-widget-divider .elementor-icon {
                        font-size: var(--divider-icon-size)
                    }

                    .elementor-widget-divider .elementor-divider-separator {
                        display: flex;
                        margin: 0;
                        direction: ltr
                    }

                    .elementor-widget-divider--view-line_icon .elementor-divider-separator,
                    .elementor-widget-divider--view-line_text .elementor-divider-separator {
                        align-items: center
                    }

                    .elementor-widget-divider--view-line_icon .elementor-divider-separator:after,
                    .elementor-widget-divider--view-line_icon .elementor-divider-separator:before,
                    .elementor-widget-divider--view-line_text .elementor-divider-separator:after,
                    .elementor-widget-divider--view-line_text .elementor-divider-separator:before {
                        display: block;
                        content: "";
                        border-bottom: 0;
                        flex-grow: 1;
                        border-top: var(--divider-border-width) var(--divider-border-style) var(--divider-color)
                    }

                    .elementor-widget-divider--element-align-left .elementor-divider .elementor-divider-separator>.elementor-divider__svg:first-of-type {
                        flex-grow: 0;
                        flex-shrink: 100
                    }

                    .elementor-widget-divider--element-align-left .elementor-divider-separator:before {
                        content: none
                    }

                    .elementor-widget-divider--element-align-left .elementor-divider__element {
                        margin-left: 0
                    }

                    .elementor-widget-divider--element-align-right .elementor-divider .elementor-divider-separator>.elementor-divider__svg:last-of-type {
                        flex-grow: 0;
                        flex-shrink: 100
                    }

                    .elementor-widget-divider--element-align-right .elementor-divider-separator:after {
                        content: none
                    }

                    .elementor-widget-divider--element-align-right .elementor-divider__element {
                        margin-right: 0
                    }

                    .elementor-widget-divider:not(.elementor-widget-divider--view-line_text):not(.elementor-widget-divider--view-line_icon) .elementor-divider-separator {
                        border-top: var(--divider-border-width) var(--divider-border-style) var(--divider-color)
                    }

                    .elementor-widget-divider--separator-type-pattern {
                        --divider-border-style: none
                    }

                    .elementor-widget-divider--separator-type-pattern.elementor-widget-divider--view-line .elementor-divider-separator,
                    .elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:after,
                    .elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:before,
                    .elementor-widget-divider--separator-type-pattern:not([class*=elementor-widget-divider--view]) .elementor-divider-separator {
                        width: 100%;
                        min-height: var(--divider-pattern-height);
                        -webkit-mask-size: var(--divider-pattern-size) 100%;
                        mask-size: var(--divider-pattern-size) 100%;
                        -webkit-mask-repeat: var(--divider-pattern-repeat);
                        mask-repeat: var(--divider-pattern-repeat);
                        background-color: var(--divider-color);
                        -webkit-mask-image: var(--divider-pattern-url);
                        mask-image: var(--divider-pattern-url)
                    }

                    .elementor-widget-divider--no-spacing {
                        --divider-pattern-size: auto
                    }

                    .elementor-widget-divider--bg-round {
                        --divider-pattern-repeat: round
                    }

                    .rtl .elementor-widget-divider .elementor-divider__text {
                        direction: rtl
                    }

                    .e-con-inner>.elementor-widget-divider,
                    .e-con>.elementor-widget-divider {
                        width: var(--container-widget-width);
                        --flex-grow: var(--container-widget-flex-grow)
                    }
                </style>
                <div class="elementor-divider"> <span class="elementor-divider-separator"> </span> </div>
            </div>
        </div>
        <section
            class="elementor-section elementor-inner-section elementor-element elementor-element-0b7b2fc elementor-section-boxed elementor-section-height-default elementor-section-height-default"
            data-id="0b7b2fc" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-2942caf"
                    data-id="2942caf" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-2ab8f29 elementor-widget elementor-widget-image"
                            data-id="2ab8f29" data-element_type="widget" data-widget_type="image.default">
                            <div class="elementor-widget-container"
                                style="display: flex;
                            margin-top: 70px;
                            margin-left: 10px;
                            margin-bottom: 25px;">
                                <style>
                                    /*! elementor - v3.10.2 - 29-01-2023 */
                                    .elementor-widget-image {
                                        text-align: center
                                    }

                                    .elementor-widget-image a {
                                        display: inline-block
                                    }

                                    .elementor-widget-image a img[src$=".svg"] {
                                        width: 48px
                                    }

                                    .elementor-widget-image img {
                                        vertical-align: middle;
                                        display: inline-block
                                    }

                                    .elementor-5 .elementor-element.elementor-element-2ab8f29 img {
                                        width: 80% !important;
                                    }

                                    .profileImg {
                                        border-radius: 50% !important;
                                        height: 65px !important;
                                        object-fit: cover !important;
                                    }


                                    @media (max-width: 767px) {
                                        .elementor-section.elementor-section-boxed>.elementor-container {
                                            flex-wrap: nowrap;
                                        }

                                        .elementor-5 .elementor-element.elementor-element-2ab8f29 img {
                                            width: 100% !important;
                                        }

                                        .elementor-5 .elementor-element.elementor-element-51ed8f9 .elementor-button {
                                            margin-bottom: 5px;
                                        }

                                        .templateFormInput {
                                            background-color: #646464;
                                            color: #d2d2d2;
                                            border: none;
                                            font-size: 14px;
                                            border-radius: 5px;
                                            height: 3.25em !important;
                                            padding: 5px 22.5px 5px 10px;
                                            font-style: italic;
                                            width: -webkit-fill-available;
                                            width: 133%;
                                            margin-top: 10px;
                                        }

                                        .chosen-container-multi .chosen-choices {
                                            width: 95%;
                                        }
                                    }
                                </style><a href="{{ route('dashboard') }}"> <img decoding="async" width="300"
                                        height="57" src="../images/2023-02-cropped-cropped-DIAN--300x57.png"
                                        class="attachment-medium size-medium wp-image-105" alt=""
                                        loading="lazy" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="elementor-element elementor-element-f9d95f1 elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
            data-id="f9d95f1" data-element_type="widget" data-widget_type="divider.default">
            <div class="elementor-widget-container">
                <div class="elementor-divider"> <span class="elementor-divider-separator"> </span> </div>
            </div>
        </div>

        <div class="template-container">

            <?php $count = 0; ?>
            <form method="post" action="{{ route('savePatientNotes') }}">
                @csrf
                <input type="hidden" name="templateId" value="{{ $templateId }}">
                <input type="hidden" name="templateName" value="{{ $templateName }}">
                <textarea style="width:100%;display:none" id="transcription" name="emailContent" rows="5" cols="50"></textarea>
                <?php $title = 0; ?>
                @foreach ($data as $titleContent)
                    <p class="templateTitle">{{ $titleContent['title'] }}</p>
                    <?php
                    $heading = 0;
                    $title = $title + 1;
                    $titleId = 't' . $title; ?>
                    <input question="{{ $titleContent['title'] }}" dataType="title" uniqName="{{ $titleId }}"
                        title="{{ $titleContent['title'] }}" type="hidden">

                    <?php if (array_key_exists("headings",$titleContent)) {?>

                    @foreach ($titleContent['headings'] as $headingTitle)
                        <?php
                        $subHeading = 0;
                        $heading = $heading + 1;
                        $headingId = $titleId . '-h' . $heading;
                        ?>
                        <?php if (isset($headingTitle['heading'])) { ?>
                        <p class="templateHeading">{{ $headingTitle['heading'] }}</p>

                        <?php }?>

                        <?php if (isset($headingTitle['content'])) { ?>
                        <?php if($headingTitle['content'] == 'InputText'){ ?>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">

                                @if ($headingTitle['heading'] == 'Comments:')
                                    <input title="{{ $titleContent['title'] }}" content="InputText"
                                        uniqName="{{ $headingId }}" dataType="comments"
                                        question="{{ $headingTitle['heading'] }}" value="" typeVal = "InputText"
                                        class="templateFormInput" id="myData" type="text" name=""
                                        placeholder="Insert Comments">
                                @else
                                    <input title="{{ $titleContent['title'] }}" content="InputText"
                                        uniqName="{{ $headingId }}" dataType="comments"
                                        question="{{ $headingTitle['heading'] }}" value="" typeVal = "InputText"
                                        class="templateFormInput" id="myData" type="text" name=""
                                        placeholder="Insert Comments">
                                @endif

                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-2 mt-5" style="text-align:center">
                                <img class="recorder" id="toggleButton" onclick="recordNow(event)"
                                    src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/record.png" />

                            </div>

                            <div class="col-lg-6 col-md-6 col-xs-10 mt-5">
                                <?php $count = $count + 1; ?>
                                @if ($headingTitle['heading'] == 'Comments:')
                                    <input title="{{ $titleContent['title'] }}" content="InputText"
                                        uniqName="{{ $headingId }}" dataType="lastHeading"
                                        question="Speech to text" typeVal = "speechToText" class="templateFormInput"
                                        id='output' type="text" name="" placeholder="Speech to Text">
                                @else
                                    <input title="{{ $titleContent['title'] }}" content="InputText"
                                        uniqName="{{ $headingId }}" question="Speech to text"
                                        typeVal = "speechToText" class="templateFormInput" id='output'
                                        type="text" name="" placeholder="Speech to Text">
                                @endif
                            </div>
                        </div>

                        <?php echo '<br/>'; ?>
                        <?php } else { ?>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-xs-12">
                                <?php $selectContent = implode(', ', $headingTitle['content']); ?>
                                <select title="{{ $titleContent['title'] }}" content="{{ $selectContent }}"
                                    uniqName="{{ $headingId }}" dataType="content" multiple
                                    question="{{ isset($headingTitle['heading']) ? $headingTitle['heading'] : '' }}"
                                    class="chosen-select templateFormSelect form-select form-select-lg mb-3"
                                    id="myData" aria-label=".form-select-lg example">

                                    @foreach ((array) $headingTitle['content'] as $content)
                                        <option value="{{ $content }}">{{ $content }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-2 mt-5" style="text-align:center">
                                <img class="recorder" id="toggleButton" onclick="recordNow(event)"
                                    src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/record.png" />

                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-10 mt-5">
                                <?php $count = $count + 1; ?>
                                <p id="status" style="color:#dadada;display:none"></p>
                                <input title="{{ $titleContent['title'] }}" content="InputText"
                                    uniqName="{{ $headingId }}" question="Speech to text"
                                    typeVal = "speechToText" class="templateFormInput speechToText" id='output'
                                    type="text" name="" placeholder="Speech to Text">

                            </div>
                        </div>

                        <?php } ?>
                        <?php echo '<br/>'; ?>
                        <?php }?>

                        <?php if (isset($headingTitle['subHeadings'])) { ?>
                        <?php
                        $subHeading = 0;
                        $subHeading = $subHeading + 1;
                        $subHeadingId = $headingId . '-sh' . $subHeading;
                        ?>
                        @foreach ($headingTitle['subHeadings'] as $subHeading)
                            <p class="templateSubHeadingTitle">{{ $subHeading['subHeading'] }}</p>

                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-xs-12">
                                    <?php
                                    // if(is_array($subHeading['content'])){
                                    //     $selectContent = implode(', ', $subHeading['content']);
                                    // }
                                    if (is_string($subHeading['content'])) {
                                        $subHeadingContent = explode(' ', $subHeading['content']);
                                    } else {
                                        $subHeadingContent = $subHeading['content'];
                                    }
                                    ?>
                                    <select title="{{ $titleContent['title'] }}" uniqName="{{ $subHeadingId }}"
                                        content="{{ $selectContent }}" multiple
                                        subHeadQuestion="{{ $headingTitle['heading'] }}"
                                        question="{{ isset($headingTitle['subHeadings']) ? $subHeading['subHeading'] : '' }}"
                                        class="chosen-select templateFormSelect form-select form-select-lg mb-3"
                                        id="myData" aria-label=".form-select-lg example">

                                        @foreach ($subHeadingContent as $content)
                                            <option value="{{ $content }}">{{ $content }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-1 col-md-1 col-xs-2 mt-5" style="text-align:center">
                                    <img class="recorder" id="toggleButton" onclick="recordNow(event)"
                                        src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/record.png" />
                                    <!-- <img class="recorder" id="stopRecording" ontouchstart="runSpeechRecog($(this).attr('clickedid'))" src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/stop-button.png" />  -->
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-10 mt-5">
                                    <?php $count = $count + 1; ?>
                                    <p id="status" style="color:#dadada;display:none"></p>
                                    <input title="{{ $titleContent['title'] }}" uniqName="{{ $subHeadingId }}"
                                        question="Speech to text" typeVal = "speechToText"
                                        class="templateFormInput speechToText" id="output" type="text"
                                        name="" placeholder="Speech to Text">
                                </div>
                            </div>
                        @endforeach
                        <?php }?>
                    @endforeach
                    <?php } ?>
                    <?php echo '<br/>'; ?>
                @endforeach

                <div id="inputbox" style="display:none"></div>



                <input type="hidden" name="patientNotesJson" id="savedJsonText" value="">
                <input type="button" id="generateJsonText" onclick="generateJsonText()" class="copyTextBtn"
                    value="Save" />
                <input type="submit" id="submitPatientNotes" style="display:none;" class="copyTextBtn"
                    value="Save" />
            </form>
            <button onclick="copyContent()" class="copyTextBtn">Copy text</button>
        </div>
    </div>

    <script>
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



        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        });
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

            $("input[type='text'],input[type='hidden'],select,button").each(function() {

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
            // $('input[name=patientNotesJson]').val(JSON.stringify(generateJsonText));
            // $("#submitPatientNotes").click();
        }

        function copyContent() {
            var copyText = $("#inputbox").text();
            navigator.clipboard.writeText(copyText);
            // alert("Text copied successfully");
            console.log("COPY :", copyText)
            // alert("Copied the text: " + copyText);
        }
    </script>
</body>

</html>
