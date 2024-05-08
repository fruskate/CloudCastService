<?php namespace Frukt\Weather\Models;

use Model;

/**
 * Model
 */
class WeatherData extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'frukt_weather_weatherdata';

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

    public $belongsTo = [
        'provider' => [
            WeatherProvider::class,
            'key' => 'provider_id'
        ],
        'location' => [
            Location::class
        ]
    ];

}
