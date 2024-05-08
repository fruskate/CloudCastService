<?php namespace Frukt\Weather\Models;

use Model;

/**
 * Model
 */
class Location extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'frukt_weather_locations';

    /**
     * @var array rules for validation.
     */
    public $rules = [
        'lat' => 'required|numeric|between:-90,90',
        'lon' => 'required|numeric|between:-180,180',
        'name' => 'nullable|string|max:255'
    ];

    protected $fillable = ['name', 'lat', 'lon'];

    public $hasMany = [
        'data' => WeatherData::class
    ];

    /*
     * ATTRIBUTES
     */
    public function getLastUpdateAttribute()
    {
        $latestWeatherData = $this->data()->orderBy('created_at', 'desc')->first();
        if (!$latestWeatherData) {
            return '-';
        }
        return $latestWeatherData->created_at->diffForHumans();
    }
}
