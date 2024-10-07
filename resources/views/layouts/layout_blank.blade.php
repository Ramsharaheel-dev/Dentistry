<!DOCTYPE html>
<html class="html" lang="en-US">

@include('require_2.head')

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
                <a href="{{ route('welcome') }}" class="brand-logo">

                    <img class="w-150 brand-title" src="{{ asset('images/dashboard/logo.png') }}">


                </a>
            </div>
        </div>



        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        {{-- @include('require_2.sidebar') --}}

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
