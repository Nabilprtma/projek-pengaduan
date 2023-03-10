<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ResponseController;

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

Route::get('/', [WargaController::class, 'landing'])->name('home');
Route::get('/login', [WargaController::class, 'login'])->name('login');
Route::post('/auth', [WargaController::class, 'auth'])->name('auth');
Route::post('/kirim-data',[WargaController::class, 'store'])->name('kirim_data');
Route::get('/tambah-data', [WargaController::class, 'create']);

Route::middleware('IsLogin','CekRole:petugas')->group(function() {

Route::get('/data/petugas', [WargaController::class, 'dataPetugas'])->name('data.petugas');
Route::get('/response/{warga_id}', [ResponseController::class, 'edit'])->name('response.edit');
Route::patch('/response/update/{warga_id}', [ResponseController::class, 'update'])->name('response.update');
});

Route::middleware('IsLogin','CekRole:admin,petugas')->group(function() {
    Route::get('/logout', [WargaController::class, 'logout'])->name('logout');

});

Route::middleware('IsLogin','CekRole:admin')->group(function() {
Route::delete('/hapus/{id}', [WargaController::class, 'destroy'])->name('delete');
Route::get('/dashboard', [WargaController::class, 'index'])->name('dashboard');
Route::get('/export/pdf', [WargaController::class, 'exportPDF'])->name('export-pdf');
Route::get('/export/pdf/{id}', [WargaController::class, 'createPDF'])->name('export');
Route::get('/export/excel', [WargaController::class, 'exportExcel'])->name('export-excel');

});
