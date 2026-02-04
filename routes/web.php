<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

// Root URL: redirect to dashboard so "/" does not return 404 (e.g. on Vercel)
Route::get('/', fn () => redirect()->route('dashboard'));

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('stocks', StockController::class);
Route::resource('sales', SaleController::class);

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/stock', [ReportController::class, 'stock'])->name('reports.stock');
Route::get('/reports/sale', [ReportController::class, 'sale'])->name('reports.sale');
