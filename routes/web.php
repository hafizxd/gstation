<?php

use App\Http\Controllers\DeletedReasonController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [VideoController::class, 'index'])->name('video.index');
    Route::group(['prefix' => 'videos'], function() {
        Route::get('/mine', [VideoController::class, 'indexMine'])->name('video.mine');

        Route::get('/create', [VideoController::class, 'create'])->name('video.create');
        Route::post('/store', [VideoController::class, 'store'])->name('video.store');
        Route::get('/{id}', [VideoController::class, 'detail'])->name('video.detail');
        Route::get('/{id}/edit', [VideoController::class, 'edit'])->name('video.edit');
        Route::delete('/{id}/destroy', [VideoController::class, 'destroy'])->name('video.destroy');
        Route::delete('/{id}/destroy-by-admin', [VideoController::class, 'destroyByAdmin'])->name('video.destroy-by-admin');

        Route::post('/{id}/reply', [ReplyController::class, 'store'])->name('reply.store');
    });

    Route::group(['prefix' => 'reply'], function() {
        Route::delete('/{id}/destroy', [ReplyController::class, 'destroy'])->name('reply.destroy');
        Route::post('/{id}/nested-reply', [ReplyController::class, 'nestedStore'])->name('nested-reply.store');
    });

    Route::delete('nested-reply/{id}/delete', [ReplyController::class, 'nestedDestroy'])->name('nested-reply.destroy');

    Route::group(['prefix' => 'favorites'], function() {
        Route::get('/', [FavoriteController::class, 'index'])->name('favorite.index');
        Route::post('/toggle/{id}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    });

    Route::group(['prefix' => 'reasons'], function() {
        Route::get('/', [DeletedReasonController::class, 'index'])->name('deleted-reason.index');
    });

    Route::group(['prefix' => 'users'], function() {
        Route::get('/followings', [UserController::class, 'indexFollowing'])->name('user.following.index');
        Route::get('/{id}', [UserController::class, 'detail'])->name('user.detail');
        Route::post('/toggle-follow/{id}', [UserController::class, 'toggleFollow'])->name('user.toggle-follow');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password.edit');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

require __DIR__.'/auth.php';
