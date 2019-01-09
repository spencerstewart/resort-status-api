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

Route::get('/', 'HomeController@index');

Route::post('message', 'WebhookController@handleMessage');
Route::post('motd', 'WebhookController@handleMotd');
Route::get('webhook', 'WebhookController@index');


/**
 * Prefixed routes with api
 */

Route::prefix('api')->group(function() {
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
        return $resort->trails;
    });
    
    Route::get('{resort}/trails/open', function(App\Resort $resort) {
        return $resort->trails()->where('status', 'Open')->get();
    });
    
    Route::get('{resort}/trails/{trail}', function(App\Resort $resort, $trail) {
        return $resort->trails()->where('slug', $trail)->first();
    });
    
    Route::get('{resort}/trails/difficulty/{difficulty}', function(App\Resort $resort, $difficulty) {
        switch ($difficulty) {
            case 'easiest':
                $difficulty = 'Easiest';
                break;
            case 'moderate':
                $difficulty = 'Slightly More Difficult';
                break;
            case 'difficult':
                $difficulty = 'Difficult';
                break;
            case 'expert':
                $difficulty = 'Most Difficult';
                break;
            default:
                break;
        }
        return $resort->trails()->where('status', 'Open')->where('difficulty', $difficulty)->get();
    });
    
    Route::get('{resort}/api/lessons', function(App\Resort $resort) {
        return $resort->lessons;
    });
    
    Route::get('{resort}/lessons', 'LessonController@index');
});

/**
 * Old routes below
 */

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
    return $resort->trails;
});

Route::get('{resort}/trails/open', function(App\Resort $resort) {
    return $resort->trails()->where('status', 'Open')->get();
});

Route::get('{resort}/trails/{trail}', function(App\Resort $resort, $trail) {
    return $resort->trails()->where('slug', $trail)->first();
});

Route::get('{resort}/trails/difficulty/{difficulty}', function(App\Resort $resort, $difficulty) {
    switch ($difficulty) {
        case 'easiest':
            $difficulty = 'Easiest';
            break;
        case 'moderate':
            $difficulty = 'Slightly More Difficult';
            break;
        case 'difficult':
            $difficulty = 'Difficult';
            break;
        case 'expert':
            $difficulty = 'Most Difficult';
            break;
        default:
            break;
    }
    return $resort->trails()->where('status', 'Open')->where('difficulty', $difficulty)->get();
});

Route::get('{resort}/api/lessons', function(App\Resort $resort) {
    return $resort->lessons;
});

Route::get('{resort}/lessons', 'LessonController@index');
