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

}
