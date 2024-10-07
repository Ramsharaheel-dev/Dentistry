@extends ('layouts.layout_2')

@section('head')
    <title>Contact &#8211; Dian</title>
@endsection

<style>
    .box {
        background-color: #102335;
        /* width: 300px; */
        /* border: 15px solid green; */
        padding: 35px;
        margin-bottom: 20px;
        height: 260px;
    }

    .w-6 {
        width: 6rem !important;
    }

    .notes {
        font-size: 19px;
        font-weight: 300;
    }

    .speech_to_ {
        font-size: 18px !important;
        font-weight: 400;
        color: rgba(255, 255, 255, 1);
    }
</style>



@section('content')
    <div class="content-body">

        {{-- @include('pages.subheader') --}}
        <div class="container-fluid">
            <p class="introducin">Contact Us</p>

            <div class="row">

                <div class="col-md-4">

                    <div class="box">

                        <div class="row justify-content-center">
                            <img class="w-6" src="{{ asset('images/assist/email.png') }}">
                        </div>

                        <br>
                        <div class="row text-center">
                            <p class="notes anek-telugu">Have a question, concern or complaint?Send your message to</p>

                        </div>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <a href="mailto:team@dentistryinanutshell.com">
                                    <p class="speech_to_">team@dentistryinanutshell.com</p>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="box">

                        <div class="row justify-content-center">
                            <img class="w-6" src="{{ asset('images/assist/email.png') }}">
                        </div>

                        <br>
                        <div class="row text-center">
                            <p class="notes anek-telugu">Keen to get involved and explore working with us? Send your message
                                to</p>

                        </div>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <a href="mailto:admin@dentistryinanutshell.com">
                                    <p class="speech_to_">admin@dentistryinanutshell.com</p>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="box">

                        <div class="row justify-content-center">
                            <img class="w-6" src="{{ asset('images/assist/email.png') }}">
                        </div>

                        <br>
                        <div class="row text-center">
                            <p class="notes anek-telugu">Want to advertise your service or product send your message to</p>

                        </div>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <a href="mailto:team@dentistryinanutshell.com">
                                    <p class="speech_to_">team@dentistryinanutshell.com</p>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
