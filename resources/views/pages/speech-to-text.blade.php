@extends ('layouts.layout_2')

@section('head')
    <title>Speech To Text &#8211; Dian</title>
@endsection


@section('custom_style')
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next.disabled {
            color: var(--primary) !important;
            width: 5rem;
        }

        .modal-body {
            height: 20rem;
        }

        .modal-body p {
            color: white;
            font-size: 17px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next {
            font-size: 18px;
            height: 24px;
            width: 40px;
            background: transparent;
            border-radius: 0.375rem;
            padding: 0 0.45rem;
            line-height: 25px;
            margin: 0 0.625rem;
            display: inline-block;
            color: var(--primary) !important;
            box-shadow: none !important;
        }

        .dataTables_wrapper {
            position: relative;
            clear: both;
            *zoom: 1;
            zoom: 1;
            overflow-x: scroll;
            height: 30rem;
        }

        [data-theme-version="dark"] .paging_simple_numbers.dataTables_paginate {
            background: #182237;
            display: none;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            color: #333;
            display: none;
        }

        [data-theme-version="dark"] .table.table-striped tbody tr:nth-of-type(odd),
        [data-theme-version="dark"] .table.table-hover tr:hover {
            background-color: transparent !important;
        }

        .custom-bg {
            background: #102335;
        }

        textarea.form-control {
            min-height: auto;
            height: 470px !important;
        }

        img.recorder {
            cursor: pointer;
        }

        .btn3.custom {
            font-size: 18px !important;
            padding: 10px 30px !important;
        }

        td {
            white-space: nowrap;
            border: 1px solid black;
            max-width: 350px;
            overflow-y: hidden;
            font-size: 16px;
        }

        /*
            .long {
                white-space: normal;
                min-width: 350px;
            } */
        tr {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="content-body">

        @include('require_2.hashtag-assist')

        @php
            $count = 0;
        @endphp
        <div class="container-fluid">
            <form method="POST" action="{{ route('saveSpeechToText') }}">
                @csrf
                <div class="mb-3">
                    <img class="w-4 recorder" id="toggleButton" src="{{ asset('images/record-icon.png') }}">
                </div>
                <div class="row">

                    <div class="col-md-12">

                        <div class="mb-3">
                            <p id="status" style="color:#dadada"></p>
                            <textarea maxlength="1000" class="form-txtarea form-control transcription" name="speechToTextData" rows="8"
                                id="transcription"></textarea>
                        </div>
                    </div>

                </div>

                <div class=" pt-0">
                    <div id="inputbox" style="display:none"></div>

                    <button type="submit" id="submitSpeechToText" class="btn2 anek-telugu mr-13">Save</button>

                    <button type="button" onclick="copyContent()" class="copyTextBtn btn3 custom anek-telugu mr-13">Copy
                        text</button>
                </div>
            </form>


            <div class=" py-4">
                <div class="card1">
                    <table id="user_table" class="user_table table table-striped">
                        <thead class="custom-bg">
                            <tr>
                                <th>Sr #</th>
                                <th>Date</th>
                                <th>Text</th>
                            </tr>
                        </thead>
                        <tbody class="notes-modal" id="notes-modal">
                            @if (isset($savedSpeechTexts) && $savedSpeechTexts->isnotempty())
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($savedSpeechTexts as $savedSpeechText)
                                    <tr onclick="openSpeechNotesModal('{{ $savedSpeechText->data }}')">
                                        <td>{{ $count }}</td>
                                        <td>{{ $savedSpeechText->created_at }}</td>
                                        <td>{{ $savedSpeechText->data }}</td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td colspan="6">Not Available</td>
                                </tr>
                            @endif
                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="speechNotesModal" tabindex="-1" aria-labelledby="speechNotesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="speechNotesContent" class="speechNotesContent"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="copyTextBtn" class="copyTextBtn btn3 custom anek-telugu">Copy text</button>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal">Close</button> --}}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('customjs')
    <script>
        function openSpeechNotesModal(data) {
            // Populate the modal with the clicked row's data
            $('#speechNotesContent').text(data);

            // Show the modal
            $('#speechNotesModal').modal('show');
        }
        document.getElementById('copyTextBtn').addEventListener('click', function() {
            var textToCopy = document.getElementById('speechNotesContent').innerText;
            navigator.clipboard.writeText(textToCopy)
        });

        var submitSpeechToText = document.getElementById("submitSpeechToText");

        submitSpeechToText.addEventListener("click", function() {
            validateForm();
            $("#submitPatientNotes").click();
        });

        function validateForm() {
            var textarea = document.getElementByClassName("transcription");
            if (textarea.value.length > 700) {
                alert("Text exceeds maximum length of 1000 characters.");
                return false;
            }
            return true;
        }
        $(document).ready(function() {

            $('textarea').change(function() {
                generateTextNow = $(this).val();
                // alert(generateTextNow);
                $('#inputbox').text(generateTextNow);
            });

            // -----------------------------------------------------


            //Old Code
            var transcriptionDiv = document.getElementById("transcription");
            var toggleButton = document.getElementById("toggleButton");
            // console.log("Toggle Button:" , toggleButton);
            var statusDiv = document.getElementById("status");
            var isListening = false;
            var recognition = null;

            //statusDiv.textContent = navigator.vendor;
            toggleButton.addEventListener("click", function() {

                var image = event.target;
                var currentSrc = image.src;

                var firstImage = '{{ asset('images/record-icon.png') }}';
                var secondImage = '{{ asset('images/assist/mic.png') }}';

                isListening = !isListening;

                image.src = isListening ? secondImage : firstImage;

                if (isListening) {
                    startRecording();
                } else {
                    stopRecording();
                }
            });

            function startRecording() {
                try {

                    if (navigator.vendor && navigator.vendor.indexOf('Apple') > -1) {
                        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                        recognition = new SpeechRecognition();
                        recognition.continuous = true;
                    } else {
                        recognition = new webkitSpeechRecognition();
                        recognition.continuous = true;
                    }

                    recognition.onstart = function(event) {
                        toggleButton.textContent = "Stop Speech Recognition";
                        statusDiv.textContent = "Speech recognition in progress...";
                    };

                    recognition.onresult = function(event) {
                        var transcription = "";
                        for (var i = event.resultIndex; i < event.results.length; ++i) {
                            transcription += event.results[i][0].transcript;
                        }
                        transcriptionDiv.innerHTML = transcriptionDiv.innerHTML + " " + transcription;
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
                if (navigator.vendor && navigator.vendor.indexOf('Apple') > -1) {
                    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                    let recognition = new SpeechRecognition();
                } else {
                    let recognization = new webkitSpeechRecognition();
                }

                recognization.onstart = () => {}
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
