<?php

use App\Http\Controllers\API\AuthAPI;
use Illuminate\Support\Facades\Route;

Route::get('/auth', [AuthAPI::class, 'getAuth']);
Route::post('/add-auth', [AuthAPI::class, 'postAuth']);
Route::post('/login-auth', [AuthAPI::class, 'loginAuth']);
