<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CountersController;
use App\Http\Controllers\OrgController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//testing++
Route::get('/', function () {
    return 'HI, BOY!';
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/my', function () {
    return view('my');
});

Route::get('test/info', function () {
    return phpinfo();
});

Route::get('test', [TestController::class, 'test'])->name('test.test');
//testing--
