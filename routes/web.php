<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return redirect()->route('obat.eloquent'); // Default route
});

// Obat Routes
Route::prefix('obat')->name('obat.')->group(function () {
    Route::get('/eloquent', [ObatController::class, 'indexEloquent'])->name('eloquent');
    Route::post('/eloquent', [ObatController::class, 'storeEloquent'])->name('store.eloquent');
    Route::put('/eloquent/{id}', [ObatController::class, 'updateEloquent'])->name('update.eloquent');
    Route::delete('/eloquent/{id}', [ObatController::class, 'destroyEloquent'])->name('destroy.eloquent');

    Route::get('/query-builder', [ObatController::class, 'indexQueryBuilder'])->name('query_builder');
    Route::post('/query-builder', [ObatController::class, 'storeQueryBuilder'])->name('store.query_builder');
    Route::put('/query-builder/{id}', [ObatController::class, 'updateQueryBuilder'])->name('update.query_builder');
    Route::delete('/query-builder/{id}', [ObatController::class, 'destroyQueryBuilder'])->name('destroy.query_builder');
});

// Staff Routes
Route::prefix('staff')->name('staff.')->group(function () {
    Route::get('/eloquent', [StaffController::class, 'indexEloquent'])->name('eloquent');
    Route::post('/eloquent', [StaffController::class, 'storeEloquent'])->name('store.eloquent');
    Route::put('/eloquent/{id}', [StaffController::class, 'updateEloquent'])->name('update.eloquent');
    Route::delete('/eloquent/{id}', [StaffController::class, 'destroyEloquent'])->name('destroy.eloquent');

    Route::get('/query-builder', [StaffController::class, 'indexQueryBuilder'])->name('query_builder');
    Route::post('/query-builder', [StaffController::class, 'storeQueryBuilder'])->name('store.query_builder');
    Route::put('/query-builder/{id}', [StaffController::class, 'updateQueryBuilder'])->name('update.query_builder');
    Route::delete('/query-builder/{id}', [StaffController::class, 'destroyQueryBuilder'])->name('destroy.query_builder');
});

// Supplier Routes
Route::prefix('supplier')->name('supplier.')->group(function () {
    Route::get('/eloquent', [SupplierController::class, 'indexEloquent'])->name('eloquent');
    Route::post('/eloquent', [SupplierController::class, 'storeEloquent'])->name('store.eloquent');
    Route::put('/eloquent/{id}', [SupplierController::class, 'updateEloquent'])->name('update.eloquent');
    Route::delete('/eloquent/{id}', [SupplierController::class, 'destroyEloquent'])->name('destroy.eloquent');

    Route::get('/query-builder', [SupplierController::class, 'indexQueryBuilder'])->name('query_builder');
    Route::post('/query-builder', [SupplierController::class, 'storeQueryBuilder'])->name('store.query_builder');
    Route::put('/query-builder/{id}', [SupplierController::class, 'updateQueryBuilder'])->name('update.query_builder');
    Route::delete('/query-builder/{id}', [SupplierController::class, 'destroyQueryBuilder'])->name('destroy.query_builder');
});
