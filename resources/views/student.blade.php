@extends ('layouts.layout')

@section('head')
<title>Student &#8211; Dian</title>
@endsection

@section('content')

@include('requires.header')
@include('requires.content-section')
@include('requires.hashtag')

<style>
    .downloads-container h1 {
        font-size: 17px;
        color: white;
        margin-top: 0px;
        margin-bottom: 30px;
    }

    .downloads-container a:hover {
        text-decoration: none;
    }

    .student-disclaimer{
        color: #a0a0a0;
    }
</style>
<!-- REELS -->
<div class="text-center" style="margin-top:25px; max-width:100%">

    <p class="student-disclaimer">Disclaimer: All information provided in this section is provided is by fellow students and has not been verified by DIAN club so information should be used at your discretion</p>
    <div id="activeMenu" value="student"></div>
    @foreach($files as $file)
    <?php $path = './student/' . $file ?>

    <div class=" col-md-4 col-sm-12 col-xs-12 downloads-container" style="margin-top:20px;">
        <div style="position:relative;"></div>
        <a href="{{ $path }}" download>
            <img src="student/{{$file}}" style="margin-bottom:15px" />
            <!-- <h1 class="downloadFileName" style="text-align: center;">{{ $file }}</h1> -->
        </a>
    </div>

    @endforeach
</div>

@endsection