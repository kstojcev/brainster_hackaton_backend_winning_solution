<?php

use App\Http\Controllers\InquiryApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\NewsApiController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectApiController;
use App\Http\Controllers\ServiceApiController;

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
//routes for frontend fetch
Route::get('/news',                                 [NewsApiController::class, 'index']);
Route::get('/services',                             [ServiceApiController::class, 'index']);
Route::get('/projects',                             [ProjectApiController::class, 'index']);
Route::get('/project/{id}',                         [ProjectApiController::class, 'show']);

//route for inquiry form from frontend
Route::post('/inquiry/add',                         [InquiryApiController::class, 'store']);

//routes for deleting images and projects/news/inquiries
Route::delete('/dashboard/projects/delete/{id}',    [ProjectApiController::class, 'destroy']);
Route::delete('/images/delete/{id}',                [ProjectApiController::class, 'destroyImage']);
Route::delete('/inquiry/delete/{id}',               [InquiryApiController::class, 'destroy']);
Route::delete('/services/{service}',                [ServiceApiController::class, 'destroy']);
Route::delete('/dashboard/news/delete/{id}',        [NewsApiController::class, 'destroy']);

//routes for activating and deactivationg inquiries
Route::post('/inquiry/activate/{id}',               [InquiryApiController::class, 'activateInquiry']);
Route::post('/inquiry/deactivate/{id}',             [InquiryApiController::class, 'deactivateInquiry']);
