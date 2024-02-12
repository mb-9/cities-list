<?php

namespace App\Models;

use Illuminate\Support\Facades\Config;
use simplehtmldom\HtmlDocument;
use simplehtmldom\HtmlNode;

class CityScraper
{


    /**
     *
     * @param string $districtURL
     * @return array array in format ['cityName' => idOfCity]
     */
    public static function getAllCitiesIds(string $districtURL): array
    {

        $arrCities = [];

        $districtsContent = ScraperHelper::getPageContent($districtURL);
        if (is_null($districtsContent))
            return [];

        $districts = self::getDistricts($districtsContent);

        foreach ($districts as $districtName => $districtUrl) {

            $citiesContent = ScraperHelper::getPageContent($districtUrl);
            if (is_null($citiesContent))
                continue;

            $citiesDetailUrls = self::getCitiesFromDistrict($citiesContent);

            foreach ($citiesDetailUrls as $cityName => $cityUrl) {

                $detailPageContent = ScraperHelper::getPageContent($cityUrl);
                if(is_null($detailPageContent))
                    continue;

                $cityEditLink = self::getCityEditUrl($detailPageContent);

                $id = self::getCityIdFromEditUrl($cityEditLink);

                if($id <> 0)
                    $arrCities += [$cityName => $id];

            }

            $arrCities += $citiesDetailUrls;
            break;

        }

        return $arrCities;

    }

    /**
     * @param HtmlDocument $html
     * @return array array of the districts in the form of ['districtName' => 'districtURL']
     */
    public static function getDistricts(HtmlDocument $html): array
    {

        $arrayDistricts = [];
        foreach ($html->find('a[class=okreslink]') as $a) {
            /** @var $a HtmlNode * */
            $href = $a->href;
            $name = $a->innerText();
            $arrayDistricts += [$name => $href];
        }

        return $arrayDistricts;
    }

    /**
     * @param HtmlDocument $html
     * @return array format ['cityName' => 'cityURL']
     */
    public static function getCitiesFromDistrict(HtmlDocument $html): array
    {
        $arrayCities = [];
        $es = $html->find('td[align=left][valign=top] a');
        foreach ($es as $e) {
            /** @var $e HtmlNode * */
            $href = $e->href;
            $name = $e->innerText();
            $arrayCities += [$name => $href];

        }

        return $arrayCities;
    }

    /**
     * @param HtmlDocument $html
     * @return string url of the edit page
     */
    public static function getCityEditUrl(HtmlDocument $html): string
    {
        $aTag = $html->find('a[href^='.Config::get('app.cityEditPage').']');

        if(count($aTag) < 1)
            return "";

        return $aTag[0]->href;
    }

    /**
     * @param string $editUrl
     * @return int
     */
    public static function getCityIdFromEditUrl(string $editUrl): int
    {

        $parsedUrl = parse_url($editUrl);
        if($parsedUrl === false)
            return 0;

        parse_str($parsedUrl['query'], $params);

        return $params['id'] ?? 0;

    }


}
