@extends ('layouts.layout_2')

@section('head')
    <title>About Us &#8211; Dian</title>
@endsection

<style>
    .box {
        background-color: #102335;
        /* width: 300px; */
        /* border: 15px solid green; */
        padding: 30px !important;
        margin-bottom: 20px;
        height: auto;
    }

    .w-6 {
        width: 6rem !important;
    }

    #more {
        display: none;
    }

    .notes {
        font-size: 30px;
        font-weight: 300;
    }
</style>



@section('content')
    <div class="content-body">

        {{-- @include('pages.subheader') --}}


        <div class="container-fluid">


            <div class="row">

                <div class="col-md-6">

                    <p class="introducin">Introducing</p>
                    <p class="your_perso">Your Personalised Platform for
                        Dentists</p>
                    <p class="step_into_">Step into DIAN Club, the platform crafted exclusively with your needs in mind.
                        We've woven your aspirations and desires into every aspect.</p>
                    <p class="step_into_">Unveil a world of tailored resources—immersive videos, captivating podcasts, and
                        insightful blogs—that resonate with your journey in dentistry. Our AI-driven tools are finely tuned
                        to your workflow, easing patient interactions and note-taking.</p>
                    <p class="step_into_">The courses and webinars? They're shaped by your thirst for knowledge and growth,
                        whether you're a seasoned expert or an aspiring student. And because we care about your well-being,
                        find a dedicated space offering valuable insights to balance your career and life.</p>
                    <p class="step_into_" style="color: white !important">Join the club and become a part of our community!
                    </p>
                    <a href="{{ route('signin') }}">
                        <button type="button" class="btn3  anek-telugu">Join Us Now</button>
                    </a>
                </div>
                <div class="col-md-6">

                    <img class="" src="{{ asset('images/assist/about.png') }}">
                    <div class="py-3"></div>
                    <p class="step_into_"> For practice owners like you, our support spans beyond dentistry. Count on us for
                        informed decisions,
                        enriched by financial insights and business tools. Your voice echoes in our interactive forum—a
                        community that listens, shares, and uplifts.</p>

                    <p class="step_into_"> This is your moment—DIAN Club is your masterpiece, reflecting your journey,
                        desires, and dreams. Elevate your dental career, exclusively with DIAN Club.</p>


                </div>
            </div>

            <div class="row">
                <p class="your_perso">Meet The Team</p>
                <div class="col-md-6">
                    <div class="box">

                        <div class="row">
                            <div class="col-md-5">
                                <img class="w-30" src="{{ asset('images/assist/profile1.png') }}">
                            </div>
                            <div class="col-md-7">
                                {{-- <p class="notes anek-telugu">Notes</p> --}}
                                <p class="introducin1">Dr. Nicola Z Gore</p>
                                <p class="step_into1_">BDS MClinDent (Fixed & Removable Prosthodontics)
                                    MJDF RCS
                                    PG Cert (Dental Education)
                                    PG Dip Orthodontics
                                    Fellowship (College Of General Dentist) FCGDent
                                    <span id="dots">...</span><span id="more">
                                        Dr Gore qualified in 1993 from Guy’s and St Thomas’s Hospital (U.LOND). Since
                                        qualifying, she has held various General Practice and Hospital maxillofacial posts
                                        within the UK and Australia.

                                        Over a two year full time programme, she gained a Masters degree in Clinical
                                        Dentistry (Fixed and Removable Prosthodontics) from The Royal London
                                        Hospital(U.LOND). In 2003, she opened her first mixed NHS/ Private squat practice
                                        and in 2009, a second private practice from Squat also.

                                        She soon realised her passion for teaching and became heavily involved in teaching
                                        and took up her role as a Dental Foundation trainer and since then has trained 25
                                        Foundation Trainees as part of Health Education England. Her passion for dentistry
                                        keeps her up to date with the latest advancements within the profession. Dr Gore
                                        regularly attends dental conferences and courses and has completed a postgraduate
                                        diploma in orthodontics , The Restorative one year Chris Orr’ programme and the one
                                        year ‘Megagen Implant’ Course. She is an experienced ‘Elite Invisalign provider’
                                        since 2017.

                                        In June 2023 she was honoured to have gained her Fellowship from the prestigious
                                        College Of General Dentistry (FCGDent)

                                        Dr Gore is on the Committee of The British Academy Of Cosmetic Dentistry (BACD) as
                                        well as being the President and Co-founder of The British Iranian Dental Association
                                        (BIDA). Being an experienced Educational Supervisor and dental educator has given
                                        her the tools to be able to engage with the dental students and younger dentists. Dr
                                        Gore and Dr Mann have visited many UK dental universities and given talks and
                                        webinars on various topics in dentistry as well as sponsored many dental
                                        undergraduates and postgraduate events through Dentistry In a Nutshell.

                                        The Birth of her recently co-authored book ‘Dentistry In A Nutshell’ has been the
                                        result of 30 years of clinical dentistry & teaching. She has been fortunate to have
                                        met and collaborated with Dr Raabiha Maan to develop such a great clinical textbook.

                                        Dr Gore has a YouTube Channel (Dr Nicola Z Gore) and also on Instagram
                                        (@Dentalcosmeticss).
                                    </span>
                                </p>


                                <p class="introducin3" style="cursor: pointer;" onclick="myFunction()" id="myBtn">Read
                                    more</p>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="box">

                        <div class="row">
                            <div class="col-md-5">
                                <img class="w-30" src="{{ asset('images/assist/profile2.png') }}">
                            </div>
                            <div class="col-md-7">
                                {{-- <p class="notes anek-telugu">Notes</p> --}}
                                <p class="introducin1">Dr. Raabiha Maan</p>
                                <p class="step_into1_">BDS (Hons)
                                    Postgraduate Diploma in Restorative and Aesthetic Dentistry
                                    Dr Raabiha graduated with BDS honours from Barts and the London School

                                    <span id="dots1">...</span><span id="more1" style="display: none">
                                        of Medicine and Dentistry in 2014.
                                        Soon after qualifying she went on to become one of the youngest Dental Foundation
                                        Trainers, for the North East London scheme. She is also a clinical mentor to
                                        international dentists coming to work in the UK.

                                        Dr Raabiha is a practice owner of a 5 chair mixed (NHS and private) dental practice
                                        in Isleworth, London. Here she practices general dentistry with a keen interest in
                                        cosmetic dentistry.

                                        She has undertaken several training courses in aesthetic dentistry and has a
                                        postgraduate diploma in restorative and aesthetic dentistry.

                                        Dr Raabiha thoroughly enjoys teaching dentistry and is often asked to lecture at
                                        universities and give webinars on various topics within dentistry.

                                        She has successfully launched her own course on The Patient Journey and effective
                                        communication and as a result trains and mentors dentists on patient-focused care.

                                        Dr Raabiha is on the editorial board of the prestigious Dentistry Magazine and is a
                                        key opinion leader for companies such as Orascoptic, Optident and Acteon.

                                        She has a following of over 11,000 people on her Instagram @drraabihamaan which she
                                        uses to teach, motivate and inspire the next generation of dentists.
                                    </span>
                                </p>

                                <p class="introducin3" style="cursor: pointer;" onclick="myFunction1()" id="myBtn1">Read
                                    more</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>

    <script>
        function myFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read less";
                moreText.style.display = "inline";
            }
        }

        function myFunction1() {
            var dots = document.getElementById("dots1");
            var moreText = document.getElementById("more1");
            var btnText = document.getElementById("myBtn1");

            if (dots1.style.display === "none") {
                dots1.style.display = "inline";
                btnText.innerHTML = "Read more";
                moreText.style.display = "none";
            } else {
                dots1.style.display = "none";
                btnText.innerHTML = "Read less";
                moreText.style.display = "inline";
            }
        }
    </script>
@endsection
