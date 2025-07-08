<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FestivalImageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;




// EventController（カレンダー系）
Route::controller(EventController::class)->middleware(['auth'])->group(function () {
    Route::get('/calendar', 'show')->name('calendar'); // カレンダー表示
    Route::post('/calendar/get', 'get')->name('calendar.get'); // イベント取得
    Route::post('/calendar/create', 'create')->name('calendar.create'); // イベント追加
    Route::put('/calendar/update', 'update')->name('calendar.update'); // イベント更新
    Route::delete('/calendar/delete', 'delete')->name('calendar.delete'); // 予定の削除


});
// FestivalImageController（投稿系）
Route::controller(FestivalImageController::class)->middleware(['auth'])->group(function () {
    Route::get('/', 'index')->name('index'); // 投稿一覧
    Route::get('/festival_images/create', 'create')->name('create'); // 作成画面
    Route::post('/festival_images', 'store')->name('store'); // 保存
    Route::get('/festival_images/{festivalImage}', 'show')->name('show'); // 詳細
    Route::get('/festival_images/{festivalImage}/edit', 'edit')->name('edit'); // 編集画面（必要なら）
    Route::put('/festival_images/{festivalImage}', 'update')->name('update'); // 更新
});



// プロフィール関連
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// カレンダーイベント作成
Route::middleware(['auth'])->group(function () {
    Route::post('/calendar/create', [EventController::class, 'create'])->name('calendar.create');
});

// Breezeの認証ルート（/login, /registerなど）
require __DIR__ . '/auth.php';
