<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('vimeo-videos') }}" class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/cms/videos.png') }}">
                    </div>
                    <span class="nav-text active">Videos Upload</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cms.content.upload') }}" class="has-arrow" href="javascript:void(0);"
                    aria-expanded="false">
                    <div class="menu-icon">

                        <img class="w-35" src="{{ asset('images/cms/images.png') }}">

                    </div>
                    <span class="nav-text ">Images Upload</span>
                </a>
            </li>
            <li><a href="{{ route('cms.blog.upload') }}" class="has-arrow " href="javascript:void(0);"
                    aria-expanded="false">
                    <div class="menu-icon">

                        <img class="w-35" src="{{ asset('images/cms/content.png') }}">
                    </div>
                    <span class="nav-text ">Blog</span>
                </a>

            </li>

            <li>
                <a href="{{ route('cms.template.upload') }}" class="has-arrow" href="javascript:void(0);"
                    aria-expanded="false">
                    <div class="menu-icon">

                        <img class="w-35" src="{{ asset('images/cms/blogs.png') }}">
                    </div>
                    <span class="nav-text ">Templates</span>
                </a>
            </li>

            <li><a href="{{ route('cms.analytics.show') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/cms/analytics.png') }}">
                    </div>
                    <span class="nav-text">Analytics</span>
                </a>
            </li>

            {{-- <li><a href="{{ route('billing') }}" class="" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/cms/exam.png') }}">
                    </div>
                    <span class="nav-text">Comprehensive Exam</span>
                </a>
            </li> --}}

            {{-- <li><a href="{{ route('billing') }}" class="" aria-expanded="false">
                <div class="menu-icon">
                    <img class="w-35" src="{{ asset('images/dashboard/blogs.png') }}">
                </div>
                <span class="nav-text">Comprehensive Exam</span>
            </a>
        </li> --}}

            {{-- <li class="hover-black" style="cursor: pointer"> <a class="hover-black cancelSubscription" aria-expanded="false">
                    <div class="menu-icon">
                        <img class="w-35" src="{{ asset('images/dashboard/delete.png') }}">
                    </div>
                    <span class="nav-text red-color-text">Delete account</span>
                </a>
            </li> --}}

        </ul>
    </div>
</div>

<style>
    .cancel-form label.col-form-label {
        font-size: 18px;
        color: white
    }

    [data-theme-version="dark"] .modal-content.modal-bg-custom {
        background: #182237 !important;
    }

    .cancel-form .form-check {
        font-size: 18px;
        color: white;
    }

    .cancel-form .inputHeading {
        font-size: 15px;
        color: white;
    }

    .cancel-form .modal-footer {
        padding: 0px 0;
    }
</style>
<script>
    $('.cancelSubscription').on('click', function() {
        $('.cancelModal').modal('show');

    });
</script>
