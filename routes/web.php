<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyLogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //日報入力画面のルート
    Route::get('/daily_logs/create', [DailyLogController::class, 'create'])->name('daily_logs.create');
    //日報一覧画面のルート
    Route::get('/daily_logs', [DailyLogController::class, 'index'])->name('daily_logs.index');
    //日報保存のルート
    Route::post('/daily_logs', [DailyLogController::class, 'store'])->name('daily_logs.store');
    //日報編集画面の表示ルート
    Route::get('/daily_logs/{dailyLog}/edit',[DailyLogController::class,'edit'])->name('daily_logs.edit');
    //日報更新のルート
    Route::patch('/daily_logs/{dailyLog}',[DailyLogController::class,'update'])->name('daily_logs.update');
    //日報削除のルート
    Route::delete('/daily_logs/{dailyLog}',[DailyLogController::class,'destroy'])->name('daily_logs.destroy');

});

require __DIR__.'/auth.php';
