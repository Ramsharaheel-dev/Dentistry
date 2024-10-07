@extends ('layouts.layout_2')

@section('head')
    <title>Assist &#8211; Dian</title>
@endsection

<style>


    .box:hover {
        background: #191920;
        width: 100%;
        /* padding: 40px; */
        /* margin: 15px; */
        /* border: 1px solid goldenrod; */
    }

    .w-6 {
        width: 6rem !important;
    }

    .notes {
        font-size: 30px;
        font-weight: 300;
    }

    .speech_to_ {
        font-size: 32px;
        font-weight: 400;
        color: rgba(255, 255, 255, 1);
    }

    .notes {
        font-size: 30px;
        font-weight: 300;
        color: white;
    }

    /* @media (min-width: 300px) and (max-width: 480px){
        img, svg {
    vertical-align: middle;
    width: 15%;
}
} */
</style>

@section('content')
    <div class="content-body">

        <div class="container-fluid">

            <p class="please_acc anek-telugu">Please access the ASSIST feature only in laptops and desktop computers. We are
                currently working towards
                making in available in other form factors like Tablets and mobile and will be available soon!</p>
            <div class="row">

                <div class="col-md-6">
                    <a href="{{ route('speechToTextNotes') }}">
                        <div class="box">

                            <div class="row">
                                <img class="w-6" src="{{ asset('images/assist/speech-to-text.png') }}">
                            </div>

                            <br>
                            <div class="row">
                                <p class="notes anek-telugu">Notes</p>

                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="speech_to_">Speech To Text</p>
                                </div>
                                <div class="col-md-2">
                                    {{-- <img class="w-15"
                                        src="{{ asset('images/assist/next.png') }}"> --}}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('emailTemplate') }}">
                        <div class="box">

                            <div class="row">
                                <img class="w-6" src="{{ asset('images/assist/email.png') }}">
                            </div>

                            <br>
                            <div class="row">
                                <p class="notes anek-telugu">Patient</p>

                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="speech_to_">Email Sender</p>
                                </div>
                                <div class="col-md-2">
                                    {{-- <img class="w-15"
                                        src="{{ asset('images/assist/next.png') }}"> --}}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="py-2">
                <div class="row">

                    <div class="col-md-6">
                        <a href="{{ route('allTemplates') }}">
                            <div class="box">

                                <div class="row">
                                    <img class="w-6" src="{{ asset('images/assist/mouse.png') }}">
                                </div>

                                <br>
                                <div class="row">
                                    <p class="notes anek-telugu">Notes</p>

                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="speech_to_">Templates</p>
                                    </div>
                                    <div class="col-md-2">
                                        {{-- <img class="w-15"
                                            src="{{ asset('images/assist/next.png') }}"> --}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href=" {{ route('assistVideos') }}">
                            <div class="box">

                                <div class="row">
                                    <img class="w-6" src="{{ asset('images/assist/explainer.png') }}">
                                </div>

                                <br>
                                <div class="row">
                                    <p class="notes anek-telugu">Patient</p>

                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="speech_to_">Explainer Videos</p>
                                    </div>
                                    <div class="col-md-2">

                                        {{-- <img class="w-15"
                                            src="{{ asset('images/assist/next.png') }}"> --}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn1 btn-secondary anek-telugu">New content released every
                            month</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

<script>
    $(document).ready(function() {
        window.onload = function() {
            console.log("ready!");

        }
    });
</script>

