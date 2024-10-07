@extends ('layouts.layout')

@section('head')
<title>AboutUs &#8211; Dian</title>
<link rel='stylesheet' id='font-awesome-css' href="{{asset('css/aboutUs.css')}}"/>
@endsection

@section('content')

@include('requires.header-home')


<div class="aboutus-container">
    <!-- <video width="320" height="240" autoplay controls style="height:auto">
        <source src="{{URL::asset('/images/sample.mp4')}}" type="video/mp4">
        Your browser does not support the video tag.
    </video> -->
    <div class="aboutus-wrap">
        <p class="aboutus-heading">Introducing </p>
        
        <img class="aboutus-heading-img" decoding="async" width="300" height="59" src="./images/2023-02-DIAN-Club.png" class="attachment-medium size-medium wp-image-109" alt="" loading="lazy" srcset="./images/2023-02-DIAN-Club.png 300w, ./images/2023-02-DIAN-Club.png 370w" sizes="(max-width: 300px) 100vw, 300px" />
        <p class="aboutus-heading-content">Your Personalised Platform for Dentists</p>
    </div>
    <!-- <p class="aboutus-content">Welcome to DIAN Club, the ultimate platform for all dentists.</p> -->
    <p class="aboutus-content">Step into DIAN Club, the platform crafted exclusively with your needs in mind. We've woven your aspirations and desires into every aspect.</p>
    <p class="aboutus-content">Unveil a world of tailored resources—immersive videos, captivating podcasts, and insightful blogs—that resonate with your journey in dentistry. Our AI-driven tools are finely tuned to your workflow, easing patient interactions and note-taking.
</p>
    <p class="aboutus-content">The courses and webinars? They're shaped by your thirst for knowledge and growth, whether you're a seasoned expert or an aspiring student. And because we care about your well-being, find a dedicated space offering valuable insights to balance your career and life.
</p>
    <p class="aboutus-content">For practice owners like you, our support spans beyond dentistry. Count on us for informed decisions, enriched by financial insights and business tools. Your voice echoes in our interactive forum—a community that listens, shares, and uplifts.</p>
    <p class="aboutus-content">This is your moment—DIAN Club is your masterpiece, reflecting your journey, desires, and dreams. Elevate your dental career, exclusively with DIAN Club.</p>
  
    
    <a href="{{ route('signin') }}" class="aboutus-content" style="font-weight:bolder">Join the club and become a part of our community!</a>

    <div class="elementor-element elementor-element-dda7f02 elementor-align-center elementor-widget elementor-widget-button" data-id="dda7f02" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('signin') }}" class="joinNowBtn elementor-button-link elementor-button elementor-size-sm" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-text">Join Now</span> </span> </a> </div>
    </div>
    <p class="aboutus-heading2">Meet the Team</p>

    <div class="team1 team">
        
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-3 col-xs-12 teamMemImgContainer">
                <img class="team-mem-img" decoding="async" width="300" height="59" src="./images/NICOLA.png" class="attachment-medium size-medium wp-image-109" alt="" loading="lazy" />
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 teamMemContent">
                <h1 class="team-mem-name">Dr. Nicola Z Gore</h1>
                <p class="team-mem-designation">BDS MClinDent (Fixed & Removable Prosthodontics)</p>
                <p class="team-mem-designation">MJDF RCS</p>
                <p class="team-mem-designation">PG Cert (Dental Education)</p>
                <p class="team-mem-designation">PG Dip Orthodontics</p>
                <p class="team-mem-designation">Fellowship (College Of General Dentist) FCGDent</p>
                
            </div>
        </div>
        <p id="teamMember1" style="margin:0 auto;margin-top:20px" data-content="toggle-text">Read More</p>
        
        <div class="row justify-content-center" id="teamMemberContent1">
            <div class="col-12">
                <p class="team-mem-description">Dr Gore qualified in 1993 from Guy’s and St Thomas’s Hospital (U.LOND). Since qualifying, she has held various General Practice and Hospital maxillofacial posts within the UK and Australia.</p>
                <p class="team-mem-description">Over a two year full time programme, she gained a Masters degree in Clinical Dentistry (Fixed and Removable Prosthodontics) from The Royal London Hospital(U.LOND). In 2003, she opened her first mixed NHS/ Private squat practice and in 2009, a second private practice from Squat also.</p>
                <p class="team-mem-description">She soon realised her passion for teaching and became heavily involved in teaching and took up her role as  a Dental Foundation trainer and since then has trained 25 Foundation Trainees as part of Health Education England. Her passion for dentistry keeps her up to date with the latest advancements within the profession. Dr Gore regularly attends dental conferences and courses and has completed a postgraduate diploma in  orthodontics , The Restorative one year Chris Orr’ programme and the one year ‘Megagen Implant’ Course. She is an experienced ‘Elite Invisalign provider’ since 2017.</p>
                <p class="team-mem-description">In June 2023 she was honoured to have gained her Fellowship from the prestigious College Of General Dentistry (FCGDent) </p>
                <p class="team-mem-description">Dr Gore is on the Committee of The British Academy Of Cosmetic Dentistry (BACD) as well as being the President and Co-founder of The British Iranian Dental Association (BIDA). Being an experienced Educational  Supervisor and dental educator has given her the tools to be able to engage with the dental students and younger dentists.
                Dr Gore and Dr Mann have visited many UK dental universities and given talks and webinars on various topics in dentistry as well as sponsored many dental undergraduates and postgraduate events through Dentistry In a Nutshell.
                    </p>
                <p class="team-mem-description">The Birth of her recently co-authored book ‘Dentistry In A Nutshell’ has been the result of 30 years of clinical dentistry & teaching. She has been fortunate to have met and collaborated with Dr Raabiha Maan to develop such a great clinical textbook.</p>
                <p class="team-mem-description">Dr Gore has a YouTube Channel (Dr Nicola Z Gore) and also on Instagram (@Dentalcosmeticss).</p>
            </div>
        </div>
    </div>

    <div class="team2 team">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-3 col-xs-12 teamMemImgContainer">
                <img class="team-mem-img" style="width: 100%;border-radius: 50%;" decoding="async" width="300" height="59" src="./images/Raabiha Maan.jpg" class="attachment-medium size-medium wp-image-109" alt="" loading="lazy" />
            </div>
            
            <div class="col-lg-4 col-md-4 col-xs-12 teamMemContent">
                <h1 class="team-mem-name">Dr. Raabiha Maan</h1>
                <p class="team-mem-designation">BDS (Hons)</p>
                <p class="team-mem-designation">Postgraduate Diploma in Restorative and Aesthetic Dentistry</p>
                
            </div>
        </div>

        <p id="teamMember2" style="margin:0 auto;margin-top:20px" data-content="toggle-text">Read More</p>
       
        <div class="row justify-content-center" id="teamMemberContent2" >
            <div class="col-12">
                <p class="team-mem-description">Dr Raabiha graduated with BDS honours from Barts and the London School of Medicine and Dentistry in 2014.</p>
                <p class="team-mem-description">Soon after qualifying she went on to become one of the youngest Dental Foundation Trainers, for the North East London scheme. She is also a clinical mentor to international dentists coming to work in the UK.</p>
                <p class="team-mem-description">Dr Raabiha is a practice owner of a 5 chair mixed (NHS and private) dental practice in Isleworth, London. Here she practices general dentistry with a keen interest in cosmetic dentistry.</p>
                <p class="team-mem-description">She has undertaken several training courses in aesthetic dentistry and has a postgraduate diploma in restorative and aesthetic dentistry.</p>
                <p class="team-mem-description">Dr Raabiha thoroughly enjoys teaching dentistry and is often asked to lecture at universities and give webinars on various topics within dentistry.</p>
                <p class="team-mem-description">She has successfully launched her own course on The Patient Journey and effective communication and as a result trains and mentors dentists on patient-focused care.</p>
                <p class="team-mem-description">Dr Raabiha is on the editorial board of the prestigious Dentistry Magazine and is a key opinion leader for companies such as Orascoptic, Optident and Acteon.</p>
                <p class="team-mem-description">She has a following of over 11,000 people on her Instagram @drraabihamaan which she uses to teach, motivate and inspire the next generation of dentists.</p>
            </div>
        </div>
    </div>

</div>

<script>
    $("#teamMemberContent1").hide();
    $("#teamMemberContent2").hide();
    $("#teamMember1").on("click", function () {
        var txt = $("#teamMember1").is(':visible') ? 'Read More' : 'Read Less';
        $("#teamMember1").text(txt);
        $(this).next('#teamMemberContent1').slideToggle(200);
    });
    $("#teamMember2").on("click", function () {
        var txt = $("#teamMember2").is(':visible') ? 'Read More' : 'Read Less';
        $("#teamMember2").text(txt);
        $(this).next('#teamMemberContent2').slideToggle(200);
    });
</script>
@endsection