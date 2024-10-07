<style>
    .footer {
        background: #1b1b1b;
        padding: 10px 0;
    }

    .footer a {
        color: #70726F;
        font-size: 12px;
        padding: 10px;
        border-right: 1px solid #232323;
        transition: all .5s ease;
    }

    .footer a:first-child {
        border-left: 1px solid #232323;
    }

    .footer a:hover {
        color: white;
    }

    .privacy-policy {
        float: none;
        width: 100%;
        text-align: center;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .app{
        text-align:center;
        margin-top:15px;
    }

    .app img{
        width:20%;
        margin-left:10px;
    }

    @media (max-width: 767px) {

        .app{
            display:none;
        }
    }

</style>
<footer id="footer" class="site-footer" itemscope="itemscope" itemtype="https://schema.org/WPFooter" role="contentinfo">
    <div id="footer-inner" class="clr">
        <!-- <div id="footer-widgets" class="oceanwp-row clr">
            <div class="footer-widgets-inner container">
                <div class="footer-box span_1_of_4 col col-1"> </div>
                <div class="footer-box span_1_of_4 col col-2"> </div>
                <div class="footer-box span_1_of_4 col col-3"> </div>
                <div class="footer-box span_1_of_4 col col-4"> </div>
            </div>
        </div> -->
        <div id="footer-bottom" class="clr no-footer-nav">
            <div id="footer-bottom-inner" class="container clr">
                <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" />
                <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
                <div class="footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="copyright" class="clr" role="contentinfo" style="padding-top:10px"> <a href="{{ route('aboutUs') }}"> About Us </a> </div>
                                <div id="copyright" class="clr" role="contentinfo" style="padding-top:10px"> <a href="{{ route('contact') }}"> Contact Us</a> </div>
                                <div id="copyright" class="clr" role="contentinfo" style="padding-top:10px"> <a href="{{ route('privacyPolicy') }}"> Privacy Policy </a> </div>
                                <div id="copyright" class="clr" role="contentinfo" style="padding-top:10px"> <a href="{{ route('termsAndConditions') }}"> Terms & Condition </a> </div>
                                <div class="text-center" style="margin-top:20px;">
                                    <a href="https://www.instagram.com/dentistryinanutshell/"><i class="fa fa-instagram"></i> Instagram</a>
                                    <!-- <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-skype"></i></a> -->
                                </div>
                                {{-- <div class="app">
                                    <img src="../public/images/Apple Store.png">
                                    <img src="../public/images/Google play.png">
                                </div> --}}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- <div class="elementor-button-wrapper" class="clr privacy-policy" style="display:inline-block"> <a href="{{ route('privacyPolicy') }}"> Privacy Policy </a> </div> -->

            </div><!-- #footer-bottom-inner -->
        </div><!-- #footer-bottom -->
    </div><!-- #footer-inner -->
</footer><!-- #footer -->
