<?php namespace Frukt\Weather\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateFruktWeatherWeatherdata extends Migration
{
    public function up()
    {
        Schema::create('frukt_weather_weatherdata', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('location_id')->nullable()->unsigned();
            $table->integer('provider_id')->nullable()->unsigned();
            $table->integer('temp')->nullable();
            $table->integer('feels_like')->nullable();
            $table->integer('pressure')->nullable();
            $table->integer('humidity')->nullable();
            $table->integer('temp_min')->nullable();
            $table->integer('temp_max')->nullable();
            $table->dateTime('collected_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('frukt_weather_weatherdata');
    }
}