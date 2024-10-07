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
        font-size: 11px !important;
        text-transform: inherit !important;
        padding: 0px !important;
        font-family: helvetica !important;
        background-color: #232323 !important;
        /* padding: 10px 15px !important; */
        color: white !important;
        border-radius: 5px 5px 5px 5px !important;
        padding: 10px 10px 10px 10px !important;
    }

    .hashtags:hover {
        background-color: #666666 !important;
    }

    .form-group {
        margin-bottom: 0 !important;
    }

    .horizantalScrollHashtagMenu ul {
        display: flex;
        margin: 0px;
        gap: 8px;
        list-style: none;
        overflow-x: scroll;
        white-space: nowrap;
        padding-left: 30px;
        padding-right: 40px;
        max-width: 1100px;
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
    <img src="./images/left-chevron.png" class="leftHashtagArrow">
    <img src="./images/right-chevron.png" class="rightHashtagArrow">
    <ul id="horizantalScrollHashtagUl">
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
                    <input
                        class="hashtags elementor-button-link elementor-button elementor-size-xs elementor-button-content-wrapper elementor-button-text"
                        style="display: inline;" id="" type="submit" value="{{ $hashtag->nameOfHashtag }}"
                        name="nameOfHashtag" />


                    <!-- <div class="elementor-element elementor-element-51ed8f9 elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="51ed8f9" data-element_type="widget" data-widget_type="button.default">
                <div class="elementor-widget-container" style="padding:0 0 0 5px">

                    <div class=" elementor-button-wrapper">
                        <div class="elementor-button-link elementor-button elementor-size-xs elementor-button-content-wrapper elementor-button-text" role="button">
                            <input class="hashtags" style="display: inline;" id="" type="submit" value="{{ $hashtag->nameOfHashtag }}" name="nameOfHashtag" />
                        </div>
                    </div>
                </div>
            </div> -->
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
        // alert($selectedHasthtag);

        $("input[type='submit']").each(function() {
            if ($(this).val() == $selectedHasthtag) {
                $(this).parent('.elementor-button').css({
                    "background-color": "#d9aa5a"
                });
            }
        });
    }

    $width = document.getElementById('horizantalScrollHashtagUl').offsetWidth;

    $ulWidth = 0;
    $("#horizantalScrollHashtagUl li").each(function() {
        $ulWidth = $ulWidth + $(this).width();
        console.log($ulWidth);
    });

    console.log($ulWidth);
    console.log($("#horizantalScrollMenu").width() * 0.9);

    if ($width < ($("#horizantalScrollMenu").width() * 0.9)) {
        $(".rightHashtagArrow").hide();
        $(".leftHashtagArrow").hide();
    }

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
