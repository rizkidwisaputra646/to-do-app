<?php

use App\Http\Controllers\TugasController;
use Illuminate\Console\View\Components\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', [TugasController::class, 'index'])->name('tugas.index');
Route::post('/tugas', [TugasController::class, 'store'])->name('tugas.store');
Route::put('/tugas/{tugas}', [TugasController::class, 'update'])->name('tugas.update');
Route::delete('/tugas/{tugas}', [TugasController::class, 'destroy'])->name('tugas.destroy');