<?php

use App\Http\Controllers\ConsumptionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Models\Consumption;
use App\Models\Service;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Invoices');
})->middleware(['auth', 'verified'])->name('dashboard');


// #  Rutas Creadas por mi 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
//invoices
Route::post('invoices',[InvoiceController::class , 'store'] );
Route::patch('invoices', [InvoiceController::class, 'update'])->name('invoices.update');
Route::delete('invoices', [InvoiceController::class, 'destroy'])->name('invoices.delete');

Route::get('/invoices' , [InvoiceController::class , 'index'])->name('invoices');
Route::get('/invoices/create' , [InvoiceController::class , 'create'])->name('invoicesCreate');
Route::get('/invoices/edit/{id}' , [InvoiceController::class , 'edit'])->name('invoicesEdit');

##-----

// Services

Route::post('services',[ServiceController::class , 'store'] );
Route::patch('services', [ServiceController::class, 'update'])->name('services.update');
Route::delete('services', [ServiceController::class, 'destroy'])->name('services.delete');

Route::get('/services' , [ServiceController::class , 'index'])->name('services');
Route::get('/services/create' , [ServiceController::class , 'create'])->name('servicesCreate');
Route::get('/services/edit/{id}' , [ServiceController::class , 'edit'])->name('servicesEdit');
// # ---

// Consumptions
Route::get('/consumptions/{id}' , [ConsumptionController::class , 'index'])->name('consumptions');
});

require __DIR__.'/auth.php';
