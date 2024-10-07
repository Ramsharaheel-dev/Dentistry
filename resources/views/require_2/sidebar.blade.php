{{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> --}}

<!-- Sidebar start -->
<style>
    /* .border-assign {
        border: 1px solid #F8B940;
    } */
</style>
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">



            <li class="d-none" style="background: black">
                <a href="{{ route('assist') }}" class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/blogs.png') }}">
                    </div>
                    <span class="nav-text assist-btn">Assist</span>
                </a>
            </li>

            <li class="d-none" style="background: black">
                <a href="{{ route('aboutUs') }}" class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/blogs.png') }}">
                    </div>
                    <span class="nav-text ">About Us</span>
                </a>
            </li>
            <li class="d-none" style="background: black">
                <a href="{{ route('faq') }}" class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/blogs.png') }}">
                    </div>
                    <span class="nav-text ">Faq's</span>
                </a>
            </li>
            <li class="d-none" style="background: black">
                <a href="{{ route('contact') }}" class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/blogs.png') }}">
                    </div>
                    <span class="nav-text ">Contact</span>
                </a>
            </li>
            <li class="d-none" style="background: black">
                <a href="{{ route('subscriptionPlans') }}" class="has-arrow" href="javascript:void(0);"
                    aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/blogs.png') }}">
                    </div>
                    <span class="nav-text ">Pricing</span>
                </a>
            </li>


            {{-- <li class="menu-title">YOUR COMPANY</li> --}}

            {{-- <li style="background: #191920;">
                <a href="{{ route('dashboard') }}" class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/user2.png') }}">
                    </div>
                    <span class="nav-text active"></span>
                </li> --}}
            @if (session('privilege') == 3)
                <li style="background: #191920;">
                    <a href="{{ route('manage.users') }}" class="has-arrow" href="javascript:void(0);"
                        aria-expanded="false">
                        <div class="menu-icon">

                            <img class="w-35" src="{{ asset('images/dashboard/user2.png') }}">

                        </div>
                        <span class="nav-text ">Manage Users</span>
                    </a>
                </li>
            @endif


            <li>
                <a href="{{ route('dashboard') }}" class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                    <div class="menu-icon">
                        @if (session()->has('assigned_video'))
                            <img class="w-35" src="{{ asset('images/dashboard/videored.png') }}">
                        @else
                            <img class="w-35" src="{{ asset('images/dashboard/Vector.png') }}">
                        @endif
                    </div>
                    <span class="nav-text ">Videos</span>
                </a>
            </li>

            <li><a href="{{ route('podcast') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        @if (session()->has('podcast_assign'))
                            <img class="w-35" src="{{ asset('images/dashboard/podcastred.png') }}">
                        @else
                            <img class="w-35" src="{{ asset('images/dashboard/podcasts.png') }}">
                        @endif
                    </div>
                    <span class="nav-text">Podcast and Webinars</span>
                </a>
            </li>

            <li><a href="{{ route('allBlogs') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/blogs.png') }}">
                    </div>
                    <span class="nav-text">Blogs</span>
                </a>
            </li>
            <li><a href="{{ route('student1') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/student.png') }}">
                    </div>
                    <span class="nav-text">Student</span>
                </a>
            </li>
            <li><a href="{{ route('pubMed') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/dubmed.png') }}">
                    </div>
                    <span class="nav-text">PubMed</span>
                </a>
            </li>
            <li><a href="{{ route('buildYourBusiness') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/business.png') }}">
                    </div>
                    <span class="nav-text">Business And Finance</span>
                </a>
            </li>
            <li><a href="{{ route('downloads1') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/download.png') }}">
                    </div>
                    <span class="nav-text">Downloads</span>
                </a>
            </li>
            <li><a href="{{ route('healthAndWellbeing') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/wellbeing.png') }}">
                    </div>
                    <span class="nav-text">Wellbeing</span>
                </a>
            </li>
            <li><a href="{{ route('courses1') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/courses.png') }}">
                    </div>
                    <span class="nav-text">Courses</span>
                </a>
            </li>
            <li><a href="{{ route('guidelines1') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/guideline.png') }}">
                    </div>
                    <span class="nav-text">Guidelines</span>
                </a>
            </li>
            <li><a href="{{ route('refer') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/refer.png') }}">
                    </div>
                    <span class="nav-text">Refer</span>
                </a>
            </li>
            <li><a href="{{ route('posts') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/forum.png') }}">
                    </div>
                    <span class="nav-text">Forum</span>
                </a>
            </li>
            <li><a href="{{ route('work-flow') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/work-flow.png') }}">
                    </div>
                    <span class="nav-text">Work Flows</span>
                </a>
            </li>

        </ul>
    </div>
</div>
