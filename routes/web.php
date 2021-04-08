<?php

use App\Facades\Postcard;
use App\Services\PostcardSendingService;
use Illuminate\Support\Facades\Route;

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

Route::get('/postcards', function () {
    $postcardService = new PostcardSendingService('fra', 4, 6);
    $postcardService->hello('Hello from Paris', 'test@test.fr');
});

Route::get('/facades', function () {
    Postcard::hello('Hello from Paris with Facades', 'facades@test.fr');
});
