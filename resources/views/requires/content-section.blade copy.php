<!-- <style>
    .menu {
        display: grid;
        grid-template-columns: auto auto auto auto auto auto auto auto auto auto auto;
        grid-gap: 15px;
        margin: 5px 0px;
    }

    .menu-item {
        background-color: #232323;
        border-radius: 5px 5px 5px 5px;
        padding: 10px 19px 10px 19px;
    }

    .menu-item a {
        color: white;
    }
</style>
<div class="menu">
    <div class="menu-item"><a href="{{ route('dashboard') }}">Videos</a></div>
    <div class="menu-item"><a href="{{ route('podcast') }}">Podcast</a></div>
    <div class="menu-item"><a href="{{ route('assist') }}">Assist</a></div>
    <div class="menu-item"><a href="{{ route('blogs') }}">Blogs</a></div>
    <div class="menu-item"><a href="{{ route('student') }}">Student</a></div>
    <div class="menu-item"><a href="{{ route('buildYourBusiness') }}">Business</a></div>
    <div class="menu-item"><a href="{{ route('downloads') }}">Downloads</a></div>
    <div class="menu-item"><a href="{{ route('healthAndWellbeing') }}">Wellbeing</a></div>
    <div class="menu-item"><a href="{{ route('courses') }}">Courses</a></div>
    <div class="menu-item"><a href="{{ route('guidelines') }}">Guidelines</a></div>
    <div class="menu-item"><a href="{{ route('refer') }}">Refer</a></div>
</div>

<div class="elementor-element elementor-element-3f2e332 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="3f2e332" data-element_type="widget" data-widget_type="divider.default">
    <div class="elementor-widget-container">
        <div class="elementor-divider"> <span class="elementor-divider-separator"> </span> </div>
    </div>
</div> -->
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
    .elementor-5 .elementor-element.elementor-element-51ed8f9 .elementor-button {
        background-color: #232323;
        border-radius: 5px 5px 5px 5px;
        padding: 10px 10px 10px 10px;
    }

    .elementor-5 .elementor-element.elementor-element-51ed8f8 .elementor-button {
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
        background-color: var(--e-global-color-9caa857);
    }
</style>

<div class="elementor-element elementor-element-a19c20e elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="a19c20e" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('dashboard') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/video.png" width="15" height="15" /> </span> <span class="elementor-button-text">videos</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-51ed8f9 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="51ed8f8" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('podcast') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/messaging.png" width="15" height="15" /></span> <span class="elementor-button-text">Podcast</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-51ed8f9 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="51ed8f9" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('assist') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/messaging.png" width="15" height="15" /></span> <span class="elementor-button-text">Assist</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-7f2479c elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="7f2479c" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('blogs') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/video-camera.png" width="15" height="15" /> </span> <span class="elementor-button-text">Blogs</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-d6a8e90 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="d6a8e90" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('student') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/downloading.png" width="15" height="15" /> </span> <span class="elementor-button-text">Student</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-2f6c2ca elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="2f6c2ca" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('buildYourBusiness') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/bar-chart.png" width="15" height="15" /> </span> <span class="elementor-button-text">Business</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-d6a8e90 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="d6a8e90" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('downloads') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/downloading.png" width="15" height="15" /> </span> <span class="elementor-button-text">Downloads</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-d056cee elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="d056cee" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('healthAndWellbeing') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images//wellbeing.png" width="15" height="15" /></span> <span class="elementor-button-text">Wellbeing</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-fd57985 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="fd57985" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('courses') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/learning.png" width="15" height="15" /> </span> <span class="elementor-button-text">Courses</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-fd57985 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="fd57985" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('guidelines') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/learning.png" width="15" height="15" /> </span> <span class="elementor-button-text">Guidelines</span> </span> </a> </div>
    </div>
</div>
<div class="elementor-element elementor-element-fd57985 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="fd57985" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('refer') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"> <img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/learning.png" width="15" height="15" /> </span> <span class="elementor-button-text">Refer</span> </span> </a> </div>
    </div>
</div>
<!-- <div class="elementor-element elementor-element-d6a8e90 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="d6a8e90" data-element_type="widget" data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper"> <a href="{{ route('forums') }}" class="elementor-button-link elementor-button elementor-size-xs" role="button"> <span class="elementor-button-content-wrapper"> <span class="elementor-button-icon elementor-align-icon-left"><img src="https://test.dentistryinanutshell.com/lara/dev/dian/public/images/downloading.png" width="15" height="15" /> </span> <span class="elementor-button-text">Forum</span> </span> </a> </div>
    </div>
</div> -->
<div class="elementor-element elementor-element-3f2e332 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="3f2e332" data-element_type="widget" data-widget_type="divider.default">
    <div class="elementor-widget-container">
        <div class="elementor-divider"> <span class="elementor-divider-separator"> </span> </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $activeMenu = $("#activeMenu").val();
        if ($activeMenu == 'biteSize') {
            $(".biteSize").addClass('active');
            $(".assist").removeClass('active');
            $(".talks").removeClass('active');
            $(".bites").removeClass('active');
            $(".courses").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".business").removeClass('active');
            $(".student").removeClass('active');
            $(".forum").removeClass('active');
        } else if ($activeMenu == 'assist') {
            $(".biteSize").removeClass('active');
            $(".assist").addClass('active');
            $(".talks").removeClass('active');
            $(".bites").removeClass('active');
            $(".courses").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".business").removeClass('active');
            $(".student").removeClass('active');
            $(".forum").removeClass('active');
        } else if ($activeMenu == 'talks') {
            $(".biteSize").removeClass('active');
            $(".assist").removeClass('active');
            $(".talks").addClass('active');
            $(".bites").removeClass('active');
            $(".courses").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".business").removeClass('active');
            $(".student").removeClass('active');
            $(".forum").removeClass('active');
        } else if ($activeMenu == 'bites') {
            $(".biteSize").removeClass('active');
            $(".assist").removeClass('active');
            $(".talks").removeClass('active');
            $(".bites").addClass('active');
            $(".courses").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".business").removeClass('active');
            $(".student").removeClass('active');
            $(".forum").removeClass('active');
        } else if ($activeMenu == 'courses') {
            $(".biteSize").removeClass('active');
            $(".assist").removeClass('active');
            $(".talks").removeClass('active');
            $(".bites").removeClass('active');
            $(".courses").addClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".business").removeClass('active');
            $(".student").removeClass('active');
            $(".forum").removeClass('active');
        } else if ($activeMenu == 'downloads') {
            $(".biteSize").removeClass('active');
            $(".assist").removeClass('active');
            $(".talks").removeClass('active');
            $(".bites").removeClass('active');
            $(".courses").removeClass('active');
            $(".downloads").addClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".business").removeClass('active');
            $(".student").removeClass('active');
            $(".forum").removeClass('active');
        } else if ($activeMenu == 'healthAndWellbeing') {
            $(".biteSize").removeClass('active');
            $(".assist").removeClass('active');
            $(".talks").removeClass('active');
            $(".bites").removeClass('active');
            $(".courses").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").addClass('active');
            $(".business").removeClass('active');
            $(".student").removeClass('active');
            $(".forum").removeClass('active');
        } else if ($activeMenu == 'buildYourBusiness') {
            $(".biteSize").removeClass('active');
            $(".assist").removeClass('active');
            $(".talks").removeClass('active');
            $(".bites").removeClass('active');
            $(".courses").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".business").addClass('active');
            $(".student").removeClass('active');
            $(".forum").removeClass('active');
        } else if ($activeMenu == 'student') {
            $(".biteSize").removeClass('active');
            $(".assist").removeClass('active');
            $(".talks").removeClass('active');
            $(".bites").removeClass('active');
            $(".courses").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".business").removeClass('active');
            $(".student").addClass('active');
            $(".forum").removeClass('active');
        } else if ($activeMenu == 'forum') {
            $(".biteSize").removeClass('active');
            $(".assist").removeClass('active');
            $(".talks").removeClass('active');
            $(".bites").removeClass('active');
            $(".courses").removeClass('active');
            $(".downloads").removeClass('active');
            $(".healthAndWellbeing").removeClass('active');
            $(".business").removeClass('active');
            $(".student").removeClass('active');
            $(".forum").addClass('active');
        }
    });
    $('.menu-item a').click(function() {
        $(this).addClass('active').siblings().removeClass('active');
    });
</script>