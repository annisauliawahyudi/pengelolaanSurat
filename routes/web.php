<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LetterTypeController;

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
Route::get('/error-permission', function() {
    return view('errors.permission');
})->name('error.permission');

Route::middleware('IsGuest')->group(function() {
    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::post('/', [UserController::class, 'login'])->name('login-auth');

});

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/error-permision', function() {
    return view('errors.permission');
})->name('eror.permision');


Route::get('/welcome', function () {
    return view('welcome'); 
});

Route::middleware(['IsLogin'])->group(function() {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});


Route::middleware(['IsLogin', 'IsStaff'])->group(function() {

    Route::prefix('/letterType')->name('letter_type.')->group(function() {
        Route::get('/', [LetterTypeController::class, 'index'])->name('index');
        Route::get('create', [LetterTypeController::class, 'create'])->name('create');
        Route::post('store', [LetterTypeController::class, 'store'])->name('store');
        Route::get('/{id}', [LetterTypeController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [LetterTypeController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [LetterTypeController::class,'destroy'])->name('destroy');
        Route::get('/search', [LetterTypeController::class, 'searchLetter'])->name('search');
        Route::get('/detail', [LetterTypeController::class, 'detail'])->name('detail');
        Route::get('/download/excel', [LetterTypeController::class, 'exportExcel'])->name('exportExcel');
    });

    Route::prefix('/staff')->name('staff.')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/search', [UserController::class, 'search'])->name('search');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/guru')->name('guru.')->group(function() {
        Route::get('/', [UserController::class, 'indexGuru'])->name('index');
        Route::get('/create', [UserController::class, 'createGuru'])->name('create');
        Route::post('/store', [UserController::class, 'storeGuru'])->name('store');
        Route::get('/{id}', [UserController::class, 'editGuru'])->name('edit');
        Route::patch('update/{id}', [UserController::class, 'search'])->name('update');
        Route::get('/search', [UserController::class, 'searchLetter'])->name('search');
        Route::delete('/{id}', [UserController::class, 'destroyGuru'])->name('destroy');
    });

    Route::prefix('/dataSurat')->name('letter.')->group(function() {
        Route::get('/', [LetterController::class, 'index'])->name('index');
        Route::get('/create', [LetterController::class, 'create'])->name('create');
        Route::post('/store', [LetterController::class, 'store'])->name('store');
        Route::delete('/{id}', [LetterController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [LetterController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [LetterController::class, 'update'])->name('update');
        Route::get('/search', [LetterController::class, 'search'])->name('search');
    });

});

Route::middleware(['IsLogin', 'IsGuru'])->group(function() {

    Route::prefix('/dataSurat')->name('letter.')->group(function() {
        Route::get('/', [LetterController::class, 'index'])->name('index');
        Route::get('/create', [LetterController::class, 'create'])->name('create');
        Route::post('/store', [LetterController::class, 'store'])->name('store');
        Route::delete('/{id}', [LetterController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [LetterController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [LetterController::class, 'update'])->name('update');
        Route::get('/search', [LetterController::class, 'search'])->name('search');
    });
});

Route::get('/', function() {
    return view('login');
});





















