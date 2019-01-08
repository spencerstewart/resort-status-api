<?php

use Faker\Generator as Faker;

$factory->define(App\Motd::class, function (Faker $faker) {
    return [
        'from' => $faker->name,
        'message' => $faker->paragraphs(4, true),
        'channel_id' => 'msteams',
        'conversation_id' => '19:253b1f341670408fb6fe51050b6e5ceb@thread.skype;messageid=1485983194839',
        'teams_id' => '19:712c61d0ef384e5fa681ba90ca943398@thread.skype'
    ];
});
