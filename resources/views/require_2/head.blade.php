<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dentistry Management System">
    <meta property="og:title" content="Dentistry Management System">
    <meta property="og:description" content="Dentistry Management System">
    <meta property="og:image" content="">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    @yield('head')
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Telugu:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.0/css/all.css" />
    <link rel="stylesheet" href="{{ asset('vendor/lightgallery/css/lightgallery.min.css') }}">
    <link href="https://vjs.zencdn.net/7.16.0/video-js.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"></script>
    <script src="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css"></script>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{-- <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="vendor/swiper/css/swiper-bundle.min.css" rel="stylesheet">
	<link href="vendor/swiper/css/swiper-bundle.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">
	<link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="../../cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
	<link href="vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/tagify/dist/tagify.css') }}">

    {{-- <link href="vendor/tagify/dist/tagify.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/swiper/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/swiper/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css/style.css') }}">


    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">



    {{-- <link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">
<link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="../../cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"> --}}

    <!-- tagify-css -->
    {{-- <link href="vendor/tagify/dist/tagify.css" rel="stylesheet"> --}}

    <!-- Style css -->
    {{-- <link href="css/style.css" rel="stylesheet"> --}}

</head>
@yield('custom_style')
{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function(){
        $('.has-arrow').click(function(e){
            e.preventDefault(); // Prevent default behavior of the anchor tag
            $(this).toggleClass('active');
            $(this).find('ul').slideToggle(200);
        });
    });
</script> --}}
