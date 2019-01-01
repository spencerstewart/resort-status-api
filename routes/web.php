<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return "hello";
});

// Route::get('/snowsummit/chair/1', function() {
//     return \App\Chair::first();
// });

Route::get('{resort}', function ($resort) {
    return \App\Resort::where('slug', $resort)->with('chairs')->first();
});

Route::get('{resort}/chairs', function (App\Resort $resort) {
    return $resort->chairs()->get();
});

Route::get('{resort}/chairs/open', function (App\Resort $resort) {
    return $resort->chairs()->where('status', 'Open')->get();
});

Route::get('{resort}/chairs/closed', function (App\Resort $resort) {
    return $resort->chairs()->where('status', '!=', 'Open')->get();
});

Route::get('{resort}/chairs/{chair_number}', function (App\Resort $resort, $chair_number) {
    return $resort->chairs()->where('number', $chair_number)->first();
    // return $chair_number;
});


Route::get('{resort}/trails', function(App\Resort $resort) {
    $trails = $resort->trails;
    $open_trails = $trails->where('status', 'Open');
    
    $trail_summary = [
        'openTrails' => $open_trails,
        'difficulty' => [
            'easiestTrails' => $open_trails->where('difficulty', 'Easiest'),
            'moderateTrails' => $open_trails->where('difficulty', 'Slightly More Difficult'),
            'difficultTrails' => $open_trails->where('difficulty', 'Difficult'),
            'expertTrails' => $open_trails->where('difficulty', 'Most Difficult')
        ]
    ];
    return $trail_summary;
});

Route::get('{resort}/trails/{trail}', function(App\Resort $resort, $trail) {
    return $resort->trails()->where('id', $trail)->first();
});