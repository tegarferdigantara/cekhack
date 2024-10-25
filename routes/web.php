<?php

use App\Http\Controllers\view\TransaksiController;
use App\Http\Controllers\view\ReminderController;
use App\Http\Controllers\view\AccountController;
use App\Http\Controllers\view\GoalController;
use App\Http\Controllers\view\LaporanController;
use App\Http\Controllers\view\TransactionController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
        return view('pages.home');
    })->name('home');

    Route::get('/riwayat-transaksi/{id}', [TransactionController::class, 'showList'])->name('riwayat-transaksi');

    Route::get('/pemasukan', function () {
        return view('pages.income');
    })->name('pemasukan');

    Route::get('/pengeluaran', function () {
        return view('pages.outcome');
    })->name('pengeluaran');

    Route::get('/tujuan/{id}', [GoalController::class, 'showList'])->name('goal');

    Route::post('/logout', [AccountController::class, 'logout'])->name('logout.action');


    Route::get('/pengingat/{id}', [ReminderController::class, 'showList'])->name('reminder');

    Route::get('/laporan/{id}', [LaporanController::class, 'laporan'])->name('laporan');
});
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('pages.index');
    })->name('dashboard');
    Route::get('/tentang', function () {
        return view('pages.about');
    })->name('about');
    Route::get('/login', [AccountController::class, 'loginView'])->name('login.view');
    Route::post('/login', [AccountController::class, 'loginAction'])->name('login.action');
});
