<?php

use App\Http\Controllers\approverController;
use App\Http\Controllers\PenugasanPICController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UjianController;
use App\Models\Ujian;
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

Route::get("/", [\App\Http\Controllers\AuthController::class, "signIn"]);
Route::get('/dashboard', \App\Http\Controllers\DashboardController::class);

Route::prefix('/ujian')->group(function () {
    Route::get('/', [UjianController::class, 'index'])->name('pages.indexUjian');
    Route::post('/', [UjianController::class, 'store'])->name('pages.storeUjian');
    Route::get('/detail/{id}', [UjianController::class, 'show'])->name('pages.showUjian');
    Route::put('/{id}', [UjianController::class, 'update'])->name('pages.updateUjian');
    Route::delete('/{id}', [UjianController::class, 'destroy'])->name('pages.destroyUjian');
});

Route::prefix('/penugasan')->group(function () {
    Route::get('/', [PenugasanPICController::class, 'index'])->name('pages.indexPenugasan');
    Route::post('/', [PenugasanPICController::class, 'store'])->name('pages.storePenugasan');
    Route::get('/detail/{id}', [PenugasanPICController::class, 'show'])->name('pages.showPenugasan');
    Route::put('/{id}', [PenugasanPICController::class, 'update'])->name('pages.updatePenugasan');
    Route::delete('/{id}', [PenugasanPICController::class, 'destroy'])->name('pages.destroyPenugasan');
});

Route::prefix('/pertanyaan')->group(function () {
    Route::get('/', [QuestionController::class, 'index'])->name('pages.indexPertanyaan');
    Route::post('/', [QuestionController::class, 'store'])->name('pages.storePertanyaan');
    Route::get('/detail/{id}', [QuestionController::class, 'show'])->name('pages.showPertanyaan');
    Route::post('/update', [QuestionController::class, 'update'])->name('pages.updatePertanyaan');
    Route::post('/delete', [QuestionController::class, 'destroy'])->name('pages.destroyPertanyaan');
    Route::post('/bulk-update-delete', [QuestionController::class, 'bulkUpdateAndDelete'])->name('pages.bulkUpdateAndDelete');
});

Route::prefix('/approver')->group(function () {
    Route::get('/', [approverController::class, 'index'])->name('pages.indexApprover');
    Route::post('/', [approverController::class, 'store'])->name('pages.storeApprover');
    Route::post('/approve', [ApproverController::class, 'approve'])->name('pages.approve');
    Route::post('/reject', [ApproverController::class, 'reject'])->name('pages.reject');
    Route::get('/detail/{id}', [approverController::class, 'show'])->name('pages.showApprover');
    Route::post('/update', [approverController::class, 'update'])->name('pages.updateApprover');
    Route::post('/delete', [approverController::class, 'destroy'])->name('pages.destroyApprover');
    
});


