@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection

@section('content')
    <div class="content-body">

        <div class="container">
            <p class="notes1 anek-telugu text-center">Guidebook</p>
            <p class="speech_to_ text-center">Dentistry in a Nutshell</p>
            <p class="step_into_2 anek-telugu text-center">How do you create a blueprint when a matching anterior teeth for a
                bridge, crown or implant? Below you can see how you can use keynote and mark up to create a digital
                blueprint that allow you to plan aesthetic cases in advance & transfer the salient information to your lab
                in a simple, visual format.This case is in its infancy but the patient needed an implant to replace his
                central incisor. This was completed but how do we communicate with the lab our vision for the TEMPORARY?</p>

            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <img class="w-100" src="{{ asset('images/blogs/blog1.png') }}" alt="">
                    <div class="py-4">
                        <p class="speech_to_ text-center">We use a simple trick on Keynote</p>
                        <p class="step_into_2 anek-telugu text-center">We can cut out the contralateral incisor and flip the
                            image and insert it to give our technician an indication on shape</p>
                    </div>
                    <img class="w-100" src="{{ asset('images/blogs/blog2.png') }}" alt="">
                    <div class="py-4">
                        <p class="speech_to_ text-center">We use a simple trick on Keynote</p>
                        <p class="step_into_2 anek-telugu text-center">We can cut out the contralateral incisor and flip the
                            image and insert it to give our technician an indication on shape</p>
                    </div>
                    <img class="w-100" src="{{ asset('images/blogs/blog3.png') }}" alt="">
                    <div class="py-4">
                        <p class="speech_to_ text-center">Implant placement Hard & Soft tissue graft Custom healer</p>
                        <p class="step_into_2 anek-telugu text-center">Initial blanching is evident and we need to ensure
                            this disappears within 5 minutes.</p>
                    </div>
                    <img class="w-100" src="{{ asset('images/blogs/blog4.png') }}" alt="">
                    <div class="py-4">
                        <p class="speech_to_ text-center">Temporary acrylic crown seating</p>
                        <p class="step_into_2 anek-telugu text-center">Initial blanching is evident and we need to ensure
                            this disappears within 5 minutes.
                        </p>
                    </div>
                    <img class="w-100" src="{{ asset('images/blogs/blog4.png') }}" alt="">
                    <div class="py-4">
                        <p class="speech_to_ text-center">Temporary acrylic crown seating</p>
                        <p class="step_into_2 anek-telugu text-center">Initial blanching absent - review in 4 weeks.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row py-4">
                <div class="col-md-12">
                    <button type="button" class="btn1 btn-secondary anek-telugu">New content released every
                        month</button>
                </div>
            </div>
        </div>

    </div>
@endsection
