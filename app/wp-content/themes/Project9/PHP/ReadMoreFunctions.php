<?php
    /* read more args tempalte
    $readMoreArgs = [
        "content"            => "",
        "wordCountDesktop"   => 0,
        "wordCountLaptop"    => 0,
        "wordCountTablet"    => 0,
        "wordCountMobile"    => 0,
        "readMoreButtonCopy" => "",
        "readLessButtonCopy" => "",
    ];
    */

    function generateReadMoreByWordCountContainer($readMoreArgs) {
		if (!$readMoreArgs["content"]            ||
            !$readMoreArgs["wordCountDesktop"]   ||
            !$readMoreArgs["wordCountLaptop"]    ||
            !$readMoreArgs["wordCountTablet"]    ||
            !$readMoreArgs["wordCountMobile"]    ||
            !$readMoreArgs["readMoreButtonCopy"] ||
            !$readMoreArgs["readLessButtonCopy"]
        ) { return; }
        
        $findTarget              = ['<br>', '<br />', '<br/>'];
        $reaplceWith             = ['**BREAK**', '**BREAK**', '**BREAK**'];
        $readMoreArgs["content"] = str_replace($findTarget, $reaplceWith, $readMoreArgs["content"] );
        $wordCountContent        = str_word_count($readMoreArgs["content"] );
        $mobileContent           = str_replace($reaplceWith, $findTarget, $readMoreArgs["content"] );
		$tabletContent           = "";
        $laptopContent           = "";
        $desktopContent          = "";
        $moreContent             = "";

        if ($readMoreArgs["wordCountDesktop"] <= $readMoreArgs["wordCountLaptop"]) { $readMoreArgs["wordCountDesktop"] = 200; }
        
        if ($readMoreArgs["wordCountLaptop"] <= $readMoreArgs["wordCountTablet"]) { $readMoreArgs["wordCountLaptop"] = 150; }
        
        if ($readMoreArgs["wordCountTablet"] <= $readMoreArgs["wordCountMobile"]) { $readMoreArgs["wordCountTablet"] = 100; }
        
        if ($readMoreArgs["wordCountMobile"] <= 0) { $readMoreArgs["wordCountTablet"] = 50; }

        if ($readMoreArgs["wordCountMobile"] < $wordCountContent) {
            $mobileWordsArray = explode(' ', $readMoreArgs["content"] , $readMoreArgs["wordCountMobile"] + 1);
    
            if ($readMoreArgs["wordCountTablet"] < $wordCountContent) {
                $tabletWordsArray = explode(' ', array_pop($mobileWordsArray), $readMoreArgs["wordCountTablet"] - $readMoreArgs["wordCountMobile"] + 1);
    
                if ($readMoreArgs["wordCountLaptop"] < $wordCountContent) {
                    $laptopWordsArray = explode(' ', array_pop($tabletWordsArray), $readMoreArgs["wordCountLaptop"] - $readMoreArgs["wordCountTablet"] + 1);

                    if ($readMoreArgs["wordCountDesktop"] < $wordCountContent) {
                        $desktopWordsArray = explode(' ', array_pop($laptopWordsArray), $readMoreArgs["wordCountDesktop"] - $readMoreArgs["wordCountLaptop"] + 1);

                        $moreContent = array_pop($desktopWordsArray);
                        $moreContent = str_replace($reaplceWith, $findTarget, $moreContent);

                        $desktopContent = implode(' ', $desktopWordsArray);
                        $desktopContent = str_replace($reaplceWith, $findTarget, $desktopContent);

                    } else {
                        $moreContent = array_pop($laptopWordsArray);
                        $moreContent = str_replace($reaplceWith, $findTarget, $moreContent);
                    }

                    $laptopContent = implode(' ', $laptopWordsArray);
                    $laptopContent = str_replace($reaplceWith, $findTarget, $laptopContent);

                } else {
                    $moreContent = array_pop($tabletWordsArray);
                    $moreContent = str_replace($reaplceWith, $findTarget, $moreContent);
                }
    
                $tabletContent = implode(' ', $tabletWordsArray);
                $tabletContent = str_replace($reaplceWith, $findTarget, $tabletContent);
    
            } else {
                $moreContent = array_pop($mobileWordsArray);
                $moreContent = str_replace($reaplceWith, $findTarget, $moreContent);
            }
    
            $mobileContent = implode(' ', $mobileWordsArray);
            $mobileContent = str_replace($reaplceWith, $findTarget, $mobileContent);
        }

        if ($wordCountContent <= $readMoreArgs["wordCountMobile"]) { return "<p class='" . $readMoreArgs["customClass"] . "'>" . $readMoreArgs["content"]  . "</p>"; }

        $readMoreContainer = "<div class='readMore' data-readMoreCopy='" . $readMoreArgs["readMoreButtonCopy"] . "'><p class='" . $readMoreArgs["customClass"] . "'>";

        if ($mobileContent) { $readMoreContainer .= "<span class='mobile'>" . $mobileContent . " " . "</span>"; }

        if ($tabletContent) { $readMoreContainer .= "<span class='tablet'>" . $tabletContent . " " . "</span>"; }

        if ($laptopContent) { $readMoreContainer .= "<span class='laptop'>" . $laptopContent . " " . "</span>"; }

        if ($desktopContent) { $readMoreContainer .= "<span class='desktop'>" . $desktopContent . " " . "</span>"; }

        if ($moreContent) { $readMoreContainer .= "<span class='more'>" . $moreContent . " " . "</span>"; }

        if ($wordCountContent >= $readMoreArgs["wordCountMobile"]) { $readMoreContainer .= "<span class='color-custom-1 cursor-pointer' onclick='handleReadMoreClick(\"" . $readMoreArgs["readMoreButtonCopy"] . "\", \"" . $readMoreArgs["readLessButtonCopy"] . "\")' data-openClose='open'>" . $readMoreArgs["readMoreButtonCopy"] . "</span>"; }
        
        $readMoreContainer .= "</p></div>"; 
		
		return $readMoreContainer;
	}