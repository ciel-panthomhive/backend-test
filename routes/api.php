<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TestController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('matrixs/{skip}/{take}', [TestController::class, 'get_list']);
Route::get('matrixs/{id}', [TestController::class, 'get']);
Route::post('matrixAdd', [TestController::class, 'create']);
Route::put('matrixUp/{id}', [TestController::class, 'update']);
Route::delete('matrixClean/{id}', [TestController::class, 'destroy']);
