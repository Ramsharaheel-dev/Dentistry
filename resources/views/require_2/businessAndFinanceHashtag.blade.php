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
        margin: 5px 0px;
        background-color: #232323;
    }

    .hashtags {
        font-size: 11px !important;
        text-transform: inherit !important;
        padding: 0px !important;
        font-family: helvetica !important;
    }

    .hashtags:hover {
        background-color: #666666 !important;
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
        padding-left: 30px;
        padding-right: 40px;
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

    .horizantalScrollHashtagMenu ul li p {
        font-size: 18px !important;
        text-transform: inherit !important;
        font-family: helvetica !important;
        border-radius: 10px !important;
        padding: 10px 30px 10px 30px !important;
        background-color: #102335 ;
        color: #909090 ;

    }

    .horizantalScrollHashtagMenu ul li {
        cursor: pointer;
    }

    .horizantalScrollHashtagMenu ul li p:hover {
        background-color: #666666;
    }

    ..elementor-button.elementor-size-xs {
        border-radius: 5px;
    }

    .horizantalScrollHashtagMenu ul li a img {
        margin-right: 5px;
    }
</style>

<div class="horizantalScrollHashtagMenu">

    <ul>
        <li>
            <p id="showBusiness">Business</p>
        </li>

        <li>
            <p id="showFinance">Finance</p>
        </li>

        @foreach ($hashtags as $hashtag)
            <li>
                <form action="{{ route('hashtag-filter') }}" style='display:none !important;' method="GET">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="contentType" class="form-control"
                            value="{{ $hashtag->nameOfContentSection }}">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="activeMenu" class="form-control" value="{{ $activeMenu }}">
                    </div>
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
