<?php namespace Frukt\Weather\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateFruktWeatherWeatherproviders extends Migration
{
    public function up()
    {
        Schema::create('frukt_weather_weatherproviders', function($table)
        {
            $table->increments('id')->unsigned();
            $table->boolean('is_active')->default(1);
            $table->smallInteger('type')->default(1);
            $table->string('api_key')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('frukt_weather_weatherproviders');
    }
}