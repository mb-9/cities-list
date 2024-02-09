<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Support\Facades\Config;
use simplehtmldom\HtmlDocument;
use simplehtmldom\HtmlNode;


class CityController extends Controller
{

    public function fetch(int $id){
        $content = file_get_contents('https://www.e-obce.sk/obecedit.html?id='. $id);
        $content = iconv('windows-1250', 'utf-8', $content);

        $html = new HtmlDocument($content);

        $city = new City();
        $city->fillAttributesFromAnEditPage($html);

        var_dump($city);
    }

}
