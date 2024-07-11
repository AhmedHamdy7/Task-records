<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExchangeManageController;
use App\Http\Controllers\RecordController;


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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/exchange-rates/add', [ExchangeManageController::class, 'create'])->name('exchange-rates.add');
    Route::get('/exchange-rates', [ExchangeManageController::class, 'index'])->name('exchange.index');
    Route::post('/exchange-rates/update/{currency}', [ExchangeManageController::class, 'update'])->name('exchange-rates.update');
    Route::post('/exchange-rates/delete/{currency}', [ExchangeManageController::class, 'delete'])->name('exchange-rates.delete');


    Route::get('/records', [RecordController::class, 'index'])->name('records.index');
    Route::post('/records', [RecordController::class, 'store'])->name('records.store');
    Route::get('/records/{id}/edit', [RecordController::class, 'edit'])->name('records.edit');
Route::put('/records/{id}', [RecordController::class, 'update'])->name('records.update');
Route::delete('/records/{id}', [RecordController::class, 'destroy'])->name('records.delete');

});




