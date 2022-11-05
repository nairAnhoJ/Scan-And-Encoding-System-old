<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DocumentManagementController;
use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\FallbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TempFileController;
use App\Models\Account;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/login', [AccountController::class, 'login'])->name('login');
Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::post('/postlogin', [AccountController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function(){

    // ========================== D O C U M E N T - M A N A G E M E N T ========================== //

    // Upload Document
    Route::get('upload', [DocumentManagementController::class, 'uploadIndex'])->name('upload.index');
    Route::post('upload-store', [DocumentManagementController::class, 'uploadStore'])->name('upload.store');

    // Encode Document
    Route::get('encode', [DocumentManagementController::class, 'encodeIndex'])->name('encode.index');
    Route::post('encode-get-folder', [DocumentManagementController::class, 'encodeGetFolder'])->name('encode.getfolder');
    Route::post('encode-get-files', [DocumentManagementController::class, 'encodeGetFiles'])->name('encode.getfiles');
    Route::post('encode-get-form', [DocumentManagementController::class, 'encodeGetForm'])->name('encode.getform');
    Route::post('encode-store', [DocumentManagementController::class, 'encodeStore'])->name('encode.store');

    // Quality Check Document
    Route::get('quality-check', [DocumentManagementController::class, 'qualityCheckIndex'])->name('qc.index');
    Route::post('qc-get-folder', [DocumentManagementController::class, 'qcGetFolder'])->name('qc.getfolder');
    Route::post('qc-get-files', [DocumentManagementController::class, 'qcGetFiles'])->name('qc.getfiles');
    Route::post('qc-get-form', [DocumentManagementController::class, 'qcGetForm'])->name('qc.getform');
    Route::post('qc-store', [DocumentManagementController::class, 'qcStore'])->name('qc.store');

    // View Document
    Route::get('view', [DocumentManagementController::class, 'viewIndex'])->name('view.index');


    // ==================================== R E P O R T S ==================================== //

    Route::get('reports', [ReportController::class, 'index'])->name('report.index');




    // DROPZONE
    Route::post('/retrieve', [TempFileController::class, 'store'])->name('temp.store');
    Route::get('/clear', [TempFileController::class, 'clear'])->name('temp.clear');

});



Route::fallback(FallbackController::class);

