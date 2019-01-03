<?php

use Illuminate\Database\Seeder;

class ResortsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $snowsummit = new App\Resort;
        $snowsummit->name = "Snow Summit";
        $snowsummit->slug = "snowsummit";
        $snowsummit->api_endpoint = 'https://www.bigbearmountainresort.com/Feeds/Xml/Mtn/v2.ashx?Resort=SnowSummit';
        $snowsummit->save();

        $bearmountain = new App\Resort;
        $bearmountain->name = "Bear Mountain";
        $bearmountain->slug = "bearmountain";
        $bearmountain->api_endpoint = 'https://www.bigbearmountainresort.com/Feeds/Xml/Mtn/v2.ashx?Resort=BearMountain';
        $bearmountain->save();

        $mammoth = new App\Resort;
        $mammoth->name = "Mammoth Mountain";
        $mammoth->slug = "mammoth";
        $mammoth->api_endpoint = 'https://www.bigbearmountainresort.com/Feeds/Xml/Mtn/v2.ashx?Resort=MammothMountain';
        $mammoth->save(); 
    }
}
