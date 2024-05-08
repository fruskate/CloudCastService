<?php namespace Frukt\Weather\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateFruktWeatherLocations extends Migration
{
    public function up()
    {
        Schema::create('frukt_weather_locations', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
            $table->decimal('lat', 9, 6)->nullable();
            $table->decimal('lon', 9, 6)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('frukt_weather_locations');
    }
}
