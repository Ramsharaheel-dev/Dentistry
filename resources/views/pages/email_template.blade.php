@extends ('layouts.layout_2')

@section('head')
    <title>Email Template &#8211; Dian</title>
@endsection

@section('custom_style')
    <style>
        #startRecord,
        #stopRecord,
        #replayRecord {
            background-color: #d9aa5a;
            color: white;
            padding: 10px 28px;
            border-radius: 5px;
            width: auto;
            cursor: pointer;
            text-align: center;
        }

        #replayRecord {
            display: none;
        }

        .video-bg {
            background-color: #151C2C;
        }

        .replay-btn {
            margin-top: 28px;
            font-size: 20px;
        }

        /* Increase specificity */
        .chosen-container .chosen-results::-webkit-scrollbar {
            width: 12px !important;
        }

        .chosen-container .chosen-results::-webkit-scrollbar-track {
            background: #400000 !important;
        }

        .chosen-container .chosen-results::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #ff0000, #00ff00, #0000ff) !important;
            border-radius: 10px !important;
        }

        /* video */

        @media (max-width: 767px) {
            .template-container {
                margin: 10px;
                width: 100%;
                padding: 0px;
            }

            #startRecord,
            #stopRecord {
                width: 35%;
            }

        }

        .video-bg {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* .chosen-container-multi .chosen-choices {
                        height: auto !important;
                    } */
    </style>
@endsection

@section('content')
    <div class="content-body">

        {{-- @include('require_2.hashtag-assist') --}}

        <div class="container-fluid">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li style="list-style-type:none;">{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('sendPatientEmail') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" class="form-control1 input-default " id="dentistName" name="dentistName"
                                placeholder="Dentist Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" class="form-control1 input-default " id="practiceEmail"
                                name="practiceEmail" placeholder="Practice Email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" class="form-control1 input-default " id="patientName"
                                placeholder="Patient Name" name="patientName" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" class="form-control1 input-default " id="patientEmail" name="patientEmail"
                                placeholder="Patient Email" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" class="form-control1 input-default " id="subject" name="subject"
                                placeholder="Subject" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input type="text" class="form-control1 input-default " id="custom" name="dentistEmail"
                                placeholder="Dentist Email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3 video-bg">
                            <video id="video" width="640" height="480" autoplay></video>
                        </div>
                    </div>
                    <div class=" py-3 text-center">
                        <button type="button" id="startRecord" class="copyTextBtn btn3 custom anek-telugu mr-13">Start
                            Recording</button>
                        <button type="submit" id="stopRecord" class="btn2 anek-telugu mr-13"
                            style="width: auto !important;">Stop Recording</button>
                        <div class="text-center replay-btn">
                            <a target="_blank" id="replayRecord" style="margin-top:5px">Replay Recording</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <select multiple class="chosen-select default-select  form-select form-select-lg mb-3 wide "
                            name="selectProcedure" id="selectProcedure">
                            <optgroup disabled hidden></optgroup>
                            @foreach ($emailTemplates as $emailTemplate)
                                <option value="{{ $emailTemplate->procedureTreatment }}"
                                    introduction="{{ $emailTemplate->introduction }}" pros="{{ $emailTemplate->pros }}"
                                    cons="{{ $emailTemplate->cons }}" content="{{ $emailTemplate->content }}"
                                    summary="{{ $emailTemplate->summary }}">
                                    {{ $emailTemplate->procedureTreatment }}

                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <p style="color:#bcbcbc;margin-top:10px">Note: Please read the chosen template(s) carefully and
                            ensure
                            the price is added or deleted before sending. </p>
                        <textarea class="textarea1 form-control" id="emailContent" name="emailContent" rows="8"></textarea>
                    </div>
                </div>
                <div class=" pt-0 mb-4">
                    <button type="submit" id="emailTemplateSubmitBtn"class="btn4 anek-telugu">Send
                        email</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('customjs')
    <script src="{{ asset('js/videoRecorder.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".chosen-select").chosen({
                no_results_text: "Oops, nothing found!"
            });

            $('select').change(function() {
                $('#emailContent').text('');
                generateEmailContent();
            });

            function generateEmailContent() {
                var selectedValues = $('select').val();
                $content = [];
                $('#selectProcedure option:selected').each(function() {
                    $value = $(this).attr('introduction') + "\n\n" +
                        "Advantages:\n" +
                        $(this).attr('pros') + "\n\n" + "Disadvantages:\n" +
                        $(this).attr('cons') + "\n\n" + $(this).attr('content') + '\n\n' +
                        'Price:' + '\n\n' + $(this).attr('summary');

                    console.log($content);
                    $content.push($value);
                });
                $('#emailContent').text($content);
            }
        });
    </script>
@endsection
