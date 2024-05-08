<?php namespace Frukt\Weather\Models;

use Model;

/**
 * Model
 */
class WeatherProvider extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var bool timestamps are disabled.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'frukt_weather_weatherproviders';

    /**
     * @var array rules for validation.
     */
    public $rules = [
        'type' => 'unique:frukt_weather_weatherproviders,type'
    ];

    /*
     * OPTIONS
     */

    /**
     * Integrated types of Weather Providers
     * @return array
     */
    public function getTypeOptions() : array
    {
        return [
            1 => 'openweathermap.org'
        ];
    }

    /*
     * SCOPES
     */

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}
