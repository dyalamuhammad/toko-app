<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\KeluarController;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\ReportController;
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

    Route::get('/', [AppController::class, 'index'])->name('home');

    Route::get('/barang-masuk', [MasukController::class, 'index'])->name('barang-masuk');
    Route::post('/barang-masuk/in', [MasukController::class, 'in'])->name('in-barang');
    Route::post('/barang-masuk/add', [MasukController::class, 'add'])->name('add-barang');
    Route::get('/barang-masuk/{id}', [MasukController::class, 'softDelete']);
    
    Route::get('/barang-keluar', [KeluarController::class, 'index'])->name('barang-keluar');
    Route::post('/barang-keluar/out', [KeluarController::class, 'out'])->name('out-barang');
    Route::get('/barang-keluar/{id}', [KeluarController::class, 'softDelete']);

    Route::get('/report-stock', [ReportController::class, 'index'])->name('report-stock');
    Route::post('/report-stock/edit', [ReportController::class, 'edit'])->name('edit-barang');

    
