<!DOCTYPE html>
<html class="html" lang="en-US">


<style>

</style>

<head>
    @include('require_2.head')

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
                                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-7e8b360"
                                        data-id="7e8b360" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-a4aea0d elementor-widget elementor-widget-image "
                                                data-id="a4aea0d" data-element_type="widget"
                                                data-widget_type="image.default">
                                                <div class="elementor-widget-container contextMenu">
                                                    <div class="mainMenu assistFeature elementor-button-wrapper"> <a
                                                            href="{{ route('assist') }}"> <span
                                                                class="elementor-button-content-wrapper"> <span
                                                                    class="elementor-button-text assist-btn "
                                                                    id="headerMenu">Assist</span> </span> </a>
                                                    </div>
                                                    <div class="mainMenu elementor-button-wrapper"> <a
                                                            href="{{ route('aboutUs') }}"> <span
                                                                class="elementor-button-content-wrapper"> <span
                                                                    class="elementor-button-text" id="headerMenu">About
                                                                    Us</span> </span> </a> </div>
                                                    <div class="mainMenu elementor-button-wrapper"> <a
                                                            href="{{ route('faq') }}"> <span
                                                                class="elementor-button-content-wrapper"> <span
                                                                    class="elementor-button-text"
                                                                    id="headerMenu">Faq’s</span> </span> </a> </div>
                                                    <div class="mainMenu elementor-button-wrapper"> <a
                                                            href="{{ route('contact') }}"> <span
                                                                class="elementor-button-content-wrapper"> <span
                                                                    class="elementor-button-text"
                                                                    id="headerMenu">Contact</span> </span> </a> </div>
                                                    <div class="mainMenu elementor-button-wrapper"> <a
                                                            href="{{ route('subscriptionPlans') }}"> <span
                                                                class="elementor-button-content-wrapper"> <span
                                                                    class="elementor-button-text"
                                                                    id="headerMenu">Pricing</span> </span> </a> </div>
                                                    <div class="mainMenu elementor-button-wrapper"> <a
                                                            href="https://diandental.myshopify.com/"> <span
                                                                class="elementor-button-content-wrapper"> <span
                                                                    class="elementor-button-text"
                                                                    id="headerMenu">Shop</span> </span> </a> </div>




                                                    {{-- <img class="profileImg" decoding=" async" onmouseover="showMenu()" width="64"
                                                        height="64" src="../storage/app/profile_pics/user.png"
                                                        class="attachment-medium_large size-medium_large wp-image-325 dropdown"
                                                        alt="" loading="lazy" />

                                                    <img class="profileImg" decoding=" async" onmouseover="showMenu()" width="64"
                                                        height="64" src="../storage/app/profile_pics/"
                                                        class="attachment-medium_large size-medium_large wp-image-325 dropdown"
                                                        alt="" loading="lazy" /> --}}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </section>
                        </div>
                        <div class="header-right d-flex align-items-center">
                            <div class="input-group search-area s-box">
                                <input type="search" id="searchInput" class="form-control s-input searchInput"
                                    placeholder="Search ">
                                <span class="input-group-text"><a href="javascript:void(0)">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1_450)">
                                                <path opacity="0.3"
                                                    d="M14.2929 16.7071C13.9024 16.3166 13.9024 15.6834 14.2929 15.2929C14.6834 14.9024 15.3166 14.9024 15.7071 15.2929L19.7071 19.2929C20.0976 19.6834 20.0976 20.3166 19.7071 20.7071C19.3166 21.0976 18.6834 21.0976 18.2929 20.7071L14.2929 16.7071Z"
                                                    fill="#452B90" />
                                                <path
                                                    d="M11 16C13.7614 16 16 13.7614 16 11C16 8.23859 13.7614 6.00002 11 6.00002C8.23858 6.00002 6 8.23859 6 11C6 13.7614 8.23858 16 11 16ZM11 18C7.13401 18 4 14.866 4 11C4 7.13402 7.13401 4.00002 11 4.00002C14.866 4.00002 18 7.13402 18 11C18 14.866 14.866 18 11 18Z"
                                                    fill="#452B90" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1_450">
                                                    <rect width="24" height="24" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a></span>
                                <div class="searchDropdown" id="searchDropdown"></div>

                            </div>
                            <ul class="navbar-nav">
                                <li class="dropdown">
                                    <button type="button" class="btn btn-noti header-item noti-icon waves-effect"
                                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <div class="noti-dot notification-bar"></div>
                                        {{-- <i class="fa fa-bell noti-icon"></i> --}}
                                        <img class="noti-icon" src="{{ asset('images/dashboard/bell.png') }}"
                                            alt="">
                                    </button>
                                    <div class="noti-dropdown dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 widget-media dz-scroll p-2"
                                        aria-labelledby="page-header-notifications-dropdown">
                                        <ul class="timeline">
                                            <li class="noti">
                                                <div class="timeline-panel notify-div" style="display: inline;">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="">
                                    <a class="nav-link" href="javascript:void(0);" role="button"
                                        data-bs-toggle="dropdown">
                                        <img src="{{ asset('images/dashboard/user.png') }}" alt="">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                        <div class="card border-0 mb-0">
                                            {{-- <div class="card-header py-2">
                                                <div class="products">

                                                    <img class="avatar avatar-md"
                                                        src="{{ asset('images/general/profile.png') }}"
                                                        alt="">
                                                    <div>

                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="card-body px-0 py-2">
                                                <a href="{{ route('dashboard') }}" class="dropdown-item ai-icon ">
                                                    <img class="w-20"
                                                        src="{{ asset('images/dashboard/dashboard.png') }}"
                                                        width="18" height="18" alt="">

                                                    <span class="ms-2">Dashboard </span>
                                                </a>

                                            </div>

                                            <div class="card-body px-0 py-2">
                                                <a href="{{ route('profile') }}" class="dropdown-item ai-icon ">
                                                    <img class="w-20"
                                                        src="{{ asset('images/dashboard/general.png') }}"
                                                        width="18" height="18" alt="">

                                                    <span class="ms-2">General </span>
                                                </a>

                                            </div>
                                            <div class="card-body px-0 py-2">
                                                <a href="{{ route('edit.profile') }}" class="dropdown-item ai-icon ">
                                                    <img class="w-20"
                                                        src="{{ asset('images/dashboard/edit-profile.png') }}"
                                                        width="18" height="18" alt="">

                                                    <span class="ms-2">Edit Profile </span>
                                                </a>

                                            </div>
                                            <div class="card-body px-0 py-2">
                                                <a href="{{ route('Certificate') }}" class="dropdown-item ai-icon ">
                                                    <img class="w-20"
                                                        src="{{ asset('images/dashboard/certificateicon.png') }}"
                                                        width="18" height="18" alt="">

                                                    <span class="ms-2">CPD Certificate </span>
                                                </a>

                                            </div>

                                            <div class="card-footer px-0 py-2">

                                                <a href="{{ route('logout') }}" class="dropdown-item ai-icon">
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

                                {{-- <li class="nav-item ps-3">
									<div class="dropdown header-profile2">
										<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											<div class="header-info2 d-flex align-items-center">
												<div class="header-media">
													<img src="images/user.jpg" alt="">
												</div>
											</div>
										</a>
										<div class="dropdown-menu dropdown-menu-end" style="">
											<div class="card border-0 mb-0">
												<div class="card-header py-2">
													<div class="products">
														<img src="images/user.jpg" class="avatar avatar-md" alt="">
														<div>
															<h6>Hanuman Prajapati</h6>
															<span>Web Designer</span>
														</div>
													</div>
												</div>
												<div class="card-body px-0 py-2">
													<a href="app-profile-1.html" class="dropdown-item ai-icon ">
														<svg  width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path fill-rule="evenodd" clip-rule="evenodd" d="M11.9848 15.3462C8.11714 15.3462 4.81429 15.931 4.81429 18.2729C4.81429 20.6148 8.09619 21.2205 11.9848 21.2205C15.8524 21.2205 19.1543 20.6348 19.1543 18.2938C19.1543 15.9529 15.8733 15.3462 11.9848 15.3462Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
														<path fill-rule="evenodd" clip-rule="evenodd" d="M11.9848 12.0059C14.5229 12.0059 16.58 9.94779 16.58 7.40969C16.58 4.8716 14.5229 2.81445 11.9848 2.81445C9.44667 2.81445 7.38857 4.8716 7.38857 7.40969C7.38 9.93922 9.42381 11.9973 11.9524 12.0059H11.9848Z" stroke="var(--primary)" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"/>
														</svg>

														<span class="ms-2">Profile </span>
													</a>
													<a href="app-profile-2.html" class="dropdown-item ai-icon ">
														<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>

														<span class="ms-2">My Project</span><span class="badge badge-sm badge-primary rounded-circle text-white ms-2">4</span>
													</a>
													<a href="javascript:void(0);" class="dropdown-item ai-icon ">
														<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M17.9026 8.85114L13.4593 12.4642C12.6198 13.1302 11.4387 13.1302 10.5992 12.4642L6.11844 8.85114" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
														<path fill-rule="evenodd" clip-rule="evenodd" d="M16.9089 21C19.9502 21.0084 22 18.5095 22 15.4384V8.57001C22 5.49883 19.9502 3 16.9089 3H7.09114C4.04979 3 2 5.49883 2 8.57001V15.4384C2 18.5095 4.04979 21.0084 7.09114 21H16.9089Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
														</svg>

														<span class="ms-2">Message </span>
													</a>
													<a href="email-inbox.html" class="dropdown-item ai-icon ">
														<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" clip-rule="evenodd" d="M12 17.8476C17.6392 17.8476 20.2481 17.1242 20.5 14.2205C20.5 11.3188 18.6812 11.5054 18.6812 7.94511C18.6812 5.16414 16.0452 2 12 2C7.95477 2 5.31885 5.16414 5.31885 7.94511C5.31885 11.5054 3.5 11.3188 3.5 14.2205C3.75295 17.1352 6.36177 17.8476 12 17.8476Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
															<path d="M14.3888 20.8572C13.0247 22.372 10.8967 22.3899 9.51947 20.8572" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
															</svg>

														<span class="ms-2">Notification </span>
													</a>
												</div>
												<div class="card-footer px-0 py-2">
													<a href="javascript:void(0);" class="dropdown-item ai-icon ">
														<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" clip-rule="evenodd" d="M20.8066 7.62355L20.1842 6.54346C19.6576 5.62954 18.4907 5.31426 17.5755 5.83866V5.83866C17.1399 6.09528 16.6201 6.16809 16.1307 6.04103C15.6413 5.91396 15.2226 5.59746 14.9668 5.16131C14.8023 4.88409 14.7139 4.56833 14.7105 4.24598V4.24598C14.7254 3.72916 14.5304 3.22834 14.17 2.85761C13.8096 2.48688 13.3145 2.2778 12.7975 2.27802H11.5435C11.0369 2.27801 10.5513 2.47985 10.194 2.83888C9.83666 3.19791 9.63714 3.68453 9.63958 4.19106V4.19106C9.62457 5.23686 8.77245 6.07675 7.72654 6.07664C7.40418 6.07329 7.08843 5.98488 6.8112 5.82035V5.82035C5.89603 5.29595 4.72908 5.61123 4.20251 6.52516L3.53432 7.62355C3.00838 8.53633 3.31937 9.70255 4.22997 10.2322V10.2322C4.82187 10.574 5.1865 11.2055 5.1865 11.889C5.1865 12.5725 4.82187 13.204 4.22997 13.5457V13.5457C3.32053 14.0719 3.0092 15.2353 3.53432 16.1453V16.1453L4.16589 17.2345C4.41262 17.6797 4.82657 18.0082 5.31616 18.1474C5.80575 18.2865 6.33061 18.2248 6.77459 17.976V17.976C7.21105 17.7213 7.73116 17.6515 8.21931 17.7821C8.70746 17.9128 9.12321 18.233 9.37413 18.6716C9.53867 18.9488 9.62708 19.2646 9.63043 19.5869V19.5869C9.63043 20.6435 10.4869 21.5 11.5435 21.5H12.7975C13.8505 21.5 14.7055 20.6491 14.7105 19.5961V19.5961C14.7081 19.088 14.9088 18.6 15.2681 18.2407C15.6274 17.8814 16.1154 17.6806 16.6236 17.6831C16.9451 17.6917 17.2596 17.7797 17.5389 17.9393V17.9393C18.4517 18.4653 19.6179 18.1543 20.1476 17.2437V17.2437L20.8066 16.1453C21.0617 15.7074 21.1317 15.1859 21.0012 14.6963C20.8706 14.2067 20.5502 13.7893 20.111 13.5366V13.5366C19.6717 13.2839 19.3514 12.8665 19.2208 12.3769C19.0902 11.8872 19.1602 11.3658 19.4153 10.9279C19.5812 10.6383 19.8213 10.3981 20.111 10.2322V10.2322C21.0161 9.70283 21.3264 8.54343 20.8066 7.63271V7.63271V7.62355Z" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
															<circle cx="12.175" cy="11.889" r="2.63616" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
															</svg>

														<span class="ms-2">Settings </span>
													</a>
													<a href="page-login.html" class="dropdown-item ai-icon">
														<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
														<span class="ms-2">Logout </span>
													</a>
												</div>
											</div>

										</div>
									</div>
								</li> --}}
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>



        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        @include('require_2.user_sidebar')

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
