<?php
	function convertRGBToHex($rgbString = null) {
        if (!$rgbString) { return; }

        $rgbArray = explode(",", $rgbString);
        $hex      = sprintf("#%02x%02x%02x", $rgbArray[0], $rgbArray[1], $rgbArray[2]);

        return $hex;
    }

    function createFontSize($fontSizeMin = null, $fontSizeMax = null, $screenWidthMin = null, $screenWidthMax = null) {
        if (!$fontSizeMin || !$fontSizeMax || !$screenWidthMin || !$screenWidthMax) { return; }

        $gradient   = ($fontSizeMax - $fontSizeMin) / ($screenWidthMax - $screenWidthMin);
        $yIntercept = ((-1) * $screenWidthMin * $gradient) + $fontSizeMin;

        return "clamp(" . $fontSizeMin . "rem, " . $yIntercept . "rem + " . ($gradient * 100) . "vw, " . $fontSizeMax . "rem)";
    }

    function createColorStyles($colorName = null, $colorValue = null) {
        if (!$colorName || !$colorValue) { return; }

        $colorStyles = "";

        for ($a = 1; $a <= 10; $a++) {
            $colorClass = ".color-" . $colorName;
            
            if ($a == 10) {
                $colorStyles .= $colorClass . " { color: rgb(" . $colorValue . "); }";

            } else {
                $colorStyles .= $colorClass . "-" . ($a * 10) . " { color: rgba(" . $colorValue . ", " . ($a / 10) . "); }";

            }
        }

        return $colorStyles;
    }

    function createBackgroundColorStyles($colorName = null, $colorValue = null) {
        if (!$colorName || !$colorValue) { return; }

        $backgroundStyles = "";

        for ($a = 1; $a <= 10; $a++) {
            $colorClass = ".background-color-" . $colorName;
            
            if ($a == 10) {
                $backgroundStyles .= $colorClass . " { background-color: rgb(" . $colorValue . "); }";

            } else {
                $backgroundStyles .= $colorClass . "-" . ($a * 10) . " { background-color: rgba(" . $colorValue . ", " . ($a / 10) . "); }";

            }
        }

        return $backgroundStyles;
    }

    function generateStyleSheet($styleGuideID = null) {
        if (!$styleGuideID) { return null; }

        //screen parameters
        if (have_rows('style-guides-screenParameters', $styleGuideID)) {
            while (have_rows('style-guides-screenParameters', $styleGuideID)) {
                the_row();

                $contentWidth_outer  = get_sub_field("contentWidth_outer");
                $contentWidth_inner  = get_sub_field("contentWidth_inner");
                $contentWidth_min    = get_sub_field("contentWidth_min");
                
                $breakPoint_laptop   = get_sub_field("breakPoint_laptop");
                $breakPoint_tablet   = get_sub_field("breakPoint_tablet");
                $breakPoint_mobile   = get_sub_field("breakPoint_mobile");
                
                $pagePadding_desktop = get_sub_field("pagePadding_desktop");
                $pagePadding_laptop  = get_sub_field("pagePadding_laptop");
                $pagePadding_tablet  = get_sub_field("pagePadding_tablet");
                $pagePadding_mobile  = get_sub_field("pagePadding_mobile");
            }
        }

        //font families
        if (have_rows('style-guides-fontFamilies', $styleGuideID)) {
            while (have_rows('style-guides-fontFamilies', $styleGuideID)) {
                the_row();

                $displayFamily_name        = get_sub_field("displayFamily_name");
                $displayFamily_woffFile    = get_sub_field("displayFamily_woffFile");
                $displayFamily_woff2File   = get_sub_field("displayFamily_woff2File");

                $bodyFamily_name           = get_sub_field("bodyFamily_name");
                $bodyFamily_woffFile       = get_sub_field("bodyFamily_woffFile");
                $bodyFamily_woff2File      = get_sub_field("bodyFamily_woff2File");

                $customFamilyOne_name      = get_sub_field("customFamilyOne_name");
                $customFamilyOne_woffFile  = get_sub_field("customFamilyOne_woffFile");
                $customFamilyOne_woff2File = get_sub_field("customFamilyOne_woff2File");

                $customFamilyTwo_name      = get_sub_field("customFamilyTwo_name");
                $customFamilyTwo_woffFile  = get_sub_field("customFamilyTwo_woffFile");
                $customFamilyTwo_woff2File = get_sub_field("customFamilyTwo_woff2File");
            }
        }

        //header classes
        if (have_rows('style-guides-headerClasses', $styleGuideID)) {
            while (have_rows('style-guides-headerClasses', $styleGuideID)) {
                the_row();

                $h1_fontSize_max_desktop = get_sub_field("h1_fontSize_max_desktop");
                $h1_fontSize_max_laptop  = get_sub_field("h1_fontSize_max_laptop");
                $h1_fontSize_max_tablet  = get_sub_field("h1_fontSize_max_tablet");
                $h1_fontSize_max_mobile  = get_sub_field("h1_fontSize_max_mobile");
                $h1_fontSize_min_mobile  = get_sub_field("h1_fontSize_min_mobile");
                
                $h2_fontSize_max_desktop = get_sub_field("h2_fontSize_max_desktop");
                $h2_fontSize_max_laptop  = get_sub_field("h2_fontSize_max_laptop");
                $h2_fontSize_max_tablet  = get_sub_field("h2_fontSize_max_tablet");
                $h2_fontSize_max_mobile  = get_sub_field("h2_fontSize_max_mobile");
                $h2_fontSize_min_mobile  = get_sub_field("h2_fontSize_min_mobile");
                
                $h3_fontSize_max_desktop = get_sub_field("h3_fontSize_max_desktop");
                $h3_fontSize_max_laptop  = get_sub_field("h3_fontSize_max_laptop");
                $h3_fontSize_max_tablet  = get_sub_field("h3_fontSize_max_tablet");
                $h3_fontSize_max_mobile  = get_sub_field("h3_fontSize_max_mobile");
                $h3_fontSize_min_mobile  = get_sub_field("h3_fontSize_min_mobile");

                $h4_fontSize_max_desktop = get_sub_field("h4_fontSize_max_desktop");
                $h4_fontSize_max_laptop  = get_sub_field("h4_fontSize_max_laptop");
                $h4_fontSize_max_tablet  = get_sub_field("h4_fontSize_max_tablet");
                $h4_fontSize_max_mobile  = get_sub_field("h4_fontSize_max_mobile");
                $h4_fontSize_min_mobile  = get_sub_field("h4_fontSize_min_mobile");

                $h5_fontSize_max_desktop = get_sub_field("h5_fontSize_max_desktop");
                $h5_fontSize_max_laptop  = get_sub_field("h5_fontSize_max_laptop");
                $h5_fontSize_max_tablet  = get_sub_field("h5_fontSize_max_tablet");
                $h5_fontSize_max_mobile  = get_sub_field("h5_fontSize_max_mobile");
                $h5_fontSize_min_mobile  = get_sub_field("h5_fontSize_min_mobile");

                $h6_fontSize_max_desktop = get_sub_field("h6_fontSize_max_desktop");
                $h6_fontSize_max_laptop  = get_sub_field("h6_fontSize_max_laptop");
                $h6_fontSize_max_tablet  = get_sub_field("h6_fontSize_max_tablet");
                $h6_fontSize_max_mobile  = get_sub_field("h6_fontSize_max_mobile");
                $h6_fontSize_min_mobile  = get_sub_field("h6_fontSize_min_mobile");
            }
        }

        //body classes
        if (have_rows('style-guides-bodyClasses', $styleGuideID)) {
            while (have_rows('style-guides-bodyClasses', $styleGuideID)) {
                the_row();

                $xxl_fontSize_max_desktop = get_sub_field("xxl_fontSize_max_desktop");
                $xxl_fontSize_max_laptop  = get_sub_field("xxl_fontSize_max_laptop");
                $xxl_fontSize_max_tablet  = get_sub_field("xxl_fontSize_max_tablet");
                $xxl_fontSize_max_mobile  = get_sub_field("xxl_fontSize_max_mobile");
                $xxl_fontSize_min_mobile  = get_sub_field("xxl_fontSize_min_mobile");
                
                $xl_fontSize_max_desktop  = get_sub_field("xl_fontSize_max_desktop");
                $xl_fontSize_max_laptop   = get_sub_field("xl_fontSize_max_laptop");
                $xl_fontSize_max_tablet   = get_sub_field("xl_fontSize_max_tablet");
                $xl_fontSize_max_mobile   = get_sub_field("xl_fontSize_max_mobile");
                $xl_fontSize_min_mobile   = get_sub_field("xl_fontSize_min_mobile");
                
                $l_fontSize_max_desktop   = get_sub_field("l_fontSize_max_desktop");
                $l_fontSize_max_laptop    = get_sub_field("l_fontSize_max_laptop");
                $l_fontSize_max_tablet    = get_sub_field("l_fontSize_max_tablet");
                $l_fontSize_max_mobile    = get_sub_field("l_fontSize_max_mobile");
                $l_fontSize_min_mobile    = get_sub_field("l_fontSize_min_mobile");
                
                $m_fontSize_max_desktop   = get_sub_field("m_fontSize_max_desktop");
                $m_fontSize_max_laptop    = get_sub_field("m_fontSize_max_laptop");
                $m_fontSize_max_tablet    = get_sub_field("m_fontSize_max_tablet");
                $m_fontSize_max_mobile    = get_sub_field("m_fontSize_max_mobile");
                $m_fontSize_min_mobile    = get_sub_field("m_fontSize_min_mobile");
                
                $s_fontSize_max_desktop   = get_sub_field("s_fontSize_max_desktop");
                $s_fontSize_max_laptop    = get_sub_field("s_fontSize_max_laptop");
                $s_fontSize_max_tablet    = get_sub_field("s_fontSize_max_tablet");
                $s_fontSize_max_mobile    = get_sub_field("s_fontSize_max_mobile");
                $s_fontSize_min_mobile    = get_sub_field("s_fontSize_min_mobile");
                
                $xs_fontSize_max_desktop  = get_sub_field("xs_fontSize_max_desktop");
                $xs_fontSize_max_laptop   = get_sub_field("xs_fontSize_max_laptop");
                $xs_fontSize_max_tablet   = get_sub_field("xs_fontSize_max_tablet");
                $xs_fontSize_max_mobile   = get_sub_field("xs_fontSize_max_mobile");
                $xs_fontSize_min_mobile   = get_sub_field("xs_fontSize_min_mobile");
            }
        }

        //colors
        if (have_rows('style-guides-colors', $styleGuideID)) {
            while (have_rows('style-guides-colors', $styleGuideID)) {
                the_row();

                $color_white = get_sub_field("color_white");
                $color_black = get_sub_field("color_black");
                $color_one   = get_sub_field("color_one");
                $color_two   = get_sub_field("color_two");
                $color_three = get_sub_field("color_three");
                $color_four  = get_sub_field("color_four");
                $color_five  = get_sub_field("color_five");
                $color_six   = get_sub_field("color_six");
            }
        }

        $styleGuide = "@font-face{font-family:" .  $displayFamily_name . ";src:url(" . $displayFamily_woff2File . ") format('woff2'),url(" . $displayFamily_woffFile . ") format('woff');} @font-face {font-family: " . $bodyFamily_name . ";src:url(" . $bodyFamily_woff2File . ") format('woof2'),url(" . $bodyFamily_woffFile . ") format('woff');}@font-face{font-family:" . $customFamilyOne_name . ";src:url(" . $customFamilyOne_woff2File . ") format('woof2'),url(" . $customFamilyOne_woffFile . ") format('woff');}@font-face{font-family:" . $customFamilyTwo_name . ";src:url(" . $customFamilyTwo_woff2File . ") format('woof2'),url(" . $customFamilyTwo_woffFile . ") format('woff');}";
        $styleGuide .= "*{-webkit-appearance:none;-moz-appearance:none;appearance:none;background:none;border:0;box-sizing: border-box;display:block;color:rgba(" . $color_black . ");font-family:" . $bodyFamily_name . ", Arial, Helvetica, sans-serif; font-size:" . createFontSize($m_fontSize_max_laptop, $m_fontSize_max_desktop, $breakPoint_laptop, $contentWidth_outer) . ";font-weight:normal;letter-spacing:0.01em;line-height:1.1;margin:0 auto;padding:0;text-decoration:none;width:100%;z-index:2;}html{font-size:1px;margin-top:0 !important;}style,script,#wpadminbar{display:none;}section{;position:relative;}strong,em,b,i,span,a{color:inherit;display:inline;font-family:inherit;font-size:inherit;}strong{font-weight:bold;}p a,p span{display: inline;}p a,a,p .linkText,.linkText{cursor:pointer;-webkit-transition:color 500ms ease-in-out;-o-transition:color 500ms ease-in-out;transition:color 500ms ease-in-out;}a:hover,.linkText:hover{color:rgb(" . $color_one . ");}h1,h2,h3,h4,h5,h6{font-weight:bold;}";
        $styleGuide .= "h1,h2,h3,h4,h5,h6,.font-display{font-family:" . $displayFamily_name . ";}.font-body{font-family:" . $bodyFamily_name . ";}.font-custom-1{font-family:" . $customFamilyOne_name . ";}.font-custom-2{font-family:" . $customFamilyTwo_name . ";}";
        $styleGuide .= ".fontWeight-bold{font-weight:bold;}.fontWeight-regular{font-weight:400;}.fontWeight-light{font-weight:lighter;}";
        $styleGuide .= ".fontStyle-italic{font-style:italic;}.fontStyle-underline{text-decoration:underline;}.fontStyle-capitalise{text-transform:capitalize;}.fontStyle-uppercase{text-transform:uppercase;}.fontStyle-lowercase{text-transform:lowercase;}";
        $styleGuide .= "h1,.fontSize-h1{font-size:" . createFontSize($h1_fontSize_max_laptop, $h1_fontSize_max_desktop, $breakPoint_laptop, $contentWidth_outer) . ";}h2,.fontSize-h2{font-size:" . createFontSize($h2_fontSize_max_laptop, $h2_fontSize_max_desktop, $breakPoint_laptop, $contentWidth_outer) . ";}h3,.fontSize-h3{font-size:" . createFontSize($h3_fontSize_max_laptop, $h3_fontSize_max_desktop, $breakPoint_laptop, $contentWidth_outer) . ";}h4,.fontSize-h4{font-size:" . createFontSize($h4_fontSize_max_laptop, $h4_fontSize_max_desktop, $breakPoint_laptop, $contentWidth_outer) . ";}h5,.fontSize-h5{font-size:" . createFontSize($h5_fontSize_max_laptop, $h5_fontSize_max_desktop, $breakPoint_laptop, $contentWidth_outer) . ";}h6,.fontSize-h6{font-size:" . createFontSize($h6_fontSize_max_laptop, $h6_fontSize_max_desktop, $breakPoint_laptop, $contentWidth_outer) . ";}.fontSize-xxl{font-size:" . createFontSize($xxl_fontSize_max_laptop, $xxl_fontSize_max_desktop, $breakPoint_laptop, $contentWidth_outer) . ";}.fontSize-xl{font-size:" . createFontSize($xl_fontSize_max_laptop, $xl_fontSize_max_desktop, $breakPoint_laptop, $contentWidth_outer) . ";}.fontSize-l{font-size:" . createFontSize($l_fontSize_max_laptop, $l_fontSize_max_desktop, $breakPoint_laptop, $contentWidth_outer) . ";}.fontSize-m{font-size:" . createFontSize($m_fontSize_max_laptop, $m_fontSize_max_desktop, $breakPoint_laptop, $contentWidth_outer) . ";}.fontSize-s{font-size:" . createFontSize($s_fontSize_max_laptop, $s_fontSize_max_desktop, $breakPoint_laptop, $contentWidth_outer) . ";}.fontSize-xs{font-size:" . createFontSize($xs_fontSize_max_laptop, $xs_fontSize_max_desktop, $breakPoint_laptop, $contentWidth_outer) . ";}";
        $styleGuide .= ".container-outer{max-width:" . $contentWidth_outer . "px;padding:0 " . $pagePadding_desktop . "px;position:relative;}.container-inner{max-width:" . $contentWidth_inner . "px;}";
        $styleGuide .= ".spacer .laptop,.spacer .tablet,.spacer .mobile{display:none;}.spacer .desktop {display:block;}";
        $styleGuide .= ".background{background-position:center center;background-repeat:no-repeat;background-size:cover;height:100%;left:0;position:absolute;top:0;width:100%;z-index:1;}";
        $styleGuide .= ".linkWrapper{cursor:pointer;height:100%;left:0;position:absolute;top:0;width:100%;z-index:3;}";
        $styleGuide .= ".textShadow{text-shadow:-0.1em 0.1em rgba(0,0,0,0.5);}.align-left{text-align:left;}.align-right{text-align:right;}.align-center{text-align:center;}.cursor-pointer{cursor:pointer;}";
        $styleGuide .= ".grid{-ms-flex-line-pack:center;align-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;display:-ms-grid;display:grid;grid-gap:50rem;-ms-grid-columns:1fr;grid-template-columns:1fr;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;}.left{grid-area:left;}.right{grid-area:right;}";
        $styleGuide .= ".readMore{-webkit-transition:height 200ms ease,opacity 200ms ease;-o-transition:height 200ms ease,opacity 200ms ease;transition:height 200ms ease,opacity 200ms ease;}.readMore>p>span{display:inline;}.readMore>p>.more{display:none;}.readMore>p>.button{cursor:pointer;display:inline-block;font-weight:bold;width:auto;}.readMore.active>p>span{display:inline!important;}";
        $styleGuide .= ".Scroller{padding-right:" . $pagePadding_desktop . "px;opacity:0;overflow-x:scroll;-webkit-transition:opacity 1000ms ease-in-out,padding 1000ms ease-in-out;-o-transition:opacity 1000ms ease-in-out,padding 1000ms ease-in-out;transition:opacity 1000ms ease-in-out,padding 1000ms ease-in-out;}.Scroller::-webkit-scrollbar{display:none;}.Scroller.scrollerSet{opacity:1;}.Scroller>.inner{grid-gap:20px;-ms-grid-columns:auto 20px auto 20px auto 20px auto 20px auto 20px auto;justify-content:start;padding:20px 0;}.Scroller>.inner>.item:nth-last-child(1){padding-right:" . $pagePadding_desktop . "px;}";
        $styleGuide .= ".Carousel{grid-template-areas:'carousel''tabs';-webkit-box-pack:start;-ms-flex-pack:start;justify-content:start;max-width:100vw;opacity:0;position:relative;-webkit-transition:opacity 1000ms ease-in-out;-o-transition:opacity 1000ms ease-in-out;transition:opacity 1000ms ease-in-out;}.Carousel>.outer{grid-area:carousel;padding-right:" . $pagePadding_desktop . "px;-webkit-transition:padding 1000ms ease-in-out;-o-transition:padding 1000ms ease-in-out;transition:padding 1000ms ease-in-out;}.Carousel.carouselSet{opacity:1;}.Carousel>.outer>.inner{-webkit-box-pack:start;-ms-flex-pack:start;justify-content:start;-webkit-transition:-webkit-transform 1000ms ease-in-out;transition:-webkit-transform 1000ms ease-in-out;-o-transition:transform 1000ms ease-in-out;transition:transform 1000ms ease-in-out;transition:transform 1000ms ease-in-out,-webkit-transform 1000ms ease-in-out;}.Carousel>.carouselButton{box-shadow:-5px 5px rgba(0,0,0,0.5);cursor:pointer;height:50px;opacity:0.5;position:absolute;top:calc(50% - 25px);-webkit-transition:all 250ms ease-in-out,opacity 500ms ease-in-out;-o-transition:all 250ms ease-in-out,opacity 500ms ease-in-out;transition:all 250ms ease-in-out,opacity 500ms ease-in-out;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%);width:50px;z-index:3;}.Carousel>.carouselButton:hover{box-shadow:-10px 10px rgba(0,0,0,0.5); transform:translate(5px, calc(-50% - 5px));}.Carousel>.carouselButton.active{opacity:1;}.Carousel>.carouselButton:after{border-bottom:10px solid transparent;border-top:10px solid transparent;content:'';display:block;height:0;margin:0 auto;width:0;}.Carousel>.carouselButton.left{left:0;}.Carousel>.carouselButton.left:after{border-right:15px solid rgb(" . $color_black . ");}.Carousel>.carouselButton.right{right:0;}.Carousel>.carouselButton.right:after{border-left:15px solid rgb(" . $color_black . ");}.Carousel>.outer>.inner>.item{box-shadow:-5px 5px rgba(0,0,0,0.5);height:100%;min-height:300px;opacity:0.5;padding:50px;position:relative;transition:all 250ms ease-in-out;width:calc(98vw - " . (2 * $pagePadding_desktop) . "px);}.Carousel>.outer>.inner>.item:hover{box-shadow:-10px 10px rgba(0,0,0,0.5);transform:translate(5px,-5px);}.Carousel>.outer>.inner>.item.active{opacity:1;}.Carousel>.outer>.inner>.item.showing{opacity:1;}.Carousel>.outer>.inner>.item>.inner{transition:transform 250ms ease-in-out;}.Carousel>.outer>.inner>.item:hover>.inner{transform:translate(5px,-5px);}.Carousel>.navigationTabs{grid-area:tabs;margin:0;max-width:100vw;}.Carousel>.outer>.inner>.item>.background{opacity:0.6;}.Carousel>.navigationTabs>.outer>.inner{grid-gap:20px;}.Carousel>.navigationTabs>.outer>.inner>.tab{cursor:pointer;height:20px;opacity:0.5;-webkit-transition:opacity 500ms ease-in-out;-o-transition:opacity 500ms ease-in-out;transition:opacity 500ms ease-in-out;width: 20px;}.Carousel>.navigationTabs>.outer>.inner>.tab.active{opacity:1;}";
        $styleGuide .= ".SearchBar{overflow:visible;padding:20px 0;position:relative;z-index:3;}.SearchBar form{grid-gap:20px;grid-template-areas:'search submit';-ms-grid-columns:1fr 20px auto;grid-template-columns:1fr auto;}.SearchBar .searchContainer{-ms-grid-row:1;-ms-grid-column:1;grid-area:search;position:relative;}.SearchBar .searchContainer>.searchResults{height:0;overflow:hidden;position:absolute;-webkit-transition:height 500ms ease;-o-transition:height 500ms ease;transition:height 500ms ease;width:100%;}.SearchBar .loadingContainer{display:none;opacity:0;-webkit-transition:opacity 500ms ease;-o-transition:opacity 500ms ease;transition:opacity 500ms ease;}.SearchBar.loading .loadingContainer{display:block;opacity:1;}.SearchBar.set .searchContainer>.searchResults{opacity:1;}.SearchBar .loadingContainer,.SearchBar .noResults,.SearchBar .searchResult{padding:0.5em;}.SearchBar #search-results{opacity:0;-webkit-transition:opacity 500ms ease;-o-transition:opacity 500ms ease;transition:opacity 500ms ease;}.SearchBar.set #search-results{opacity:1;}.SearchBar input[type='text']{border:2px solid rgb(250,126,10);outline:unset;padding:0.5em;}.SearchBar input[type='submit']{-ms-grid-row:1;-ms-grid-column:3;cursor:pointer;grid-area:submit;padding:0.5em 1em;}";
        $styleGuide .= createColorStyles("white", $color_white);
        $styleGuide .= createColorStyles("black", $color_black);
        $styleGuide .= createColorStyles("custom-1", $color_one);
        $styleGuide .= createColorStyles("custom-2", $color_two);
        $styleGuide .= createColorStyles("custom-3", $color_three);
        $styleGuide .= createColorStyles("custom-4", $color_four);
        $styleGuide .= createColorStyles("custom-5", $color_five);
        $styleGuide .= createColorStyles("custom-6", $color_six);
        $styleGuide .= createBackgroundColorStyles("white", $color_white);
        $styleGuide .= createBackgroundColorStyles("black", $color_black);
        $styleGuide .= createBackgroundColorStyles("custom-1", $color_one);
        $styleGuide .= createBackgroundColorStyles("custom-2", $color_two);
        $styleGuide .= createBackgroundColorStyles("custom-3", $color_three);
        $styleGuide .= createBackgroundColorStyles("custom-4", $color_four);
        $styleGuide .= createBackgroundColorStyles("custom-5", $color_five);
        $styleGuide .= createBackgroundColorStyles("custom-6", $color_six);
        $styleGuide .= "@media(max-width:" . $breakPoint_laptop . "px){*{font-size:" . createFontSize($m_fontSize_max_tablet, $m_fontSize_max_laptop, $breakPoint_tablet, $breakPoint_laptop) . ";}h1,.fontSize-h1{font-size:" . createFontSize($h1_fontSize_max_tablet, $h1_fontSize_max_laptop, $breakPoint_tablet, $breakPoint_laptop) . ";}h2,.fontSize-h2{font-size:" . createFontSize($h2_fontSize_max_tablet, $h2_fontSize_max_laptop, $breakPoint_tablet, $breakPoint_laptop) . ";}h3,.fontSize-h3{font-size:" . createFontSize($h3_fontSize_max_tablet, $h3_fontSize_max_laptop, $breakPoint_tablet, $breakPoint_laptop) . ";}h4,.fontSize-h4{font-size:" . createFontSize($h4_fontSize_max_tablet, $h4_fontSize_max_laptop, $breakPoint_tablet, $breakPoint_laptop) . ";}h5,.fontSize-h5{font-size:" . createFontSize($h5_fontSize_max_tablet, $h5_fontSize_max_laptop, $breakPoint_tablet, $breakPoint_laptop) . ";}h6,.fontSize-h6{font-size:" . createFontSize($h6_fontSize_max_tablet, $h6_fontSize_max_laptop, $breakPoint_tablet, $breakPoint_laptop) . ";}.fontSize-xxl{font-size:" . createFontSize($xxl_fontSize_max_tablet, $xxl_fontSize_max_laptop, $breakPoint_tablet, $breakPoint_laptop) . ";}.fontSize-xl{font-size:" . createFontSize($xl_fontSize_max_tablet, $xl_fontSize_max_laptop, $breakPoint_tablet, $breakPoint_laptop) . ";}.fontSize-l{font-size:" . createFontSize($l_fontSize_max_tablet, $l_fontSize_max_laptop, $breakPoint_tablet, $breakPoint_laptop) . ";}.fontSize-m{font-size:" . createFontSize($m_fontSize_max_tablet, $m_fontSize_max_laptop, $breakPoint_tablet, $breakPoint_laptop) . ";}.fontSize-s{font-size:" . createFontSize($s_fontSize_max_tablet, $s_fontSize_max_laptop, $breakPoint_tablet, $breakPoint_laptop) . ";}.fontSize-xs{font-size:" . createFontSize($xs_fontSize_max_tablet, $xs_fontSize_max_laptop, $breakPoint_tablet, $breakPoint_laptop) . ";}.container-outer{padding:0 " . $pagePadding_laptop . "px;}.spacer>.desktop,.spacer>.tablet,.spacer>.mobile{display:none;}.spacer>.laptop{display:block;}.readMore>p>.desktop{display:none;}.Scroller{padding-right:" . $pagePadding_laptop . "px;}.Scroller>.inner>.item:nth-last-child(1){padding-right:" . $pagePadding_laptop . "px;}.Carousel{padding-right:" . $pagePadding_laptop . "px;}.Carousel>.outer>.inner>.item{width:calc(98vw - " . (2 * $pagePadding_laptop) . "px)}}";
        $styleGuide .= "@media(max-width:" . $breakPoint_tablet . "px){*{font-size:" . createFontSize($m_fontSize_max_mobile, $m_fontSize_max_tablet, $breakPoint_mobile, $breakPoint_tablet) . ";}h1,.fontSize-h1{font-size:" . createFontSize($h1_fontSize_max_mobile, $h1_fontSize_max_tablet, $breakPoint_mobile, $breakPoint_tablet) . ";}h2,.fontSize-h2{font-size:" . createFontSize($h2_fontSize_max_mobile, $h2_fontSize_max_tablet, $breakPoint_mobile, $breakPoint_tablet) . ";}h3,.fontSize-h3{font-size:" . createFontSize($h3_fontSize_max_mobile, $h3_fontSize_max_tablet, $breakPoint_mobile, $breakPoint_tablet) . ";}h4,.fontSize-h4{font-size:" . createFontSize($h4_fontSize_max_mobile, $h4_fontSize_max_tablet, $breakPoint_mobile, $breakPoint_tablet) . ";}h5,.fontSize-h5{font-size:" . createFontSize($h5_fontSize_max_mobile, $h5_fontSize_max_tablet, $breakPoint_mobile, $breakPoint_tablet) . ";}h6,.fontSize-h6{font-size:" . createFontSize($h6_fontSize_max_mobile, $h6_fontSize_max_tablet, $breakPoint_mobile, $breakPoint_tablet) . ";}.fontSize-xxl{font-size:" . createFontSize($xxl_fontSize_max_mobile, $xxl_fontSize_max_tablet, $breakPoint_mobile, $breakPoint_tablet) . ";}.fontSize-xl{font-size:" . createFontSize($xl_fontSize_max_mobile, $xl_fontSize_max_tablet, $breakPoint_mobile, $breakPoint_tablet) . ";}.fontSize-l{font-size:" . createFontSize($l_fontSize_max_mobile, $l_fontSize_max_tablet, $breakPoint_mobile, $breakPoint_tablet) . ";}.fontSize-m{font-size:" . createFontSize($m_fontSize_max_mobile, $m_fontSize_max_tablet, $breakPoint_mobile, $breakPoint_tablet) . ";}.fontSize-s{font-size:" . createFontSize($s_fontSize_max_mobile, $s_fontSize_max_tablet, $breakPoint_mobile, $breakPoint_tablet) . ";}.fontSize-xs{font-size:" . createFontSize($xs_fontSize_max_mobile, $xs_fontSize_max_tablet, $breakPoint_mobile, $breakPoint_tablet) . ";}.container-outer{padding:0 " . $pagePadding_tablet . "px;}.spacer>.desktop,.spacer>.laptop,.spacer>.mobile{display:none;}.spacer .tablet{display:block;}.readMore>p>.laptop{display:none;}.Scroller{padding-right:" . $pagePadding_tablet . "px;}.Scroller>.inner>.item:nth-last-child(1){padding-right:" . $pagePadding_tablet . "px;}.Carousel{-ms-flex-line-pack:center;align-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;display:-ms-grid;display:grid;grid-gap:50px 20px;-ms-grid-columns:50px 20px 50px 20px 1fr;grid-template-columns:50px 50px 1fr;-ms-grid-rows:auto 50px auto;grid-template-areas:'carousel carousel carousel''buttonLeft buttonRight tabs';-webkit-box-pack:start;-ms-flex-pack:start;justify-content:start;padding:0 30px;padding-right:" . $pagePadding_tablet . "px;}.Carousel>.carouselButton{left:unset!important;position:relative;right:unset!important;top:unset;transform:unset;}.Carousel>.carouselButton.left{-ms-grid-row:3;-ms-grid-column:1;grid-area:buttonLeft;}.Carousel>.carouselButton.right{-ms-grid-row:3;-ms-grid-column:3;grid-area:buttonRight;}.Carousel>.outer{-ms-grid-row:1;-ms-grid-column:1;-ms-grid-column-span:5;grid-area:carousel;padding-left:0!important;}.Carousel>.outer>.inner>.item{width:calc(98vw - " . (2 * $pagePadding_tablet) . "px)}}";
        $styleGuide .= "@media(max-width:" . $breakPoint_mobile . "px){*{font-size:" . createFontSize($m_fontSize_min_mobile, $m_fontSize_max_mobile, $contentWidth_min, $breakPoint_mobile) . ";}h1,.fontSize-h1{font-size:" . createFontSize($h1_fontSize_min_mobile, $h1_fontSize_max_mobile, $contentWidth_min, $breakPoint_mobile) . ";}h2,.fontSize-h2{font-size:" . createFontSize($h2_fontSize_min_mobile, $h2_fontSize_max_mobile, $contentWidth_min, $breakPoint_mobile) . ";}h3,.fontSize-h3{font-size:" . createFontSize($h3_fontSize_min_mobile, $h3_fontSize_max_mobile, $contentWidth_min, $breakPoint_mobile) . ";}h4,.fontSize-h4{font-size:" . createFontSize($h4_fontSize_min_mobile, $h4_fontSize_max_mobile, $contentWidth_min, $breakPoint_mobile) . ";}h5,.fontSize-h5{font-size:" . createFontSize($h5_fontSize_min_mobile, $h5_fontSize_max_mobile, $contentWidth_min, $breakPoint_mobile) . ";}h6,.fontSize-h6{font-size:" . createFontSize($h6_fontSize_min_mobile, $h6_fontSize_max_mobile, $contentWidth_min, $breakPoint_mobile) . ";}.fontSize-xxl{font-size:" . createFontSize($xxl_fontSize_min_mobile, $xxl_fontSize_max_mobile, $contentWidth_min, $breakPoint_mobile) . ";}.fontSize-xl{font-size:" . createFontSize($xl_fontSize_min_mobile, $xl_fontSize_max_mobile, $contentWidth_min, $breakPoint_mobile) . ";}.fontSize-l{font-size:" . createFontSize($l_fontSize_min_mobile, $l_fontSize_max_mobile, $contentWidth_min, $breakPoint_mobile) . ";}.fontSize-m{font-size:" . createFontSize($m_fontSize_min_mobile, $m_fontSize_max_mobile, $contentWidth_min, $breakPoint_mobile) . ";}.fontSize-s{font-size:" . createFontSize($s_fontSize_min_mobile, $s_fontSize_max_mobile, $contentWidth_min, $breakPoint_mobile) . ";}.fontSize-xs{font-size:" . createFontSize($xs_fontSize_min_mobile, $xs_fontSize_max_mobile, $contentWidth_min, $breakPoint_mobile) . ";}.container-outer{padding:0 " . $pagePadding_mobile . "px;}.spacer .desktop,.spacer .laptop,.spacer .tablet{display:none;}.spacer .mobile{display:block;}.readMore>p>.tablet{display:none;}.Scroller{padding-right:" . $pagePadding_mobile . "px;}.Scroller>.inner>.item:nth-last-child(1){padding-right:" . $pagePadding_mobile . "px;}.Carousel{grid-template-areas:'carousel''tabs';grid-template-columns:1fr;padding-right:" . $pagePadding_mobile . "px;}.Carousel>.carouselButton{display:none;}.Carousel>.navigationTabs{max-width:calc(98vw - " . (2 * $pagePadding_mobile) ."px);}.Carousel>.outer>.inner>.item{width:calc(98vw - " . (2 * $pagePadding_mobile) . "px)}}";

        return $styleGuide;
    }

    function generateStyleSheetDependantScripts($styleGuideID = null) {
        if (!$styleGuideID) { return null; }

        //screen parameters
        if (have_rows('style-guides-screenParameters', $styleGuideID)) {
            while (have_rows('style-guides-screenParameters', $styleGuideID)) {
                the_row();

                $contentWidth_outer  = get_sub_field("contentWidth_outer");
                $contentWidth_inner  = get_sub_field("contentWidth_inner");
                $contentWidth_min    = get_sub_field("contentWidth_min");
                
                $breakPoint_laptop   = get_sub_field("breakPoint_laptop");
                $breakPoint_tablet   = get_sub_field("breakPoint_tablet");
                $breakPoint_mobile   = get_sub_field("breakPoint_mobile");
                
                $pagePadding_desktop = get_sub_field("pagePadding_desktop");
                $pagePadding_laptop  = get_sub_field("pagePadding_laptop");
                $pagePadding_tablet  = get_sub_field("pagePadding_tablet");
                $pagePadding_mobile  = get_sub_field("pagePadding_mobile");
            }
        }

        $styleSheetDependantScripts = "function setScreenParameters(){const screenWidthContainer=document.getElementById('screenParameter-screenWidth');const screenHeightContainer=document.getElementById('screenParameter-screenHeight');const deviceContainer=document.getElementById('screenParameter-device');const pagePaddingContainer=document.getElementById('screenParameter-pagePadding');if (!screenWidthContainer || !screenHeightContainer || !deviceContainer || !pagePaddingContainer){return;}const windowWidth=window.innerWidth;const windowHeight=window.innerHeight;const mobileBreak=" . $breakPoint_mobile . ";const tabletBreak=" . $breakPoint_tablet . ";const laptopBreak=" . $breakPoint_laptop . ";var device='Desktop';var pagePadding=" . $pagePadding_desktop . ";if(windowWidth<=mobileBreak){device='Mobile';pagePadding=" .  $pagePadding_mobile . ";}else if(windowWidth<=tabletBreak){device='Tablet';pagePadding=" . $pagePadding_tablet . ";}else if(windowWidth<=laptopBreak){device='Laptop';pagePadding=" . $pagePadding_laptop . ";}screenWidthContainer.innerText=windowWidth+'px';screenHeightContainer.innerText=windowHeight+'px';deviceContainer.innerText=device;pagePaddingContainer.innerText=pagePadding+'px';return;}";
        $styleSheetDependantScripts .= "window.addEventListener('load', () => {setScreenParameters();});";
        $styleSheetDependantScripts .= "window.addEventListener('resize', () => {setScreenParameters();});";
        $styleSheetDependantScripts .= "function setScrollerPaddingLeft(defaultWidth=" . $contentWidth_outer - $pagePadding_desktop . ",screenBreaks=[" . $breakPoint_mobile . "," . $breakPoint_tablet . "," . $breakPoint_laptop . "],minPaddings=[" . $pagePadding_mobile . "," . $pagePadding_tablet . "," . $pagePadding_laptop . ",". $pagePadding_desktop . "]){const scrollers=document.getElementsByClassName('Scroller');const windowWidth=window.innerWidth;var minPadding=minPaddings[3]||50;for(var a=0;a<minPaddings.length;a++){const b=a+1>screenBreaks.length?screenBreaks.length-1:a;if(windowWidth<=screenBreaks[b]){minPadding=minPaddings[a];break;}}for(var a=0;a<scrollers.length;a++){const scrollerMaxWidth = scrollers[a].getAttribute('data-scroller-max-width');var paddingLeft=(windowWidth-defaultWidth)/2<=minPadding?minPadding:(windowWidth-defaultWidth)/2;if(!isNaN(scrollerMaxWidth)){paddingLeft=(windowWidth-scrollerMaxWidth-" . $pagePadding_desktop . ")/2<=minPadding?minPadding:(windowWidth-scrollerMaxWidth-" . $pagePadding_desktop . ")/2;}scrollers[a].style.paddingLeft=paddingLeft+'px';scrollers[a].classList.add('scrollerSet');}return;}";
        $styleSheetDependantScripts .= "window.addEventListener('load', () => {setScrollerPaddingLeft();});";
        $styleSheetDependantScripts .= "window.addEventListener('resize', () => {setScrollerPaddingLeft();});";
        $styleSheetDependantScripts .= "function setCarouselPaddingLeft(defaultWidth=" . $contentWidth_outer - $pagePadding_desktop . ",screenBreaks=[" . $breakPoint_mobile . "," . $breakPoint_tablet . "," . $breakPoint_laptop . "],minPaddings=[" . $pagePadding_mobile . "," . $pagePadding_tablet . "," . $pagePadding_laptop . ",". $pagePadding_desktop . "]){const carousels=document.getElementsByClassName('Carousel');const windowWidth=window.innerWidth;var minPadding=minPaddings[3]||50;for(var a=0;a<minPaddings.length;a++){const b=a+1>screenBreaks.length?screenBreaks.length-1:a;if(windowWidth<=screenBreaks[b]){minPadding=minPaddings[a];break;}}for(var a=0;a<carousels.length;a++){const carousleOuter=carousels[a].getElementsByClassName('outer')[0];if(!carousleOuter){continue;}const carouselMaxWidth=parseFloat(carousels[a].getAttribute('data-carousel-max-width'));var paddingLeft=(windowWidth-defaultWidth)/2<=minPadding?minPadding:(windowWidth-defaultWidth)/2;if(!isNaN(carouselMaxWidth)){paddingLeft=(windowWidth-carouselMaxWidth-" . $pagePadding_desktop . ")/2<=minPadding?minPadding:(windowWidth-carouselMaxWidth-" . $pagePadding_desktop . ")/2;}carousleOuter.style.paddingLeft=paddingLeft+'px';}return;}";
        $styleSheetDependantScripts .= "window.addEventListener('load', () => {setCarouselPaddingLeft();});";
        $styleSheetDependantScripts .= "window.addEventListener('resize', () => {setCarouselPaddingLeft();});";
        $styleSheetDependantScripts .= "function setCarouselButtonPositions(defaultWidth=" . $contentWidth_outer - $pagePadding_desktop . ",screenBreaks=[" . $breakPoint_mobile . "," . $breakPoint_tablet . "," . $breakPoint_laptop . "],minPaddings=[" . $pagePadding_mobile . "," . $pagePadding_tablet . "," . $pagePadding_laptop . ",". $pagePadding_desktop . "]){const carousels=document.getElementsByClassName('Carousel');const windowWidth=window.innerWidth;var minPadding=minPaddings[3]||50;for(var a=0;a<minPaddings.length;a++){const b=a+1>screenBreaks.length?screenBreaks.length-1:a;if(windowWidth<=screenBreaks[b]){minPadding=minPaddings[a];break;}}for(var a=0;a<carousels.length;a++){const carouselButtonLeft=carousels[a].getElementsByClassName('carouselButton left')[0];const carouselButtonRight=carousels[a].getElementsByClassName('carouselButton right')[0];if(!carouselButtonLeft||!carouselButtonRight){continue;}const carouselButtonMaxWidth=parseFloat(carousels[a].getAttribute('data-carousel-button-max-width'));var position=(windowWidth-defaultWidth)/2<=minPadding?minPadding:(windowWidth-defaultWidth)/2;if(!isNaN(carouselButtonMaxWidth)){position=(windowWidth-carouselButtonMaxWidth-" . $pagePadding_desktop . ")/2<=minPadding?minPadding:(windowWidth-carouselButtonMaxWidth-" . $pagePadding_desktop . ")/2;}carouselButtonLeft.style.left=position+'px';carouselButtonRight.style.right=position+'px';}return;}";
        $styleSheetDependantScripts .= "window.addEventListener('load', () => {setCarouselButtonPositions();});";
        $styleSheetDependantScripts .= "window.addEventListener('resize', () => {setCarouselButtonPositions();});";

        return $styleSheetDependantScripts;
    }
    
    function getStyleGuideID($postID = null) { 
        $styleGuideID = 5; //default style guide

        if (get_post_type($postID) === "style-guides" && is_single($postID)) {
            $styleGuideID = $postID;

        } else if (get_field("styleGuide", $postID)) {
            $styleGuideID = get_field("styleGuide", $postID);

        }
        
        return $styleGuideID;
    }