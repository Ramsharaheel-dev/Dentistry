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

        .student-disclaimer {
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

            @if ($activeMenu == 'student')
                <p class="student-disclaimer">Disclaimer: All information provided in this section is provided is by fellow
                    students and has not been verified by DIAN club so information should be used at your discretion</p>
                @foreach ($finalReels as $finalReel)
                    @if ($finalReel->name == 'pastPapers')
                        <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                            <div>
                                <?php $imageSrc = '../public/student/past papers/' . $finalReel->thumbnailName; ?>
                                <?php echo '<a href="' . $finalReel->url . '"><img src="' . $imageSrc . '" alt="Image"></a>'; ?>
                            </div>
                        </div>
                    @elseif($finalReel->name == 'images')
                        <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                            <div class="studentHashtag">
                                <p><?php $imageSrc = '../public/student/images/' . $finalReel->thumbnailName; ?></p>
                                <p><?php echo '<a href="' . $imageSrc . '" download><img src="' . $imageSrc . '" alt="Image"></a>'; ?></p>
                            </div>
                        </div>
                    @elseif($finalReel->name == 'lectures')
                        <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                            <div>
                                <?php $imageSrc = '../public/student/lectures/' . $finalReel->thumbnailName; ?>
                                <?php echo '<a href="' . $finalReel->url . '" download><img src="' . $imageSrc . '" alt="Image"></a>'; ?>
                            </div>
                        </div>
                    @else
                        <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                            <div style="padding:56.25% 0 0 0;position:relative;"><iframe src={{ $finalReel->url }}
                                    frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                                    style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Test"></iframe>
                            </div>
                            <script src="https://player.vimeo.com/api/player.js"></script>
                            <!-- <h1 class="dashboard-name">{{ $finalReel->name }}</h1> -->
                        </div>
                    @endif
                @endforeach
            @endif

            @if ($activeMenu == 'guidelines')
                @foreach ($finalReels as $file)
                    <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                        <div>
                            @php
                            $imageSrc = asset('guidelines/' . $file->thumbnailName);
                        @endphp

                        <a target="_blank" href="{{ $file->url }}">
                            <img src="{{ $imageSrc }}" alt="Image">
                        </a>

                            {{-- <?php $imageSrc = '../public/guidelines/' . $file->thumbnailName; ?>
                            <?php echo '<a target="_blank" href="' . $file->url . '"><img src="' . $imageSrc . '" alt="Image"></a>'; ?> --}}
                        </div>
                    </div>
                @endforeach
            @endif

            @if ($activeMenu == 'blogs')
                @foreach ($finalReels as $blog)
                    <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                        <form id="blogForm" action="{{ route('single-blog') }}" style='display:inline !important;'
                            method="POST">

                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="blogId" class="form-control" value="{{ $blog->id }}">
                            </div>
                            <?php
                            $data = json_decode($blog->data, true);
                            ?>
                            <div class="grid-item">
                                @php
                                    $imageSrc = asset('blogs/thumbnails/' . $blog->thumbnail);
                                    $blogImgId = 'blogImgId';
                                @endphp

                                <img style="cursor:pointer; margin-top:15px;" id="{{ $blogImgId }}"
                                    src="{{ $imageSrc }}" alt="Image">
                                <!-- <h1 class="blogTitle">{{ $data[0]['title'] }}</h1> -->

                            </div>

                        </form>
                    </div>
                @endforeach
            @else
                @if ($activeMenu != 'student' && $activeMenu != 'workFlows' && $activeMenu != 'guidelines')
                    @foreach ($finalReels as $finalReel)
                        <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                            <div style="padding:56.25% 0 0 0;position:relative;"><iframe src={{ $finalReel->url }}
                                    frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                                    style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Test"></iframe>
                            </div>
                            <script src="https://player.vimeo.com/api/player.js"></script>
                            <!-- <h1 class="dashboard-name">{{ $finalReel->name }}</h1> -->
                        </div>
                    @endforeach
                @endif
            @endif

            {{-- @if ($activeMenu == 'workFlows')
                @foreach ($finalReels as $finalReel)
                    <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom:20px;">
                        <div class="studentHashtag">
                            <p><?php $imageSrc = '../public/workFlows/' . $selectedHashtagValue . '/' . $finalReel->thumbnailName; ?></p>
                            <p><?php echo '<a href="' . $imageSrc . '" download><img src="' . $imageSrc . '" alt="Image"></a>'; ?></p>
                        </div>
                    </div>
                @endforeach
            @endif --}}


        </div>
        <p class="new-content-disclaimer">New content released every month</p>
    </div>

    <script>
        // Adding numeric to ID
        var blogForm = document.querySelectorAll("#blogForm");
        var img = document.querySelectorAll("#blogImgId");
        for (var i = 0; i < blogForm.length; i++) {
            blogForm[i].setAttribute("id", "blogForm" + i);
            img[i].setAttribute("blogImgId", "blogForm" + i);
        }

        $('#blogImgId[blogImgId]').click(function() {
            $blogFormId = $(this).attr('blogImgId');
            $("#" + $blogFormId).submit();
        });
    </script>
@endsection
