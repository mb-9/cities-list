<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CityScraper;
use App\Models\ScraperHelper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;


class CityController extends Controller
{



    public function fetch(){

        set_time_limit(6000);
        $ids = CityScraper::getAllCitiesIds(Config::get('app.citiesWebpage'));

        foreach($ids as $name => $id){

            $editPageUrl = Config::get('app.citiesWebpage').$id;

            $html = ScraperHelper::getPageContent($editPageUrl);
            $city = new City();
            $city->name = $name;
            $city->fillAttributesFromAnEditPage($html);

            if(!$city->save()){
                Log::error("Could not save the currency ".$city->name." to database");
            }

        }

    }

}
