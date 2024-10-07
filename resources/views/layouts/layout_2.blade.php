<!DOCTYPE html>
<html class="html" lang="en-US">

@include('require_2.head')

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
        font-size: 15px;
    }

    .widget-media .timeline .timeline-panel .media-body .noti-font {
        font-size: 15px;
        padding-top: 9px;
    }

    .no-noti {
        color: white;
        font-weight: 400;
        text-align: center;
    }

    li.noti {
        height: auto;
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

                                                    {{-- <a href="{{ route('dashboard') }}"> <img decoding="async" width="300"
                                                        height="57" src="./images/dian-gold-logo.png"
                                                        class="attachment-medium size-medium wp-image-105" alt="" loading="lazy"
                                                        sizes="(max-width: 300px) 100vw, 300px" /></a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <style>
                                        .assist-btn {
                                            color: #F8B940 !important;
                                            font-weight: bold;
                                        }
                                    </style>
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
                                                                    class="elementor-button-text assist-btn"
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
                        <div class="search">
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
                                                    <a href="{{ route('profile') }}" class="dropdown-item ai-icon ">
                                                        <svg class="w-50" width="20" height="20" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M11.9848 15.3462C8.11714 15.3462 4.81429 15.931 4.81429 18.2729C4.81429 20.6148 8.09619 21.2205 11.9848 21.2205C15.8524 21.2205 19.1543 20.6348 19.1543 18.2938C19.1543 15.9529 15.8733 15.3462 11.9848 15.3462Z"
                                                                stroke="var(--primary)" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M11.9848 12.0059C14.5229 12.0059 16.58 9.94779 16.58 7.40969C16.58 4.8716 14.5229 2.81445 11.9848 2.81445C9.44667 2.81445 7.38857 4.8716 7.38857 7.40969C7.38 9.93922 9.42381 11.9973 11.9524 12.0059H11.9848Z"
                                                                stroke="var(--primary)" stroke-width="1.42857"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>

                                                        <span class="ms-2">Profile </span>
                                                    </a>

                                                </div>
                                                <div class="card-footer px-0 py-2">

                                                    <a href="{{ route('logout') }}" class="dropdown-item ai-icon">
                                                        <svg class="w-50" xmlns="http://www.w3.org/2000/svg" width="18"
                                                            height="18" viewBox="0 0 24 24" fill="none"
                                                            stroke="var(--primary)" stroke-width="2"
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

        @include('require_2.sidebar')

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
