@extends ('layouts.layout')

@section('head')
    <title>Refer &#8211; Dian</title>
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

        .refer-heading {
            color: white;
            font-size: 20px;
        }

        .refer-social-icon {
            color: white;
            padding: 0px 5px;
            font-size: 15px;
        }

        .fa:hover {
            color: #d9aa5a;
        }

        @media (max-width: 767px) {
            .refer-socail-icons {
                margin-bottom: 15px;
            }
        }
    </style>

    <!-- REELS -->
    <div class="container">
        <div id="activeMenu" value="refer"></div>

        <div class="row" style="margin-top:50px">

            @foreach ($refers as $refer)
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 downloads-container"
                    style="margin-top:20px;text-align:center;">
                    <div style="position:relative;padding-bottom:10px"><img decoding="async" width="200px"
                            src="./images/user.png" class="attachment-medium_large size-medium_large wp-image-325"
                            alt="" loading="lazy" /></div>
                    <h1 class="refer-heading">{{ $refer->name }}</h1>
                    <div class="refer-socail-icons container text-center">
                        @if ($refer->url)
                            <?php echo '<a href="' . $refer->url . '" target="_blank" class="refer-social-icon"><i class="fa fa-globe"></i></a>'; ?>
                        @endif
                        @if ($refer->emailAddress)
                            <?php echo '<a href="mailto:' . $refer->emailAddress . '" target="_blank" class="refer-social-icon"><i class="fa fa-envelope"></i></a>'; ?>
                        @endif
                        @if ($refer->linkedinUrl)
                            <?php echo '<a href="' . $refer->linkedinUrl . '" target="_blank" class="refer-social-icon"><i class="fa fa-linkedin"></i></a>'; ?>
                        @endif
                        @if ($refer->instagramUrl)
                            <?php echo '<a href="' . $refer->instagramUrl . '" target="_blank" class="refer-social-icon"><i class="fa fa-instagram"></i></a>'; ?>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
