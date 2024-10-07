@extends ('layouts.layout')

@section('head')
    <title>No SUbscription Access &#8211; Dian</title>
@endsection

@section('content')
    @include('requires.header')
    @include('requires.content-section')

    <style>
        .container h2 {
            font-size: 25px;
            color: white;
            margin-top: 25px;
        }

        .dashboard-container {
            max-width: 100% !important;
            /* margin-top: 25px; */
        }

        .Title_module_title__c7915904 {
            display: none;
        }

        .dashboard-name {
            font-size: 17px;
            color: white;
            margin-top: 10px;
            margin-bottom: 30px;
            text-align: center;
        }

        .row h3 {
            color: white;
        }

        @media (max-width: 767px) {
            .container {
                margin-bottom: 100px
            }
        }
    </style>

    <!-- REELS -->
    <div class="container dashboard-container text-center">
        <div id="activeMenu" value="{{ $activeMenu }}"></div>
        <div class="row align-items-start">
            <h3>{{ $message }}</h3>
        </div>

    </div>
@endsection
