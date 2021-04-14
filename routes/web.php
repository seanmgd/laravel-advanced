<?php

use App\Facades\Postcard;
use App\Services\PostcardSendingService;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
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

//
// Service Container
Route::get('/pay', 'PayOrderController@store');

//
// Macros
Route::get('/macro', function() {
    return Str::partNumber(12345) . ' ' . Str::prefix(1234, 'prefix');
    return Response::errorJson(); // Custom macro create on AppServiceProvider.php
});
