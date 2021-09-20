<?php

use App\Http\Controllers\Api\v1\ApiController;
use App\Http\Resources\Api\v1\AjaxController;
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

Route::post('/ajax/get_posts', [ApiController::class, 'getPosts']);
Route::post('/ajax/get_comments', [ApiController::class, 'getComments']);
Route::post('/ajax/clear_data_db', [ApiController::class, 'clearDataDb']);
Route::post('/ajax/search_text', [ApiController::class, 'searchText']);

