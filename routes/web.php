<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Homepage Route
Route::get('/test-db', function() {
    return [
        'database' => \DB::connection()->getDatabaseName(),
        'products' => \DB::table('products')->count(),
        'all_products' => \DB::table('products')->get()
    ];
});
// Product Resource Routes
Route::resource('products', ProductController::class);
