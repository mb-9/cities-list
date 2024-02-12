<?php

namespace App\Models;

use simplehtmldom\HtmlDocument;

class ScraperHelper
{
    /**
     * @param string $url
     * @return HtmlDocument|null
     */
    public static function getPageContent(string $url) : ?HtmlDocument {

        $content = file_get_contents($url);

        if ($content === false) {
            return null;
        }

        $content = iconv('windows-1250', 'utf-8', $content);

        if($content === false){
            return null;
        }

        return new HtmlDocument($content);
    }

}
