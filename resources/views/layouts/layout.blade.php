<!DOCTYPE html>
<html class="html" lang="en-US">

<head>
    @include('requires.head')

    @yield('head')

</head>

<body class="page-template-default page page-id-5 wp-custom-logo wp-embed-responsive oceanwp-theme dropdown-mobile has-transparent-header no-header-border default-breakpoint content-full-screen page-header-disabled has-breadcrumbs elementor-default elementor-kit-6 elementor-page elementor-page-5" itemscope="itemscope" itemtype="https://schema.org/WebPage"> <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">

        @include('requires.defs')

        @include('requires.main')

        @include('requires.footer')

        @include('requires.scripts')

        @yield('customjs')
        <script type="text/javascript" src="{{ asset('/js/discrete/leftMenu.js') }}"></script>
</body>

</html>