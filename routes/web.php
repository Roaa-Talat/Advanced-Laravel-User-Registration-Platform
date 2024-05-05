<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;

Route::get('/', function () {
    return view('index');
});

Route::post('/register', [MyController::class, 'register'])->name('user.register');
