<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PythonController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PDFController;
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

// Route untuk halaman utama
Route::get('/', [PageController::class, 'index'])->name('home');

// Route untuk halaman blog
Route::get('blog', [PageController::class, 'blog'])->name('blog');

// Route untuk menampilkan form upload dan menghitung LQ
// Route::get('/lq', [PythonController::class, 'showForm'])->name('upload.form');
// Route::post('/lq/calculate', [PythonController::class, 'calculateLQ'])->name('calculate.lq');
Route::get('/upload', [PythonController::class, 'showForm'])->name('upload-form');


// Route untuk menjalankan skrip Python
// Route::post('/run-python', [PythonController::class, 'runPythonScript'])->name('run.python');
Route::post('/run-python-script', [PythonController::class, 'runPythonScript'])->name('run-python-script');

Route::get('/download-pdf/{tableName}', [PythonController::class, 'downloadPDF'])->name('download-pdf');

