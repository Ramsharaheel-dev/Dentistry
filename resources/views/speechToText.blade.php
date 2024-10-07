@extends ('layouts.layout')

@section('head')
<title>Patient Notes &#8211; Dian</title>

<style>
    .template-container{
        margin:10px;
        width:100%;
    }
    .templateTitle{
        color:White;
        font-size:23px;
        font-weight:600;
    }
    .templateHeading{
        color:#d2d2d2;
        font-size:20px;
        font-weight:500;
    }
    .content{
        color:white;
    }
    .templateSubHeadingTitle{
        color:#d2d2d2;
        font-size:14px;
    }
    .templateFormSelect{
        background-color: #646464;
        color: #d2d2d2;
        height: 3.25em;
        border:none;
        font-size:14px;
    }
    .templateFormInput{
        background-color: #646464;
        color: #d2d2d2;
        border: none;
        font-size: 14px;
        border-radius: 5px;
        height: 3.25em;
        padding: 5px 22.5px 5px 10px;
        font-style: italic;
        width: -webkit-fill-available;
    }
    .copyTextBtn{
        font-family: "Roboto", Sans-serif !important;
        font-size: 15px !important;
        font-weight: 500 !important;
        letter-spacing: 1px !important;
        text-shadow: 0px 0px 10px rgba(0,0,0,0.3) !important;
        background-color: var(--e-global-color-9caa857 ) !important;
        border-radius: 7px 7px 7px 7px !important;
        padding: 10px 15px 10px 15px !important;
        color: white;
    }

    .chosen-container-multi .chosen-choices{
        background: #646464 !important;
        color: #d2d2d2 !important;
        height: 3.25em !important;
        border: none !important;
        font-size: 14px;
        border-radius: 5px !important;
        padding-top: 9px !important;
    }
    .chosen-container-multi .chosen-choices li.search-choice{
        background: #949494 !important;
        border: none !important;
        color: white !important;
    }

    .recorder{
        margin-top:6px;
        cursor:pointer;
        width:30px;
        height:30px;
    }
    #emailContent{
        color: #d2d2d2;
        background-color: #646464;
        font-style: italic;
        margin-top: 5px;
        border:none;
        border-radius:5px;
    }
    textarea{
        margin-bottom: 5px;
    }

    ::placeholder {
    color: #8c8c8c;
    }
    select.templateFormSelect option:hover {
    box-shadow: 0 0 10px 100px #D9AA5A;
}


</style>
@endsection

@section('content')

@include('requires.header-assist')


<div class="template-container">
    <?php $count = 0; ?>
    <form method="post" action="{{ route('saveSpeechToText') }}">
    @csrf

        <div class="row">
            <div class="col-lg-1">
                <img class="recorder" id="toggleButton" src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/record.png"/>
            </div>
            <div class="col-lg-11">
                <p id="status" style="color:#dadada"></p>
                <textarea style="width:100%; color:#a0a0a0;" id="transcription" name="speechToTextData" rows="45" cols="50">
                </textarea>

            </div>
        </div>

        <div id="inputbox" style="display:none"></div>

        <input type="submit" id="submitPatientNotes" style="display:none;" class="copyTextBtn" value="Save"/>
        <input type="button" id="submitSpeechToText" class="copyTextBtn" class="copyTextBtn" value="Save"/>
    </form>
    <button onclick="copyContent()" class="copyTextBtn">Copy text</button>
</div>
@endsection
@section('customjs')
<script>
    var submitSpeechToText = document.getElementById("submitSpeechToText");

    submitSpeechToText.addEventListener("click", function () {
            $("#submitPatientNotes").click();
    });
    $(document).ready(function() {

        $('textarea').change(function() {
            generateTextNow = $(this).val();
            alert(generateTextNow);
            $('#inputbox').text(generateTextNow);
        });

        // -----------------------------------------------------


        //Old Code
        var transcriptionDiv = document.getElementById("transcription");
        var toggleButton = document.getElementById("toggleButton");
        var statusDiv = document.getElementById("status");
        var isListening = false;
        var recognition = null;

        //statusDiv.textContent = navigator.vendor;
        toggleButton.addEventListener("click", function () {
            if (!isListening) {
                startRecording();
            } else {
                stopRecording();
            }
        });

        function startRecording() {
            try {

                if(navigator.vendor && navigator.vendor.indexOf('Apple') > -1){
                    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                    recognition = new SpeechRecognition();
                    recognition.continuous = true;
                }else{
                    recognition = new webkitSpeechRecognition();
                    recognition.continuous = true;
                }

                recognition.onstart = function (event) {
                    toggleButton.textContent = "Stop Speech Recognition";
                    statusDiv.textContent = "Speech recognition in progress...";
                };

                recognition.onresult = function (event) {
                    var transcription = "";
                    for (var i = event.resultIndex; i < event.results.length; ++i) {
                        transcription += event.results[i][0].transcript;
                    }
                    transcriptionDiv.innerHTML = transcriptionDiv.innerHTML + " " + transcription;
                };

                recognition.onerror = function (event) {
                    console.error(
                        "An error occurred during speech recognition: ",
                        event.error
                    );
                    statusDiv.textContent = "Error: Speech recognition encountered an error.";
                    stopRecording();
                };

                recognition.onnomatch = function (event) {
                    console.error("No speech recognized: ", event);
                    statusDiv.textContent = "Error: No speech recognized. Please check your microphone permissions.";
                };

                recognition.onend = function () {
                    toggleButton.textContent = "Start Speech Recognition";
                    statusDiv.textContent = "Speech recognition stopped.";
                    //alert("step 1");
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
            if (recognition) {
                recognition.stop();
                recognition = null;
                //alert("step 2");
            }
            //alert("step 3");
            toggleButton.textContent = "Start Speech Recognition";
            statusDiv.textContent = "";
            isListening = false;
        }

        // --------------------------------------------------
        // Audio Record

        runSpeechRecog = (clickedId) => {
            var output = document.getElementById(clickedId);
            if(navigator.vendor && navigator.vendor.indexOf('Apple') > -1){
                const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                let recognition = new SpeechRecognition();
            }else{
                let recognization = new webkitSpeechRecognition();
            }

            recognization.onstart = () => {
            }
            recognization.onresult = (e) => {
               var transcript = e.results[0][0].transcript;
               $("#emailContent").val(transcript);
               console.log(transcript);
            }
            recognization.start();
        }
    });

    function copyContent() {
        var copyText = $("#inputbox").text();
        navigator.clipboard.writeText(copyText);
    }
</script>

@endsection
