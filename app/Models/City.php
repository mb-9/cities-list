<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use simplehtmldom\HtmlDocument;

/**
 * @property string name
 * @property string mayor_name
 * @property string city_hall_street
 * @property string city_hall_street_number
 * @property string city_hall_zip
 * @property string city_hall_post
 * @property string phone
 * @property string fax
 * @property string email
 * @property string web_address
 * @property string coat_of_arms_path
 * @property string latitude
 * @property string longitude
 */
class City extends Model
{
    use HasFactory;

    public array $validationRules = [
        'name'                      => 'required|string',
        'mayor_name'                => 'string',
        'city_hall_street'          => 'string',
        'city_hall_street_number'   => 'string',
        'city_hall_zip'             => 'string',
        'city_hall_post'            => 'string',
        'phone'                     => 'string',
        'fax'                       => 'string',
        'email'                     => 'string',
        'web_address'               => 'string',
        'coat_of_arms_path'         => 'string',
    ];

    /**
     * Validates the model
     *
     * @return array|bool array of error messages if the validation was not successful, true if model is valid
     */
    public function validate(): array|bool
    {

        $validator = Validator::make($this->getAttributes(), $this->validationRules);

        if ($validator->fails()) {
            return $validator->messages()->jsonSerialize();
        }

        return true;
    }

    /**
     * TODO: find can return empty
     * @param HtmlDocument $html
     * @return bool
     */
    public function fillAttributesFromAnEditPage(HtmlDocument $html) : bool {

        $this->mayor_name   = $html->find('input[name=Starosta]')[0]->value;
        $this->phone        = $html->find('input[name=Telefon]')[0]->value;
        $this->fax          = $html->find('input[name=Fax]')[0]->value;
        $this->web_address  = $html->find('input[name=URL]')[0]->value;
        $this->email        = $html->find('input[name=Email]')[0]->value;

        $this->city_hall_street         = $html->find('input[name=Ulica]')[0]->value;
        $this->city_hall_street_number  = $html->find('input[name=Cislo]')[0]->value;
        $this->city_hall_zip            = $html->find('input[name=Psc]')[0]->value;
        $this->city_hall_post           = $html->find('input[name=Posta]')[0]->value;
        $this->coat_of_arms_path        = "";
        $this->latitude                 = 0;
        $this->longitude                = 0;

        return true;
    }
}
