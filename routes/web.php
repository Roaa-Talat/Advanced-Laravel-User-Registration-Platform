<?php

use App\Http\Controllers\LocalController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\MyController;

Route::get('/', function () {
    return view('index');
})->name('home'); // Define the home route and name it 'home'


Route::get('{lang}', [LocalController::class, 'setLocale']);

Route::post('/register', [MyController::class, 'register'])->name('user.register');
