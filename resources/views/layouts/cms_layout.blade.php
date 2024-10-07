<!DOCTYPE html>
<html class="html" lang="en-US">


<style>

</style>

<head>
    @include('require_2.head')
    <link rel="stylesheet" href="{{ asset('css/css/cms.css') }}">

    @yield('head')

</head>
<style>
    .p-2 {
        padding: 2px 6px 6px 5px !important;
    }

    .navbar-expand .navbar-nav .nav-link {
        padding-right: var(--bs-navbar-nav-link-padding-x);
        padding-left: var(--bs-navbar-nav-link-padding-x);
        padding-top: 11px;
    }

    .btn-noti:hover {
        background: none;
        border-color: none !important;
    }

    .btn-check:checked+.btn,
    :not(.btn-check)+.btn:active,
    .btn:first-child:active,
    .btn.active,
    .btn.show {
        border-color: transparent;
    }

    .widget-media .timeline .timeline-panel .media-body span.noti-color {
        border: none;
        border-radius: 0;
        padding: 0;
        color: #F8B940;
        font-size: 12px;

    }

    .widget-media .timeline .timeline-panel .media-body .noti-font {
        font-size: 12px;
    }

    .no-noti {
        color: white;
        font-weight: 400;
        text-align: center;
    }

    li.noti {
        height: auto;
    }

    @media (min-width: 300px) and (max-width: 480px) {
        .speech_to_ {
            font-size: 20px;
        }

        .form-control2 {

            width: auto;
        }

        .your_perso {
            font-size: 20px;
        }

        .introducin {
            font-size: 35px;
            font-weight: 400;
            color: rgba(217, 170, 89, 1);
        }

        .badge {
            line-height: 1.5;
            border-radius: 10px;
            font-size: 12px;
            padding-left: 17px;
            font-weight: 400;
            padding: 10px 11px;
            border: 0.0625rem solid transparent;
            font-weight: 400;
            /* color: rgba(144, 144, 144, 1); */
            width: auto;
        }

        .w-15 {
            width: 15%;
        }

        .please_acc {
            font-size: 19px;
        }

        .w-4 {
            width: 10%;
        }


        .btn4 {
            width: 100%;
        }

        .w-20 {
            max-width: 20%;
        }

        .step_into_ {
            font-size: 19px;
            font-weight: bold;
        }

        /* .horizantalScrollHashtagMenu ul {
        display: flex;
        margin: 9px;
        list-style: none;
        overflow-x: scroll;
        white-space: nowrap;
        padding-left: 15px;
        padding-right: 0px;
        max-width: 100%;
        gap: 7px 7px;
        flex-wrap: wrap;
    } */

        .speech_to_ {
            font-size: 16px !important;
            font-weight: 400;
            color: rgba(255, 255, 255, 1);
        }

        .w-35 {
            width: 15px !important;
            height: 15px;
        }

        .d-none {
            display: block !important;
        }

        .w-30 {
            width: 30%;
        }

        .step_into1_ {
            font-size: 18px;
        }

        .introducin1 {
            font-size: 25px;
            padding-top: 10px;
        }

        .showTemplates {
            width: 55% !important;
            background: white;
            color: black;
        }

        .videos2 {
            font-size: 19px;
            font-family: 'Anek Telugu', sans-serif;
            font-weight: 300;
            color: rgba(255, 255, 255, 1);
            padding: 25px;
            height: 10rem;
            overflow-x: scroll;
        }

        .horizantalScrollHashtagMenu ul {
            display: flex;
            margin: 9px;
            list-style: none;
            /* overflow-x: scroll; */
            white-space: nowrap;
            padding-left: 15px;
            padding-right: 0px;
            max-width: 100%;
            gap: 5px 5px !important;
            flex-wrap: wrap;
            /* overflow-x: scroll; */
            height: 10rem;
            overflow-y: scroll;
            /* width: 35rem; */
        }

        .noti-icon .noti-dot {

            right: 27%;
            top: 10px;
            /* display: block !important; */
        }

        .noti-dropdown {
            min-width: 14rem !important;
            max-height: 20rem;
            overflow-x: scroll;
        }

        .widget-media .timeline .timeline-panel .media-body .noti-font {
            font-size: 11px !important;
            padding-top: 8px !important;
        }

        .w-50 {
            max-width: 50%;
        }

        .widget-media .timeline .timeline-panel .media-body span.noti-color {
            font-size: 12px !important;
        }

        .btn9 {

            font-size: 12px;

        }

        ul.navbar-nav {
            position: absolute;
            left: 13rem;
        }

        .header-left {
            height: 100%;
            display: none;
            align-items: center;
        }

    }
</style>

<body>

    <!--*******************
        Preloader start
    ********************-->
    {{-- <div id="preloader">
		<div>
            <img class="" src="{{ asset('images/dashboard/videoicon.png') }}">
		</div>
    </div> --}}
    {{-- <div id="preloader">
        <div>
            <img class="" src="{{ asset('images/dashboard/videoicon.png') }}">
                </div>
    </div> --}}
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{ route('dashboard') }}" class="brand-logo">

                <img class="w-150 brand-title" src="{{ asset('images/dashboard/logo.png') }}">


            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line">
                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.7468 5.58925C11.0722 5.26381 11.0722 4.73617 10.7468 4.41073C10.4213 4.0853 9.89369 4.0853 9.56826 4.41073L4.56826 9.41073C4.25277 9.72622 4.24174 10.2342 4.54322 10.5631L9.12655 15.5631C9.43754 15.9024 9.96468 15.9253 10.3039 15.6143C10.6432 15.3033 10.6661 14.7762 10.3551 14.4369L6.31096 10.0251L10.7468 5.58925Z"
                                fill="#452B90" />
                            <path opacity="0.3"
                                d="M16.5801 5.58924C16.9056 5.26381 16.9056 4.73617 16.5801 4.41073C16.2547 4.0853 15.727 4.0853 15.4016 4.41073L10.4016 9.41073C10.0861 9.72622 10.0751 10.2342 10.3766 10.5631L14.9599 15.5631C15.2709 15.9024 15.798 15.9253 16.1373 15.6143C16.4766 15.3033 16.4995 14.7762 16.1885 14.4369L12.1443 10.0251L16.5801 5.58924Z"
                                fill="#452B90" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Chat box start
        ***********************************-->

        <!--**********************************
            Chat box End
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            {{-- <div class="dashboard_bar">
                                Dashboard
                            </div> --}}
                            <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-0b7b2fc elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="0b7b2fc" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-default">
                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-2942caf"
                                        data-id="2942caf" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-2ab8f29 elementor-widget elementor-widget-image"
                                                data-id="2ab8f29" data-element_type="widget"
                                                data-widget_type="image.default">
                                                <div class="elementor-widget-container">
                                                    <style>
                                                        /*! elementor - v3.10.2 - 29-01-2023 */
                                                        .elementor-widget-image {
                                                            text-align: center
                                                        }



                                                        .elementor-widget-image a img[src$=".svg"] {
                                                            width: 48px
                                                        }

                                                        .elementor-widget-image img {
                                                            vertical-align: middle;
                                                            display: inline-block
                                                        }

                                                        .elementor-5 .elementor-element.elementor-element-2ab8f29 img {
                                                            width: 80% !important;
                                                        }

                                                        .profileImg {
                                                            border-radius: 50% !important;
                                                            height: 65px !important;
                                                            object-fit: cover !important;
                                                            margin-left: 10px !important;
                                                        }

                                                        #headerMenu {
                                                            color: #fff;
                                                            font-size: 20px;
                                                            text-decoration: none !important;
                                                        }

                                                        #headerMenu:hover {
                                                            color: white;
                                                            text-decoration: none !important;
                                                        }

                                                        .assistFeature {
                                                            color: #d9aa5a !important;
                                                            font-weight: normal;
                                                            /* text-transform: uppercase; */
                                                        }

                                                        @media (max-width: 767px) {
                                                            .elementor-section.elementor-section-boxed>.elementor-container {
                                                                flex-wrap: nowrap;
                                                            }

                                                            .elementor-5 .elementor-element.elementor-element-2ab8f29 img {
                                                                width: 100% !important;
                                                            }

                                                            .elementor-5 .elementor-element.elementor-element-51ed8f9 .elementor-button {
                                                                margin-bottom: 5px;
                                                            }
                                                        }

                                                        .assist-btn {
                                                            color: #F8B940 !important;
                                                            font-weight: bold;
                                                        }
                                                    </style>

                                                    {{-- <a href="{{ route('dashboard') }}"> <img decoding="async" width="300"
                                                        height="57" src="./images/dian-gold-logo.png"
                                                        class="attachment-medium size-medium wp-image-105" alt="" loading="lazy"
                                                        sizes="(max-width: 300px) 100vw, 300px" /></a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </section>
                        </div>
                        <div class="header-right d-flex align-items-center">

                            <ul class="navbar-nav">

                                <li class="">
                                    <a class="nav-link" href="javascript:void(0);" role="button"
                                        data-bs-toggle="dropdown">
                                        <img src="{{ asset('images/dashboard/user.png') }}" alt="">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                        <div class="card border-0 mb-0">
                                            <div class="card-footer px-0 py-2">

                                                <a href="{{ route('cms.logout') }}" class="dropdown-item ai-icon">
                                                    <svg class="w-20" xmlns="http://www.w3.org/2000/svg"
                                                        width="18" height="18" viewBox="0 0 24 24"
                                                        fill="none" stroke="white" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                        <polyline points="16 17 21 12 16 7"></polyline>
                                                        <line x1="21" y1="12" x2="9"
                                                            y2="12"></line>
                                                    </svg>
                                                    <span class="ms-2">Logout </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>



        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        @include('require_2.cms_sidebar')

        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')

        <!--**********************************
            Content body end
        ***********************************-->
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer" style="display: none">
            <div class="copyright">
                <p>Copyright © Developed by <a href="" target="_blank">xyz</a> 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    @include('require_2.footer')

    @include('require_2.scripts')

    @yield('customjs')
</body>

</html>
