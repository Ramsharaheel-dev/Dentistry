@extends ('layouts.layout_2')

@section('head')
    <title>Home &#8211; Dian</title>
@endsection

<style>
    /* Style for modal */
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
        .container {
            margin-bottom: 100px
        }
    }
</style>

@section('content')
    <div class="content-body">

        @include('require_2.hashtag')

        <div class="container-fluid">

            <div class="row align-items-start" style="margin-top:10px;">
                <div id="activeMenu" value="healthAndWellbeing"></div>
                @if (session('finalReels'))
                    @foreach ($finalReels as $finalReel)
                        <div class=" col-md-4 col-sm-12 col-xs-12" style="margin-top:20px;">
                            <div style="padding:56.25% 0 0 0;position:relative;"><iframe src={{ $finalReel->url }}
                                    frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                                    style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Test"></iframe>
                            </div>
                            <script src="https://player.vimeo.com/api/player.js"></script>
                            <!-- <h1 class="dashboard-name">{{ $finalReel->name }}</h1> -->
                        </div>
                    @endforeach
                @else
                    @foreach ($healths as $health)
                        <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top:20px;">
                            <div style="padding:56.25% 0 0 0;position:relative;"><iframe src={{ $health->url }}
                                    frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                                    style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Test"></iframe>
                            </div>
                            <script src="https://player.vimeo.com/api/player.js"></script>
                            <!-- <h1 class="dashboard-name">{{ $health->name }}</h1> -->
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="row py-4">
                <div class="col-md-12">
                    <button type="button" class="btn1 btn-secondary anek-telugu">New content released every
                        month</button>
                </div>
            </div>

        </div>

    </div>

@endsection
