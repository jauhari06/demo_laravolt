<?php

use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;
use Laravolt\Form\Middleware\SelectDateTimeMiddleware;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\TopicController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'auth/login');

// Route::middleware(['auth', 'verified'])->group(fn () => Route::get('/home', Home::class)->name('home'));

include __DIR__.'/auth.php';
include __DIR__.'/my.php';

// Route::post('/media/store', [MediaController::class, 'store'])->name('media::store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', Home::class)->name('home');

    Route::resource('topics', TopicController::class)->except(['show']);
    Route::post('/news/{id}/flag', [NewsController::class, 'flag'])->name('news.flag');
    Route::post('/news/{id}/unflag', [NewsController::class, 'unflag'])->name('news.unflag');
    Route::post('news/{news}/approve', [NewsController::class, 'approve'])->name('news.approve');
});