        <div class="">
            <div class=""></div>
            <img class="group-item" style="width: 650px; height: 800px;"
                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/certificate/logo2.png'))) }}"
                alt="">

            <div class="dr-raabiha-n">{{ $user->name }}</div>
            <p class="director-of-dian">{{ $gdcNumber }}</p>
            <div class="gdc-learning-outcomes-container">{{ $formattedTotalTime }}</div>
            <div class="this-certificate-is">{{ \Carbon\Carbon::today()->format('d-m-Y') }}</div>
        </div>

        <div class="line-div"></div>
        <div class="group-child1"></div>
        <div class="group-child2"></div>
        <div class="group-child3"></div>
        <style>
            .group-child,
            .group-item {
                position: absolute;
                border-radius: var(--br-11xl);
            }

            .modal-content {
                background: transparent !important;
            }

            .modal-lg,
            .modal-xl {
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

            .dr-nicola-z,
            .dr-raabiha-n {
                text-align: center;
                position: absolute;
                top: 16%;
                left: 39%;
                font-size: 22px;
                line-height: 40px;
                text-transform: capitalize;
                font-weight: bold;
                color: black;
            }

            .this-certificate-is {
                position: absolute;
                top: 33%;
                left: 70%;
                /* line-height: 20px; */
                color: #2b2b2b;
                font-size: 22px;
                font-weight: bold;
            }

            .director-of-dian,
            .director-of-dian1 {
                position: absolute;
                top: 24%;
                left: 44%;
                line-height: 20px;
                color: black;
                font-weight: bold;
                font-size: 18px;
            }

            /* .director-of-dian1 {
                      left: 779.56px;
                    } */
            .gdc-learning-outcomes {
                margin: 0;
            }

            .gdc-learning-outcomes-container {
                position: absolute;
                top: 32%;
                left: 20%;
                font-size: 22px;
                line-height: 40px;
                text-align: center;
                font-weight: 700;
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
