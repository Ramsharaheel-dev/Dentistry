@extends ('layouts.layout')

@section('head')
<title>WorkFlows &#8211; Dian</title>
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
</style>

<div class="container">
    
    <div id="activeMenu" value="workFlows"></div>

    <div class="row" style="margin-top:10px">

    <div class=" col-md-4 col-sm-12 col-xs-12 downloads-container">
        <div style="position:relative;"></div>
            <img src="images/ebook.png" style="margin-bottom:15px" />
        
    </div>

</div>
<p class="new-content-disclaimer">New content released every month</p>
</div>

@endsection