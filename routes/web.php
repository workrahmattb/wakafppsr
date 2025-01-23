<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\DatawakifController;

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

Route::get('/', [DatawakifController::class, 'index']);

Route::get('/cc', function () {
    return view('cerdascermat');
});

Route::get('laporan', [PDFController::class, 'downloadpdf'])->name('laporan');
Route::get('kwitansi/{id}', [PDFController::class, 'wakifpdf'])->name('pdf');
