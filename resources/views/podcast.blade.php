@extends ('layouts.layout')

@section('head')
<title>Podcast &#8211; Dian</title>
@endsection

@section('content')

@include('requires.header')
@include('requires.content-section')
@include('requires.hashtag')

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

    @media (max-width: 767px) {
        /* .container {
            margin-bottom: 100px
        } */
    }
</style>

<!-- REELS -->
<div class="container dashboard-container text-center">
    <div id="activeMenu" value="podcast"></div>
    <div class="row align-items-start" style="margin-bottom:10px;">
        <div id="activeMenu" value="dashboard"></div>
        @if(session('finalReels'))
        @foreach($finalReels as $finalReel)

        <div class=" col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
            <div style="padding:56.25% 0 0 0;position:relative;"><iframe src={{ $finalReel->url }} frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Test"></iframe></div>
            <script src="https://player.vimeo.com/api/player.js"></script>
            <!-- <h1 class="dashboard-name">{{ $finalReel->name }}</h1> -->
        </div>
        @endforeach
        @else

        @foreach($podcasts as $podcast)
        <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
            <div style="padding:56.25% 0 0 0;position:relative;"><iframe src={{ $podcast->url }} frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Test"></iframe></div>
            <script src="https://player.vimeo.com/api/player.js"></script>
            <!-- <h1 class="dashboard-name">{{ $podcast->name }}</h1> -->
        </div>
        @endforeach
        @endif
    </div>
    <p class="new-content-disclaimer">New content released every month</p>
</div>

@endsection