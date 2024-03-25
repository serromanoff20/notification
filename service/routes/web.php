<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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
Route::get('/main/test', [MainController::class, 'test'])->name('main.test');
Route::post('/main/check', [MainController::class, 'check'])->name('main.check');
//testing--

Route::get('/main/call-expo-push', [MainController::class, 'callExpoPush'])->name('main.callExpoPush');
Route::get('/main/call-firebase-push', [MainController::class, 'callFirebasePush'])->name('main.callFirebasePush');
