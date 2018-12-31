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

Route::get('{resort}/chairs/{chair_number}', function (App\Resort $resort, $chair_number) {
    return $resort->chairs()->where('number', $chair_number)->first();
    // return $chair_number;
});