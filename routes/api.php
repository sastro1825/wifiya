<?php

use App\Models\Invoice;
use App\Models\Warning;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/warnings/{user_id}', function ($user_id) {
    return Warning::where('user_id', $user_id)->get();
});

Route::get('/invoices/{user_id}', function ($user_id) {
    return Invoice::where('user_id', $user_id)->get();
});

Route::get('/users/search', [UserController::class, 'search']);