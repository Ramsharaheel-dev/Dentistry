<!-- <input type="submit" name="submit" class="form-control" value="reels"> -->
<style>
    button,
    input[type="submit"],
    input[type="reset"] {
        background: none;
        color: inherit;
        border: none;
        padding: 5px;
        font: inherit;
        cursor: pointer;
        outline: inherit;
        margin-right: -1px;
        letter-spacing: normal;
    }

    .elementor-5 .elementor-element.elementor-element-d6a8e90 {
        width: auto;
        max-width: auto;
        padding-top: 5px;
        padding-bottom: 4px;
    }

    .elementor-5 .elementor-element.elementor-element-51ed8f9 {
        width: auto;
        max-width: auto;
        float: left;
    }

    .elementor-5 .elementor-element.elementor-element-a19c20e {
        padding-left: 8px;
    }

    .elementor-5 .elementor-element.elementor-element-3f2e332 .elementor-divider {

        padding-bottom: 0px;
    }

    .elementor-5 .elementor-element.elementor-element-51ed8f9 .elementor-button {
        /* margin: 5px 0px; */
        background-color: #232323;
    }

    .elementor-5 .elementor-element.elementor-element-51ed8f9 .elementor-button:hover {
        margin: 0px 0px;
        background-color: #666666;
    }

    .hashtags {
        font-size: 15px !important;
        text-transform: inherit !important;
        padding: 0px !important;
        font-family: helvetica !important;
        background-color: #232323 !important;
        /* padding: 10px 15px !important; */
        color: white !important;
        border-radius: 10px !important;
        padding: 10px 30px 10px 30px !important;
        background-color: #102335 !important;
        color: #909090 !important;
    }

    .hashtags:hover {
        background-color: #244360 !important;
        /* background: linear-gradient(89deg, rgb(217 170 89) 0%, rgba(217, 170, 89, 1) 0%, rgb(0 0 0 / 0%) 92%) !important; */
        color: #C19D5E !important;

    }

    .form-group {
        margin-bottom: 0 !important;
    }

    .horizantalScrollHashtagMenu ul {
        display: flex;
        margin: 9px;
        list-style: none;
        /* overflow-x: scroll; */
        white-space: nowrap;
        padding-left: 15px;
        padding-right: 0px;
        max-width: 100%;
        gap: 5px 14px;
        flex-wrap: wrap;

    }

    .horizantalScrollHashtagMenu ul::-webkit-scrollbar {
        display: none;
    }

    .horizantalScrollHashtagMenu ul li a {
        background-color: #232323;
        padding: 15px 25px !important;
        font-size: 15px !important;
    }

    ..elementor-button.elementor-size-xs {
        border-radius: 5px;
    }

    .horizantalScrollHashtagMenu ul li a img {
        margin-right: 5px;
    }

    .horizantalScrollHashtagMenu {
        position: relative;
        overflow-x: hidden;
    }

    .horizantalScrollHashtagMenu .leftHashtagArrow,
    .horizantalScrollHashtagMenu .rightHashtagArrow {
        position: absolute;
        height: 100%;
        top: 0;
        display: flex;
        align-items: center;
        cursor: pointer;
        z-index: 10;
    }

    .horizantalScrollHashtagMenu .leftHashtagArrow:hover,
    .horizantalScrollHashtagMenu .rightHashtagArrow:hover {
        background: #333;

    }

    .horizantalScrollHashtagMenu .leftHashtagArrow {
        background: linear-gradient(to right, black 50%, transparent);
    }

    .horizantalScrollHashtagMenu .rightHashtagArrow {
        background: linear-gradient(to left, black 50%, transparent);
        right: 0;
        padding: 5px;
    }

    @media (max-width: 767px) {
        .horizantalScrollHashtagMenu {
            overflow-x: hidden;
        }

        .horizantalScrollHashtagMenu .leftHashtagArrow,
        .horizantalScrollHashtagMenu .rightHashtagArrow {
            position: absolute;
            height: 70%;
            top: 4px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
    }
</style>

<div class="horizantalScrollHashtagMenu" id="horizantalScrollHashtagMenu">
    <ul>
        <li>
            <form action="{{ route('speechToTextNotes') }}" target=”_blank” style='display:inline !important;'
                method="GET">
                @csrf
                <div class="elementor-element elementor-element-51ed8f9 elementor-widget__width-auto elementor-widget elementor-widget-button"
                    data-id="51ed8f9" data-element_type="widget" data-widget_type="button.default">
                    <div class="elementor-widget-container" style="padding:0 0 0 5px">

                        <div class=" elementor-button-wrapper">
                            <div class="elementor-button-link elementor-button elementor-size-xs elementor-button-content-wrapper elementor-button-text"
                                role="button">
                                <input class="hashtags" style="display: inline;" id="" type="submit"
                                    value="Speech To Text" name="nameOfHashtag" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </li>

        <li>
            <form action="{{ route('emailTemplate') }}" target=”_blank” style='display:inline !important;'
                method="GET">
                @csrf
                <div class="elementor-element elementor-element-51ed8f9 elementor-widget__width-auto elementor-widget elementor-widget-button"
                    data-id="51ed8f9" data-element_type="widget" data-widget_type="button.default">
                    <div class="elementor-widget-container" style="padding:0 0 0 5px">

                        <div class=" elementor-button-wrapper">
                            <div class="elementor-button-link elementor-button elementor-size-xs elementor-button-content-wrapper elementor-button-text"
                                role="button">
                                <input class="hashtags" style="display: inline;" id="" type="submit"
                                    value="Patient Email Sendor" name="nameOfHashtag" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </li>

        <li>
            <form action="{{ route('allTemplates') }}" target=”_blank” style='display:inline !important;'
                method="GET">
                @csrf
                <div class="elementor-element elementor-element-51ed8f9 elementor-widget__width-auto elementor-widget elementor-widget-button"
                    data-id="51ed8f9" data-element_type="widget" data-widget_type="button.default">
                    <div class="elementor-widget-container" style="padding:0 0 0 5px">

                        <div class=" elementor-button-wrapper">
                            <div class="elementor-button-link elementor-button elementor-size-xs elementor-button-content-wrapper elementor-button-text"
                                role="button">
                                <input class="hashtags" style="display: inline;" id="" type="submit"
                                    value="Notes: Templates" name="nameOfHashtag" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </li>

        <li>
            <form action="{{ route('assistVideos') }}" style='display:inline !important;' method="GET">
                @csrf
                <div class="elementor-element elementor-element-51ed8f9 elementor-widget__width-auto elementor-widget elementor-widget-button"
                    data-id="51ed8f9" data-element_type="widget" data-widget_type="button.default">
                    <div class="elementor-widget-container" style="padding:0 0 0 5px">

                        <div class=" elementor-button-wrapper">
                            <div class="elementor-button-link elementor-button elementor-size-xs elementor-button-content-wrapper elementor-button-text"
                                role="button">
                                <input class="hashtags" style="display: inline;" id="" type="submit"
                                    value="Patient Explainer Videos" name="nameOfHashtag" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </li>
        @foreach ($hashtags as $hashtag)
            <li>
                <form action="{{ route('hashtag-filter') }}" style='display:inline !important;' method="GET">
                    @csrf


                    <div class="form-group">
                        <input type="hidden" name="contentType" class="form-control"
                            value="{{ $hashtag->nameOfContentSection }}">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="activeMenu" class="form-control" value="{{ $activeMenu }}">
                    </div>


                    @isset($selectedHashtagValue)
                        <div class="form-group">
                            <input type="hidden" id="selectedHashtag" class="form-control"
                                value="{{ $selectedHashtagValue }}">
                        </div>
                    @endisset

                    <div class="elementor-element elementor-element-51ed8f9 elementor-widget__width-auto elementor-widget elementor-widget-button"
                        data-id="51ed8f9" data-element_type="widget" data-widget_type="button.default">
                        <div class="elementor-widget-container" style="padding:0 0 0 5px">

                            <div class=" elementor-button-wrapper">
                                <div class="elementor-button-link elementor-button elementor-size-xs elementor-button-content-wrapper elementor-button-text"
                                    role="button">
                                    <input class="hashtags" style="display: inline;" id="" type="submit"
                                        value="{{ $hashtag->nameOfHashtag }}" name="nameOfHashtag" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </li>
        @endforeach
    </ul>
</div>




<!-- Divider -->
<div class="elementor-element elementor-element-3f2e332 elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
    data-id="3f2e332" data-element_type="widget" data-widget_type="divider.default">
    <div class="elementor-widget-container">
        <div class="elementor-divider"> <span class="elementor-divider-separator"> </span> </div>
    </div>
</div>

<script>
    if ($("#selectedHashtag")) {
        $selectedHasthtag = $("#selectedHashtag").val();

        $("input[type='submit']").each(function() {
            if ($(this).val() == $selectedHasthtag) {
                $(this).parent('.elementor-button').css({
                    "background-color": "#d9aa5a"
                });
            }
        });
    }

    $width = $('.horizantalScrollHashtagMenu ul').offsetWidth;

    $(".rightHashtagArrow").click(function() {
        $('.horizantalScrollHashtagMenu ul').animate({
            scrollLeft: "+=200px"
        }, "slow");
    });

    $(".leftHashtagArrow").click(function() {
        $('.horizantalScrollHashtagMenu ul').animate({
            scrollLeft: "-=200px"
        }, "slow");
    });
</script>
