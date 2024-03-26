<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

//testing++
Route::get('/test', [Controller::class, 'test'])->name('test');
Route::post('/check', [Controller::class, 'check'])->name('check');
//testing--

//MainController++
Route::get('/main/call-mobile-push', [MainController::class, 'callMobilePush'])->name('main.callMobilePush');
Route::get('/main/call-web-push', [MainController::class, 'callWebPush'])->name('main.callWebPush');

Route::post('/main/call-mass-push', [MainController::class, 'callMassPush'])->name('main.callMassPush');
//MainController--
