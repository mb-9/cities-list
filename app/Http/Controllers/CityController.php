<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use simplehtmldom\HtmlDocument;
use simplehtmldom\HtmlNode;


class CityController extends Controller
{
    public function fetch() : bool {

        $content = file_get_contents(Config::get('app.citiesWebpage'));
        $content = iconv('windows-1250', 'utf-8', $content);

        $html = new HtmlDocument($content);

        foreach($html->find('a[class=okreslink]') as $a) {
            /** @var $a HtmlNode **/
            var_dump($a->innerText());
        }

        return true;
    }

}
