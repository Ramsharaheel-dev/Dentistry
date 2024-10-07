@extends ('layouts.layout')

@section('head')
    <title>Dian Payment Gateway</title>
@endsection

@section('content')
    @include('requires.header-home')
    <style>
        .elementor-5 .elementor-element.elementor-element-ad9bb5d>.elementor-container {
            min-height: 0px;
        }

        .stripe {
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 50px 0px;
            height: 50vh;
        }

        h3 {
            color: white;
            font-size: 22px;
        }

        .form-row .form-group label {
            color: white;
        }

        .btn {
            background-color: #d9aa5a;
            border: 1px solid #d9aa5a;
        }

        .btn:hover {
            background-color: #d9aa5a;
        }

        .panel {
            border: 1px solid #20201f;
            padding: 30px 40px;
            background-color: #20201f;
            border-radius: 10px;
            padding-top: inherit;
        }

        p {
            margin: 0;
            color: white;
        }

        .form-row {
            margin-bottom: 10px;
        }

        .dashboardBtn {
            font-family: "Roboto", Sans-serif;
            font-size: 20px;
            font-weight: 500;
            letter-spacing: 1px;
            text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            background-color: #d9aa5a !important;
            border-radius: 7px 7px 7px 7px;
            padding: 20px 25px 20px 25px;
        }
    </style>

    <div class="stripe" style="overflow:hidden">
        <div class="container ">
            <div class="row justify-content-md-center">
                <h3 style="text-align: center;margin-top: 40px;margin-bottom: 40px;">Payment has been successfull and
                    subscription activated</h3>

                <div class="elementor-element elementor-element-bb9341f elementor-align-left elementor-widget elementor-widget-button"
                    data-id="bb9341f" data-element_type="widget" data-widget_type="button.default">
                    <div class="elementor-widget-container">
                        <div class="elementor-button-wrapper" style="text-align: center"> <a
                                href="{{ route('setup-profile') }}"
                                class="elementor-button-link elementor-button elementor-size-sm dashboardBtn"
                                role="button"> <span class="elementor-button-content-wrapper"> <span
                                        class="elementor-button-icon elementor-align-icon-left"> </span> <span
                                        class="elementor-button-text" style="margin-top:2px;">Complete your profile</span>
                                </span> </a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
@endsection
