@extends ('layouts.user_layout')

@section('head')
    <title>CPD Certificate &#8211; Dian</title>
@endsection

@section('custom_style')
    <style>
        .cpd {
            background-color: #1F2B37;
            padding: 20px 30px;
            font-size: 20px;
            color: #FFFFFF;
        }

        .cpd2 {
            background-color: #191920;
            padding: 20px 30px;
            font-size: 20px;
            color: #ffffff;
        }
    </style>
@endsection

@section('content')
    <div class="content-body">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card-header border-0 pb-0 flex-wrap">
                        <div class="products mb-3 anek-telugu">
                            <div>
                                <h6>CPD Certificate</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col-md-12">
                            <div class="mb-3 cpd">
                                <span class="anek-telugu">Name : {{ $user->name }}</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3 cpd">
                                <span class="anek-telugu">Hours: {{ $formattedTotalTime }}</span>
                            </div>
                            <div class="mb-3">
                                <div class="mb-3 cpd2">
                                    <span class="anek-telugu">GDC/Registeration No : {{ $gdcNumber }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row py-4">
                <div class="col-md-12">
                    <button type="submit" class="btn14 anek-telugu mr-13" data-bs-toggle="modal"
                        data-bs-target=".bd-example-modal-lg">View Certificate</button>
                    <a href="{{ route('generate.pdf') }}">
                        <button type="button" class=" btn3  anek-telugu mr-13"><i class="fa fa-download"
                                aria-hidden="true"></i> Download Certificate</button> </a>
                </div>
            </div>
        </div>

        {{-- <div class="rectangle-parent">
            <div class="group-child"></div>

            <img class="group-item" src="{{ asset('images/certificate/logo2.png') }}" alt="">

            <div class="dr-raabiha-n">Dr Raabiha N Maan</div>
            <p class="director-of-dian">123456789</p>
            <div class="gdc-learning-outcomes-container">jgkfkn</div>
            <div class="this-certificate-is">12/04/22</div>

            </div>

            <div class="line-div"></div>
            <div class="group-child1"></div>
            <div class="group-child2"></div>
            <div class="group-child3"></div>
          </div> --}}

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg2">
                <div class="modal-content">
                    <div class="modal-body">
                        <div>
                            <div class="rectangle-parent">
                                <div class="group-child"></div>
                                <img class="group-item" src="{{ asset('images/certificate/logo2.png') }}" alt="">

                                <div class="dr-raabiha-n">{{ $user->name }}</div>
                                <p class="director-of-dian"> {{ $gdcNumber }}</p>
                                <div class="gdc-learning-outcomes-container">{{ $formattedTotalTime }}</div>
                                <div class="this-certificate-is">{{ \Carbon\Carbon::today()->format('d-m-Y') }}</div>
                            </div>
                        </div>

                        <div class="line-div"></div>
                        <div class="group-child1"></div>
                        <div class="group-child2"></div>
                        <div class="group-child3"></div>
                    </div>
                </div>
                {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
            </div>
        </div>
    </div>

    <style>
        .group-child,
        .group-item {
            position: absolute;
            border-radius: var(--br-11xl);
        }

        .modal-content {
            background: transparent !important;
        }

        .modal-lg2,
        .modal-xl2 {
            --bs-modal-width: 74% !important;
        }

        .group-child {
            top: 0;
            left: 0;
            /* background-color: #fff; */
            /* border: 1px solid var(--color-peru); */
            box-sizing: border-box;
            width: auto;
            height: auto;
        }

        .group-item {
            top: 30px;
            left: 30px;
            width: 100%;
            height: 100%;
        }

        .cpd-certificate {
            position: absolute;
            top: 120px;
            left: 356.28px;
            font-size: 65px;
            line-height: 60px;
            text-transform: capitalize;
            font-weight: 300;
        }

        .dr-nicola-z, .dr-raabiha-n {
            text-align: center;
            position: absolute;
            top: 21%;
            left: 45%;
            font-size: 25px;
            line-height: 40px;
            text-transform: capitalize;
            font-weight: bold;
            color: black;
        }

        .this-certificate-is {
            position: absolute;
            top: 43%;
            left: 79%;
            /* line-height: 20px; */
            color: #2b2b2b;
            font-size: 22px;
            font-weight: bold;
        }

        .director-of-dian, .director-of-dian1 {
            position: absolute;
            top: 33%;
            left: 48%;
            line-height: 20px;
            color: black;
            font-weight: bold;
            font-size: 22px;
        }
        /* .director-of-dian1 {
                                  left: 779.56px;
                                } */
        .gdc-learning-outcomes {
            margin: 0;
        }

        .gdc-learning-outcomes-container {
            position: absolute;
            top: 43%;
            left: 23%;
            font-size: 23px;
            line-height: 40px;
            text-align: center;
            font-weight: bold;
            color: black;
        }
        .image-16-icon {
            position: absolute;
            top: 1167.04px;
            left: 167.6px;
            width: 173.79px;
            height: 121.66px;
            object-fit: cover;
        }

        .group-inner,
        .image-17-icon,
        .image-18-icon {
            position: absolute;
            top: 1173.92px;
            left: 746.69px;
            width: 259.75px;
            height: 114.78px;
            object-fit: cover;
        }

        .group-inner,
        .image-18-icon {
            top: 1151.94px;
            left: 440px;
            width: 236.56px;
            height: 273.52px;
        }

        .group-inner {
            top: 753.59px;
            left: 264.55px;
            width: 587.46px;
            height: 115.53px;
        }

        .line-div {
            top: 660.59px;
            left: 645.94px;
            width: 443.62px;
        }

        .group-child1,
        .group-child2,
        .group-child3,
        .line-div {
            position: absolute;
            border-top: 6px solid var(--color-peru);
            box-sizing: border-box;
            height: 6px;
        }

        .group-child1 {
            top: 660.59px;
            left: 27px;
            width: 443.62px;
        }

        .group-child2,
        .group-child3 {
            top: 510.59px;
            left: calc(50% - 320.04px);
            width: 640.09px;
        }

        .group-child3 {
            top: 342.4px;
        }

        .rectangle-parent {
            width: 100%;
            position: relative;
            height: 1525.46px;
            text-align: left;
            font-size: var(--font-size-3xl);
            color: var(--color-black);
            font-family: var(--font-anek-telugu);
        }
    </style>

    <script>
        $(document).ready(function() {
            $("#viewCertificateBtn").click(function() {
                window.open('certificate.html', '_blank');
            });
        });
    </script>
@endsection


