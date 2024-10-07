@extends ('layouts.layout')

@section('head')
<title>Courses &#8211; Dian</title>
@endsection

@section('content')

@include('requires.header')
@include('requires.content-section')

<!-- REELS -->
<div class="container text-center">
    <div id="activeMenu" value="courses"></div>

    <div class="row">
        <div class="col-lg-4">
            <a href="http://www.globalhealthed.co.uk/" target="_blank"><img src="{{asset('courses/Courses.jpg')}}"/></a>
        </div>
    </div>
   
    <p class="new-content-disclaimer">New content released every month</p>
</div>

@endsection