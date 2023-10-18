<?php

use App\Http\Controllers\Helpdesk\DepartmentController;
use App\Http\Controllers\Helpdesk\TicketController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['as' => 'api.', 'prefix' => 'api'], static function(){
    Route::group(['as' => 'helpdesk.', 'prefix' => 'helpdesk'], function(){
        Route::group(['as' => 'tickets.', 'prefix' => 'tickets'], static function () {
            Route::get('/', [TicketController::class, 'index'])->name('all');
            Route::post('/create', [TicketController::class, 'create'])->name('create');
            Route::get('/read', [TicketController::class, 'read'])->name('read');
            Route::post('/update', [TicketController::class, 'update'])->name('update');
            Route::delete('/delete', [TicketController::class, 'destroy'])->name('delete');
        });
        Route::group(['as' => 'departments.', 'prefix' => 'departments'], static function () {
            Route::get('/', [DepartmentController::class, 'index'])->name('all');
            Route::post('/create', [DepartmentController::class, 'create'])->name('create');
            Route::get('/read', [DepartmentController::class, 'read'])->name('read');
            Route::put('/update', [DepartmentController::class, 'update'])->name('update');
            Route::delete('/delete', [DepartmentController::class, 'destroy'])->name('delete');
        });
    });
    Route::group(['as' => 'users.', 'prefix' => 'users'], static function () {
        Route::get('/', [UserController::class, 'index'])->name('all');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::get('/read', [UserController::class, 'read'])->name('read');
        Route::put('/update', [UserController::class, 'update'])->name('update');
        Route::delete('/delete', [UserController::class, 'destroy'])->name('delete');
    });
});
