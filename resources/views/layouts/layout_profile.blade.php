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
                                                    </style>
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
                                    {{-- <li class="dropdown">
                                        <button type="button" class="btn btn-noti header-item noti-icon waves-effect"
                                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <div class="noti-dot notification-bar"></div>
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
                                    </li> --}}

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
                                                <div class="card-footer px-0 py-2">

                                                    <a href="{{ route('logout') }}" class="dropdown-item ai-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18"
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
                <p>Copyright © Developed by <a href="" target="_blank">xyz</a> 2024</p>
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
