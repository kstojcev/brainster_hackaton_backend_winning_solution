<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard.projects');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/projects',                   [ProjectController::class, 'index'])->name('dashboard.projects');
    Route::post('/dashboard/projects/add',              [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/dashboard/projects/edit/{id}',         [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/dashboard/projects/update/{id}',      [ProjectController::class, 'update'])->name('projects.update');
    Route::get('/dashboard/project/{project}',          [ProjectController::class, 'show'])->name('projects.show');


    Route::get('/dashboard/services',                   [ServiceController::class, 'index'])->name('dashboard.services');
    Route::post('/dashboard/services/add',              [ServiceController::class, 'store'])->name('dashboard.services.add');
    Route::get('/dashboard/services/{service}/edit',    [ServiceController::class, 'edit'])->name('dashboard.services.edit');
    Route::put('/dashboard/services/{service}',         [ServiceController::class, 'update'])->name('dashboard.services.update');

    Route::get('/dashboard/news',                       [NewsController::class, 'index'])->name('dashboard.news');
    Route::post('/dashboard/news',                      [NewsController::class, 'store'])->name('news.store');
    Route::get('/dashboard/news/{news}/edit',           [NewsController::class, 'edit'])->name('news.edit');
    Route::post('/dashboard/news/{id}',                 [NewsController::class, 'update'])->name('news.update');

    Route::get('/dashboard/inquiries',                  [InquiryController::class, 'index'])->name('dashboard.inquiries');
    Route::get('/dashboard/inquiries/download/{id}',    [InquiryController::class, 'download'])->name('inquiry.download');
});

require __DIR__ . '/auth.php';
