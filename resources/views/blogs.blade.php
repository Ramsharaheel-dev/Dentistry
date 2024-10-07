@extends ('layouts.layout')

@section('head')
<title>Blogs &#8211; Dian</title>
@endsection

@section('content')

@include('requires.header')
@include('requires.content-section')
@include('requires.hashtag')

<style>
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto;
        margin-top: 5px;
        gap:15px;
    }

    .grid-item {
        font-size: 30px;
        text-align: center;
    }

    .blogTitle {
        font-weight: 300;
        color: #dadada;
        font-size: 18px;
        margin-bottom: 40px;
        margin-left: 10px;
        margin-right: 10px;
    }

    @media (max-width:767px){
        .grid-container {
        grid-template-columns: auto;
        }
    }
</style>
<div class="text-center">
    <div class="grid-container">
        <div id="activeMenu" value="blogs" style="display:none;"></div>
        @foreach($blogs as $blog)
        <form id="blogForm" action="{{ route('single-blog') }}" style='display:inline !important;' method="GET">

            @csrf
            <div class="form-group">
                <input type="hidden" name="blogId" class="form-control" value="{{ $blog->id }}">
            </div>
            <?php
            $data =json_decode($blog->data,true);
            ?>
            <div class="grid-item">
                <?php $imageSrc = "../public/blogs/thumbnails/". $blog->thumbnail; ?>
                <?php echo '<img style="cursor:pointer;margin-top:15px;" onclick="submitDetailsForm()" src="' . $imageSrc . '" alt="Image">' ; ?>
                <!-- <input type="image" src="./blogs/thumbnails/$blog->thumbnail" width="350px" class="img"> -->
                <!-- <h1 class="blogTitle">{{ $data[0]['title'] }}</h1> -->
            </div>

        </form>
        @endforeach
    </div>
    <p class="new-content-disclaimer">New content released every month</p>
</div>

<script>
     function submitDetailsForm() {
       $("#blogForm").submit();
    }
</script>

@endsection
