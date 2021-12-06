<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::
//middleware('auth:sanctum')->
get('/capsules', [\App\Http\Controllers\Api\v1\CapsuleController::class, 'all_capsules'])->name('api.v1.all_capsules');

Route::
//middleware('auth:sanctum')->
get('/capsules/{capsule_serial}', [\App\Http\Controllers\Api\v1\CapsuleController::class, 'capsule_by_name'])->name('api.v1.capsule_by_name');
