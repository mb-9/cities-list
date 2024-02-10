<?php

namespace App\Models;

use Illuminate\Support\Facades\Config;
use simplehtmldom\HtmlDocument;
use simplehtmldom\HtmlNode;

class CityScraper
{


    /**
     *
     * @param string $initialURL
     * @return array array in format ['cityName' => idOfCity]
     */
    public static function getAllCitiesIds(string $initialURL): array
    {

        $arrCities = [];

        $districts = self::getDistricts(ScraperHelper::getPageContent($initialURL));

        foreach ($districts as $districtName => $districtUrl) {

            $citiesDetailUrls = self::getCitiesFromDistrict(ScraperHelper::getPageContent($districtUrl));

            foreach ($citiesDetailUrls as $cityName => $cityUrl) {

                $cityEditLink = self::getCityEditUrl(ScraperHelper::getPageContent($cityUrl));

                $id = self::getCityIdFromEditUrl($cityEditLink);

                $arrCities += [$cityName => $id];

            }

            $arrCities += $citiesDetailUrls;


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
        $es = $html->find('td[align=left][valign=top] a');

        $arrayCities = [];
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
        $aTag = $html->find('a[href^=https://www.e-obce.sk/obecedit]')[0]->href;

        return $aTag;
    }

    /**
     * @param string $editUrl
     * @return int
     */
    public static function getCityIdFromEditUrl(string $editUrl): int
    {

        parse_str(parse_url($editUrl)['query'], $params);
        return $params['id'];

    }


}
