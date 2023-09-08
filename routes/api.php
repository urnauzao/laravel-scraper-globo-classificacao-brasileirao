<?php

use App\Http\Controllers\Api\Globo\Brasileirao\BrasileiraoSerieAController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::prefix('/globo')->group(function () {
    Route::get('/brasileirao/serie-a', [BrasileiraoSerieAController::class, 'getClassificacao']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
