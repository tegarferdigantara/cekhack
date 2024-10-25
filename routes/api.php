<?php

use App\Http\Controllers\api\GoalController;
use App\Http\Controllers\api\IconController;
use App\Http\Controllers\api\KategoriController;
use App\Http\Controllers\api\ReminderController;
use App\Http\Controllers\api\TransaksiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\GeminiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/cek',[Controller::class, 'cek']);




//sigin
Route::post('signin', [UserController::class, 'store']);
Route::post('login', [UserController::class, 'login']);
Route::post('userdetail', [UserController::class, 'userdetail']);

//bulanan
Route::post('budget/store', [UserController::class, 'budgetStore']);


//transaksi
Route::post('transaksi/store', [TransaksiController::class, 'store']);
Route::post('transaksi/goal/store', [TransaksiController::class, 'storeGoal']);

//icon
Route::post('icon/store', [IconController::class, 'store']);





//reminder
Route::post('reminder/store', [ReminderController::class, 'store']);
Route::get('reminder/show/{id?}', [ReminderController::class, 'showList']);


//goal
Route::post('goal/store', [GoalController::class, 'store']);
Route::get('goal/show/{id?}', [GoalController::class, 'showList']);


//kategori
Route::post('kategori/store', [KategoriController::class, 'store']);
Route::get('kategori/show', [KategoriController::class, 'showList']);


//analisi
Route::post('/analisis/{id?}',[GeminiController::class, 'analisis']);



