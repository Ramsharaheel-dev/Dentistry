@extends ('layouts.layout')

@section('head')
    <title>Email Template &#8211; Dian</title>


@endsection

@section('custom_style')

 <style>
        .elementor-5 .elementor-element.elementor-element-ad9bb5d>.elementor-container {
            min-height: 0px;
        }

        .template-container {
            margin: 10px;
            width: 100%;
            padding: 50px 100px;
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

       /* .chosen-container-multi .chosen-resultsresults::-webkit-scrollbar {
    width: 50px !important;

} */


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
            background-color: #646464 !important;
            color: #d2d2d2 !important;
            border: none !important;
            font-size: 14px !important;
            border-radius: 5px !important;
            height: 3.25em !important;
            padding: 5px 22.5px 5px 10px !important;
            font-style: italic !important;
            margin-bottom: 15px;
        }

        .copyTextBtn {
            font-family: "Roboto", Sans-serif !important;
            font-size: 20px !important;
            font-weight: 500 !important;
            letter-spacing: 1px !important;
            text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3) !important;
            background-color: var(--e-global-color-9caa857) !important;
            border-radius: 7px 7px 7px 7px !important;
            padding: 20px 25px 20px 25px !important;
            width: -webkit-fill-available;
            margin-top: 5px !important;
        }

          /* ::-webkit-scrollbar {
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
                            } */

        #emailContent {
            color: #d2d2d2;
            background-color: #646464;
            font-style: italic;
            margin-top: 5px;
            border: none;
        }

        textarea {
            margin-bottom: 5px;
        }

        ::placeholder {
            color: #8c8c8c;
        }

        select.templateFormSelect option:hover {
            box-shadow: 0 0 10px 100px #D9AA5A;
        }

        #video {
            border: 1px solid #a0a0a0;
            margin: 10px 0px;
        }

        #startRecord,
        #stopRecord,
        #replayRecord {
            background-color: #d9aa5a;
            color: white;
            padding: 10px;
            border-radius: 5px;
            width: 15%;
            cursor: pointer;
            text-align: center;
        }

                #replayRecord {
                    display: none;
                }
                div, span, ol, ul {
                scrollbar-width: inherit !important;
            }

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
    </style>


@endsection

@section('content')
    @include('requires.header-assist')

    <div class="template-container">

        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li style="list-style-type:none;">{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('sendPatientEmail') }}">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <p class="templateHeading">Dentist Name</p>
                    <input class="templateFormInput" required id="dentistName" type="text" name="dentistName">
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <p class="templateHeading">Practice Email</p>
                    <input class="templateFormInput" required id="dentistEmail" type="email" name="practiceEmail">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <p class="templateHeading">Patient Name</p>
                    <input class="templateFormInput" required id="patientName" type="text" name="patientName">
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <p class="templateHeading">Patient Email</p>
                    <input class="templateFormInput" required id="patientEmail" type="email" name="patientEmail">
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <p class="templateHeading">Subject</p>
                    <input class="templateFormInput" required id="subject" type="text" name="subject">
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <p class="templateHeading">Dentist Email</p>
                    <input class="templateFormInput" required id="custom" type="text" name="dentistEmail">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <video id="video" width="640" height="480" autoplay></video>

                    <div id="startRecord">Start Recording</div>
                    <div id="stopRecord" disabled style="margin-top:5px">Stop Recording</div>
                    <a target="_blank" id="replayRecord" style="margin-top:5px">Replay Recording</a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <p class="templateHeading">Select Procedure</p>

                    <select multiple class="chosen-select templateFormSelect form-select form-select-lg mb-3"
                        name="selectProcedure" id="selectProcedure" aria-label=".form-select-lg example">
                        <optgroup disabled hidden></optgroup>
                        @foreach ($emailTemplates as $emailTemplate)
                            <option value="{{ $emailTemplate->procedureTreatment }}"
                                introduction="{{ $emailTemplate->introduction }}" pros="{{ $emailTemplate->pros }}"
                                cons="{{ $emailTemplate->cons }}" content="{{ $emailTemplate->content }}"
                                summary="{{ $emailTemplate->summary }}">{{ $emailTemplate->procedureTreatment }}

                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <p style="color:#bcbcbc;margin-top:10px">Note: Please read the chosen template(s) carefully and ensure
                        the price is added or deleted before sending. </p>
                    <textarea id="emailContent" name="emailContent" rows="45" cols="50">
            </textarea>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <input type="submit" id="emailTemplateSubmitBtn" class="copyTextBtn" value="Send Email">
                </div>
            </div>
    </div>

    </form>
@endsection

@section('customjs')
    <script src="{{ asset('js/videoRecorder.js') }}"></script>
    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        });

        $(document).ready(function() {
            $('select').change(function() {
                $('#emailContent').text('');
                generateEmailContent();
            });

            function generateEmailContent() {
                var selectedValues = $('select').val();
                $content = [];
                $('#selectProcedure option:selected').each(function() {
                    $value = $(this).attr('introduction') + "\n\n" +
                        "Let's start with the pros, of teeth whitening:\n" +
                        $(this).attr('pros') + "\n\n" + "Let's consider the cons, of teeth whitening:\n" +
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
