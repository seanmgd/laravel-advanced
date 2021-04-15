<?php

use App\Facades\Postcard;
use App\Services\PostcardSendingService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;

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
    return view('welcome');
});

//
// Facades
Route::get('/postcards', function () {
    $postcardService = new PostcardSendingService('fra', 4, 6);
    $postcardService->hello('Hello from Paris', 'test@test.fr');
});

Route::get('/facades', function () {
    Postcard::hello('Hello from Paris with Facades', 'facades@test.fr');
});

//
// View Composer
Route::get('/channels', 'ChannelController@index');
Route::get('/posts/create', 'PostController@create');

//
// Pipelines
Route::get('/posts', 'PostController@index');
// Url example /posts?sort=desc&active=0&max_count=3&page=1

//
// Service Container
Route::get('/pay', 'PayOrderController@store');

//
// Macros
Route::get('/macro', function () {
    return Str::partNumber(12345) . ' ' . Str::prefix(1234, 'prefix');
    return Response::errorJson(); // Custom macro create on AppServiceProvider.php
});

//
// Repository Pattern
Route::get('/customers', 'CustomerController@index');
Route::get('/customer/{customerId}', 'CustomerController@show');
Route::get('/customer/{customerId}/update', 'CustomerController@update');
Route::get('/customer/{customerId}/delete', 'CustomerController@destroy');

//
// Lazy Collection and Php generator
Route::get('lazy', function () {
//    $collection = Collection::times(3000000) // Will fail
//        ->map(function ($number) {
//            return pow(2, $number);
//        })
//        ->all();

    $collection = LazyCollection::times(3000000) // Will not fail
    ->map(function ($number) {
        return pow(2, $number);
    })
        ->all();
    // TIPS: If your want use ::all() static method for Lazy Collection, use ::cursor() instead
    // Eg: User::cursor();

    return 'success!';
});

Route::get('/generator', function () {
    function itWillCrash($number)
    {
        $actions = [];

        for ($i = 1; $i < $number; $i++) {
            $actions[] = $i;
        }

        return $actions;
    }

    function itWillNotCrash($number)
    {
        for ($i = 1; $i < $number; $i++) { // It is completely the same for the LazyCollection
            yield $i; // Yield is like return but used for generators
        }
    }

    // return get_class_methods(itWillNotCrash(1)); // To know which methods generator have

    foreach (itWillNotCrash(10000000) as $number) { // Switch function to watch with/without yield generator
        if ($number % 1000 == 0) {
            dump("crash test");
        };
    };
});
