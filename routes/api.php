<?php


// routes/api.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Middleware\ApiKeyMiddleware;
use App\Http\Controllers\AuthController;

Route::middleware([ApiKeyMiddleware::class])->group(function () {
    Route::get('/data', [ApiController::class, 'index']);
});

/*Route::middleware([ApiKeyMiddleware::class])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});*/
Route::post('/login', [AuthController::class, 'login']);
Route::get('/apikey', [ApiController::class, 'apikey']);


