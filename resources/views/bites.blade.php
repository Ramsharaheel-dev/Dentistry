@extends ('layouts.layout')

@section('head')
<title>Dashboard &#8211; Dian</title>
@endsection

@section('content')

@include('requires.header')
@include('requires.content-section')
@include('requires.hashtag')

<!-- REELS -->
<div class="container text-center">
    BITES
    <div id="activeMenu">bites</div>
</div>

@endsection