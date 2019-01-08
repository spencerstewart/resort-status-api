<?php

use Illuminate\Database\Seeder;

class MotdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Motd::class)->create();
    }
}
