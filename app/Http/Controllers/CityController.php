<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CityScraper;
use App\Models\ScraperHelper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;


class CityController extends Controller
{

    /**
     * Show detail of a country
     */
    public function view($id): View
    {
        $city = City::findOrFail($id);

        return view('city.view', [
            'city'       => $city,
        ]);
    }

    public function fetch() : void{

        DB::table('cities')->truncate();
        set_time_limit(1200);
        $ids = CityScraper::getAllCitiesIds(Config::get('app.citiesWebpage'));
        foreach($ids as $name => $id){

            $editPageUrl = Config::get('app.cityEditPage').'id='.$id;

            $html = ScraperHelper::getPageContent($editPageUrl);
            $city = new City();
            $city->name = $name;
            $city->fillAttributesFromAnEditPage($html);

            if(!$city->save()){
                Log::error("Could not save the currency ".$city->name." to database");
            }

        }//endforeach

    }

}
