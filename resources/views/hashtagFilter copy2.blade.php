@extends ('layouts.layout')

@section('head')
<title>Filter &#8211; Dian</title>
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
    .student-disclaimer{
        color: #a0a0a0;
    }
    .blogTitle {
        font-weight: 300;
        color: #dadada;
        font-size: 18px;
        margin-bottom: 40px;
        margin-left: 10px;
        margin-right: 10px;
    }

    @media (max-width: 767px) {
        .container {
            margin-bottom: 100px
        }
    }
</style>

<div class="container dashboard-container text-center">
    <div id="activeMenu" value="{{ $activeMenu }}"></div>
    
    <div class="row align-items-start">
    
            @if($activeMenu == 'student')
      
            <?php for($i=0;$i<count($finalReels);$i++){ 
                $finalReel = $finalReels[$i];
                ?>
                <?php if($finalReels[$i]->name == 'pastPapers'){?>
                    <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                        <?php $imageSrc = "../public/student/past papers/". $finalReel->thumbnailName .'.png'; ?>
                        <?php echo '<a href="'.$finalReel->url.'" target="_blank"><img src="' . $imageSrc . '" alt="Image"></a>' ; ?>
                    </div>
                <?php } ?>
            <?php } ?>
               
            @endif 
            @if($activeMenu == 'blogs')
                @foreach($finalReels as $blog)
                    <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
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
                                <!-- <h1 class="blogTitle">{{ $data[0]['title'] }}</h1> -->
                            </div>

                        </form>
                    </div>
                @endforeach
            @else 
                @if($activeMenu != 'student')
                    @foreach($finalReels as $finalReel)

                        <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                            <div style="padding:56.25% 0 0 0;position:relative;"><iframe src={{ $finalReel->url }} frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Test"></iframe></div>
                            <script src="https://player.vimeo.com/api/player.js"></script>
                            <!-- <h1 class="dashboard-name">{{ $finalReel->name }}</h1> -->
                        </div>

                    @endforeach
                @endif
            @endif
    </div>
</div>

<script>
     function submitDetailsForm() {
       $("#blogForm").submit();
    }
</script>
@endsection