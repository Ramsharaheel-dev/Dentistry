<style>
    .content-section {
        display: grid;
        grid-template-columns: fit-content(300px) fit-content(300px) 1fr;
        grid-gap: 5px;
        box-sizing: border-box;
        padding: 5px;
    }

    .menu-item a {
        padding: 20px;
        padding-bottom: 10px;
        border: 1px solid #1B3E70;
        color: #1B3E70;
        text-decoration: none;
    }

    .menu-item a:hover {
        background-color: #1B3E70;
        color: white;
    }

    .menu-item .active {
        background-color: #1B3E70;
        color: white;

    }

    /* .elementor-5 .elementor-element.elementor-element-a19c20e .elementor-button {
                                   background-color: var(--e-global-color-9caa857);
                               background-color: #222;
                               border-radius: 5px 5px 5px 5px;
                               padding: 10px 10px 10px 10px;
                               }

                               */
    .elementor-5 .elementor-element.elementor-element-51ed8f9 .elementor-button,
    .elementor-5 .elementor-element.elementor-element-51ed8f8 .elementor-button,
    .elementor-5 .elementor-element.elementor-element-a19c20e .elementor-button {
        background-color: #232323;
        border-radius: 5px 5px 5px 5px;
        padding: 10px 10px 10px 10px;
    }

    .inactive {
        background-color: #232323;
        border-radius: 5px 5px 5px 5px;
        padding: 10px 10px 10px 10px;
    }

    .active {
        background-color: var(--e-global-color-9caa857) !important;
        border-radius: 5px;
    }
    .horizantalScrollMenu{
        position: relative;
        display: flex;
        align-items: center;
    }
    .horizantalScrollMenu ul{
        display: flex;
        max-width: 1100px;
        padding-left:35px;
        margin:0px 4px;
        gap: 8px;
        list-style: none;
        overflow-x: scroll;
        white-space:nowrap;
    }
    .horizantalScrollMenu ul::-webkit-scrollbar{
        display:none;
    }
    .horizantalScrollMenu ul li a{
        background-color:#232323 ;
        padding: 15px 25px !important;
        font-size: 15px !important;
    }
    .horizantalScrollMenu ul li a:hover{
        background-color:#666666 !important;
        text-decoration:none;
    }
    ..elementor-button.elementor-size-xs {
        border-radius: 5px;
    }
    .horizantalScrollMenu ul li a img{
        margin-right:5px;
    }
    .horizantalScrollMenu .leftArrow, .horizantalScrollMenu .rightArrow{
        position: absolute;
        height: 70%;
        top: 6px;
        display: flex;
        align-items: center;
        cursor: pointer;

    }
    .horizantalScrollMenu .leftArrow:hover, .horizantalScrollMenu .rightArrow:hover{
        background: #333;

    }
    .horizantalScrollMenu .leftArrow{
        background: linear-gradient(to right, black 50%, transparent);
    }
    .horizantalScrollMenu .rightArrow{
        background: linear-gradient(to left, black 50%, transparent);
        right:0;
        padding: 5px;
    }

    @media (max-width: 767px) {
        .horizantalScrollMenu{
            overflow-x: hidden;
        }
        .horizantalScrollMenu .leftArrow, .horizantalScrollMenu .rightArrow {
            position: absolute;
            height: 75%;
            top: 4px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
    }
</style>
<div class="horizantalScrollMenu">
    <img src="./images/left-chevron.png" class="leftArrow">
    <img src="./images/right-chevron.png" class="rightArrow">
    <ul>
        <li>
        <a href="{{ route('dashboard') }}" class="dashboard elementor-button-link elementor-button elementor-size-xs" role="button">
        <span class="elementor-button-content-wrapper">
            <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/videos.png" width="15" height="15" />
            <span class="elementor-button-text">Videos</span>
        </span>
        </a>
        </li>
        <li>
        <a href="{{ route('podcast') }}" class="podcast elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/podcasts.png" width="15" height="15" /> <span class="elementor-button-text">Podcast and Webinars</span> </span> </a>
        </li>
        <li>
        <a href="{{ route('assist') }}" class="assist elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/assist.png" width="15" height="15" /> <span class="elementor-button-text">Assist</span> </span> </a>
        </li>
        <li>
        <a href="{{ route('allBlogs') }}" class="blogs elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/blogs.png" width="15" height="15" /> <span class="elementor-button-text">Blogs</span> </span> </a>
        </li>
        <li>
        <a href="{{ route('student1') }}" class="student elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/learning.png" width="15" height="15" />  <span class="elementor-button-text">Student</span> </span> </a>
        </li>
        <li>
        <a href="{{ route('buildYourBusiness') }}" class="buildYourBusiness elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/business (1).png" width="15" height="15" />  <span class="elementor-button-text">Business and Finance</span> </span> </a>
        </li>
        <li>
        <a href="{{ route('downloads1') }}" class="downloads elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/downloading.png" width="15" height="15" />  <span class="elementor-button-text">Downloads</span> </span> </a>
        </li>
        <li>
        <a href="{{ route('healthAndWellbeing') }}" class="healthAndWellbeing elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images//wellbeing.png" width="15" height="15" /> <span class="elementor-button-text">Wellbeing</span> </span> </a>
        </li>
        <li>
        <a href="{{ route('courses1') }}" class="courses elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/courses.png" width="15" height="15" /> <span class="elementor-button-text">Courses</span> </span> </a>
        </li>
        <li>
        <a href="{{ route('guidelines1') }}" class="guidelines elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/guidelines.png" width="15" height="15" /><span class="elementor-button-text">Guidelines</span> </span> </a>
        </li>
        <li>
        <a href="{{ route('refer') }}" class="refer elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper">  <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/refer.png" width="15" height="15" /><span class="elementor-button-text">Refer</span> </span> </a>
        </li>
        <li>
        <a href="{{ route('forums') }}" class="forums elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/forum (1).png" width="15" height="15" /><span class="elementor-button-text">Forum</span> </span> </a>
        </li>
        <li>
        <a href="{{ route('workFlows') }}" class="workFlows elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/workflow.png" width="15" height="15" /> <span class="elementor-button-text">Work Flows</span> </span> </a>
        </li>

    <ul>

</div>
<div class="elementor-element elementor-element-3f2e332 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="3f2e332" data-element_type="widget" data-widget_type="divider.default">
    <div class="elementor-widget-container">
        <div class="elementor-divider"> <span class="elementor-divider-separator"> </span> </div>
    </div>
</div>
<!--
<div class="elementor-element elementor-element-a19c20e elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="a19c20e" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container ">
        <div class="elementor-button-wrapper"> <a href="{{ route('dashboard') }}" class="dashboard elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/video.png" width="15" height="15" /> </span> <span class="elementor-button-text">videos</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-51ed8f9 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="51ed8f8" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('podcast') }}" class="podcast elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/messaging.png" width="15" height="15" /></span> <span class="elementor-button-text">Podcast</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-51ed8f9 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="51ed8f9" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('assist') }}" class="assist elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/messaging.png" width="15" height="15" /></span> <span class="elementor-button-text">Assist</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-7f2479c elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="7f2479c" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('blogs') }}" class="blogs elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/video-camera.png" width="15" height="15" /> </span> <span class="elementor-button-text">Blogs</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-d6a8e90 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="d6a8e90" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('student1') }}" class="student elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/downloading.png" width="15" height="15" /> </span> <span class="elementor-button-text">Student</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-2f6c2ca elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="2f6c2ca" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('buildYourBusiness') }}" class="buildYourBusiness elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/bar-chart.png" width="15" height="15" /> </span> <span class="elementor-button-text">Business</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-d6a8e90 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="d6a8e90" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('downloads1') }}" class="downloads elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/downloading.png" width="15" height="15" /> </span> <span class="elementor-button-text">Downloads</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-d056cee elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="d056cee" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('healthAndWellbeing') }}" class="healthAndWellbeing elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images//wellbeing.png" width="15" height="15" /></span> <span class="elementor-button-text">Wellbeing</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-fd57985 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="fd57985" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('courses') }}" class="courses elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/learning.png" width="15" height="15" /> </span> <span class="elementor-button-text">Courses</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-fd57985 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="fd57985" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('guidelines') }}" class="guidelines elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/learning.png" width="15" height="15" /> </span> <span class="elementor-button-text">Guidelines</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-fd57985 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="fd57985" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('refer') }}" class="refer elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/learning.png" width="15" height="15" /> </span> <span class="elementor-button-text">Refer</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-d6a8e90 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="d6a8e90" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('forums') }}" class="forums elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/downloading.png" width="15" height="15" /> </span> <span class="elementor-button-text">Forum</span> </span> </a> </div>
    </div>
</div>
<div style="padding: 0;margin-top: 10px;" class="elementor-element elementor-element-d6a8e90 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="d6a8e90" data-element_type="widget" data-widget_type="button.default">
    <div style="padding: 0;" class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('workFlows') }}" class="workFlows elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/downloading.png" width="15" height="15" /> </span> <span class="elementor-button-text">Work Flows</span> </span> </a> </div>
    </div>
</div>
<div style="margin-bottom:0px;" class="elementor-element elementor-element-3f2e332 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="3f2e332" data-element_type="widget" data-widget_type="divider.default">
    <div class="elementor-widget-container">
        <div class="elementor-divider"> <span class="elementor-divider-separator"> </span> </div>
    </div>
</div> -->

@section('customjs')
<script>
    window.onload = function() {

        $activeMenu = document.getElementById('activeMenu').getAttribute("value");

        $(".rightArrow").click(function () {
            $('.horizantalScrollMenu ul').animate({
                scrollLeft: "+=200px"
            }, "slow");
        });

        $(".leftArrow").click(function () {
            $('.horizantalScrollMenu ul').animate({
                scrollLeft: "-=200px"
            }, "slow");
        });
        // console.log("active menu:", activeMenu);
        $(".dashboard").removeClass('active');

        if ($activeMenu == 'dashboard') {
            console.log("active menu:", $activeMenu);
            $(".dashboard").addClass('active');
            $(".podcast").removeClass('active');
            $(".assist").removeClass('active');
            $(".blogs").removeClass('active');
            $(".student").removeClass('active');
            $(".buildYourBusiness").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".courses").removeClass('active');
            $(".guidelines").removeClass('active');
            $(".refer").removeClass('active');
            $(".forums").removeClass('active');
            $(".workFlows").removeClass('active');
        } else if ($activeMenu == 'podcast') {
            $(".dashboard").removeClass('active');
            $(".podcast").addClass('active');
            $(".assist").removeClass('active');
            $(".blogs").removeClass('active');
            $(".student").removeClass('active');
            $(".buildYourBusiness").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".courses").removeClass('active');
            $(".guidelines").removeClass('active');
            $(".refer").removeClass('active');
            $(".forums").removeClass('active');
            $(".workFlows").removeClass('active');
        } else if ($activeMenu == 'assist') {
            $(".dashboard").removeClass('active');
            $(".podcast").removeClass('active');
            $(".assist").addClass('active');
            $(".blogs").removeClass('active');
            $(".student").removeClass('active');
            $(".buildYourBusiness").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".courses").removeClass('active');
            $(".guidelines").removeClass('active');
            $(".refer").removeClass('active');
            $(".forums").removeClass('active');
            $(".workFlows").removeClass('active');
        } else if ($activeMenu == 'blogs') {
            $(".dashboard").removeClass('active');
            $(".podcast").removeClass('active');
            $(".assist").removeClass('active');
            $(".blogs").addClass('active');
            $(".student").removeClass('active');
            $(".buildYourBusiness").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".courses").removeClass('active');
            $(".guidelines").removeClass('active');
            $(".refer").removeClass('active');
            $(".forums").removeClass('active');
            $(".workFlows").removeClass('active');
        } else if ($activeMenu == 'student') {
            $(".dashboard").removeClass('active');
            $(".podcast").removeClass('active');
            $(".assist").removeClass('active');
            $(".blogs").removeClass('active');
            $(".student").addClass('active');
            $(".buildYourBusiness").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".courses").removeClass('active');
            $(".guidelines").removeClass('active');
            $(".refer").removeClass('active');
            $(".forums").removeClass('active');
            $(".workFlows").removeClass('active');
        } else if ($activeMenu == 'buildYourBusiness') {
            $(".dashboard").removeClass('active');
            $(".podcast").removeClass('active');
            $(".assist").removeClass('active');
            $(".blogs").removeClass('active');
            $(".student").removeClass('active');
            $(".buildYourBusiness").addClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".courses").removeClass('active');
            $(".guidelines").removeClass('active');
            $(".refer").removeClass('active');
            $(".forums").removeClass('active');
            $(".workFlows").removeClass('active');
        } else if ($activeMenu == 'downloads') {
            $(".dashboard").removeClass('active');
            $(".podcast").removeClass('active');
            $(".assist").removeClass('active');
            $(".blogs").removeClass('active');
            $(".student").removeClass('active');
            $(".buildYourBusiness").removeClass('active');
            $(".downloads").addClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".courses").removeClass('active');
            $(".guidelines").removeClass('active');
            $(".refer").removeClass('active');
            $(".forums").removeClass('active');
            $(".workFlows").removeClass('active');
        } else if ($activeMenu == 'healthAndWellbeing') {
            $(".dashboard").removeClass('active');
            $(".podcast").removeClass('active');
            $(".assist").removeClass('active');
            $(".blogs").removeClass('active');
            $(".student").removeClass('active');
            $(".buildYourBusiness").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").addClass('active');
            $(".courses").removeClass('active');
            $(".guidelines").removeClass('active');
            $(".refer").removeClass('active');
            $(".forums").removeClass('active');
            $(".workFlows").removeClass('active');
        } else if ($activeMenu == 'courses') {
            $(".dashboard").removeClass('active');
            $(".podcast").removeClass('active');
            $(".assist").removeClass('active');
            $(".blogs").removeClass('active');
            $(".student").removeClass('active');
            $(".buildYourBusiness").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".courses").addClass('active');
            $(".guidelines").removeClass('active');
            $(".refer").removeClass('active');
            $(".forums").removeClass('active');
            $(".workFlows").removeClass('active');
        } else if ($activeMenu == 'guidelines') {
            $(".dashboard").removeClass('active');
            $(".podcast").removeClass('active');
            $(".assist").removeClass('active');
            $(".blogs").removeClass('active');
            $(".student").removeClass('active');
            $(".buildYourBusiness").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".courses").removeClass('active');
            $(".guidelines").addClass('active');
            $(".refer").removeClass('active');
            $(".forums").removeClass('active');
            $(".workFlows").removeClass('active');
        } else if ($activeMenu == 'refer') {
            $(".dashboard").removeClass('active');
            $(".podcast").removeClass('active');
            $(".assist").removeClass('active');
            $(".blogs").removeClass('active');
            $(".student").removeClass('active');
            $(".buildYourBusiness").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".courses").removeClass('active');
            $(".guidelines").removeClass('active');
            $(".refer").addClass('active');
            $(".forums").removeClass('active');
            $(".workFlows").removeClass('active');
        } else if ($activeMenu == 'forums') {
            $(".dashboard").removeClass('active');
            $(".podcast").removeClass('active');
            $(".assist").removeClass('active');
            $(".blogs").removeClass('active');
            $(".student").removeClass('active');
            $(".buildYourBusiness").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".courses").removeClass('active');
            $(".guidelines").removeClass('active');
            $(".refer").removeClass('active');
            $(".forums").addClass('active');
            $(".workFlows").removeClass('active');
        } else if ($activeMenu == 'workFlows') {
            $(".dashboard").removeClass('active');
            $(".podcast").removeClass('active');
            $(".assist").removeClass('active');
            $(".blogs").removeClass('active');
            $(".student").removeClass('active');
            $(".buildYourBusiness").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".courses").removeClass('active');
            $(".guidelines").removeClass('active');
            $(".refer").removeClass('active');
            $(".forums").removeClass('active');
            $(".workFlows").addClass('active');
        };
    }
    $('.menu-item a').click(function() {
        $(this).addClass('active').siblings().removeClass('active');
    });
</script>
@endsection

<div class="elementor-element elementor-element-51ed8f9 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="51ed8f9" data-element_type="widget" data-widget_type="button.default">
    <div style="padding:0" class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('forums') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><span class="elementor-button-text">Index</span> </span> </a> </div>
    </div>
</div>
<!-- <div class="elementor-element elementor-element-51ed8f9 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="51ed8f9" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('threads') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"> <span class="elementor-button-text">Threads</span> </span> </a> </div>
    </div>
</div> -->
<div class="elementor-element elementor-element-51ed8f9 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="51ed8f9" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('ask-question') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"> <span class="elementor-button-text">Ask Question</span> </span> </a> </div>
    </div>
</div>
<!-- Divider -->
<div class="elementor-element elementor-element-3f2e332 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="3f2e332" data-element_type="widget" data-widget_type="divider.default">
    <div class="elementor-widget-container">
        <div class="elementor-divider"> <span class="elementor-divider-separator"> </span> </div>
    </div>
</div>
