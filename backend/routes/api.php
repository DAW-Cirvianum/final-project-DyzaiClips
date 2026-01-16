<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductValueController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\PackController;
use App\Http\Controllers\Api\BoxController;
use App\Http\Controllers\Api\TransactionController;

/*

| Public authentication routes

*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*

| Authenticated user routes

*/

Route::middleware('auth:sanctum')->group(function () {

    /*
    | User session
     */
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    /*
    | Products (USER → read only)
     */
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);

    /*
    | Product values (prices / offers)
     */
    Route::apiResource('product-values', ProductValueController::class);

    /*
    | Cards
     */
    Route::apiResource('cards', CardController::class);

    /*
    | Packs
     */
    Route::apiResource('packs', PackController::class);

    /*
    | Boxes
     */
    Route::apiResource('boxes', BoxController::class);

    /*
    | Transactions (buy product)
     */
    Route::post('/transactions', [TransactionController::class, 'store']);

    /*
    | My purchases (USER)
     */
    Route::get('/my-transactions', [TransactionController::class, 'myTransactions']);
});

/*

| Admin routes

*/

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    /*
    | Admin test
     */
    Route::get('/admin/test', function () {
        return 'Admin access granted';
    });

    /*
    | Products (ADMIN → full CRUD)
     */
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    /*
    | (Aquí després afegirem Blade admin)
     */
});



