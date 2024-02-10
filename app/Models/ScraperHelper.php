<?php

namespace App\Models;

use simplehtmldom\HtmlDocument;

class ScraperHelper
{
    /**
     * @param string $url
     * @return HtmlDocument
     */
    public static function getPageContent(string $url) : HtmlDocument {

        $content = file_get_contents($url);
        $content = iconv('windows-1250', 'utf-8', $content);

        return new HtmlDocument($content);
    }

}
