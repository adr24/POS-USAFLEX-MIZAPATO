<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Files\ImageController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Sale\SaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// VERTIFACION DE AUTENTICACION
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/auth/checkToken', [ AuthController::class, 'checkToken' ]);

    Route::post('/auth/logout', [ AuthController::class, 'logout']);
    
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{term}', [CategoryController::class, 'show']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    
    
    Route::apiResource('/products', ProductController::class)
        ->only(['index', 'show']);
    
    Route::apiResource('/sales', SaleController::class)
    ->only(['index','store', 'show']);
    // ->except(['update','destroy']);
    
    
    Route::post('/auth/register', [ AuthController::class, 'register']);
});

// VERTIFACION DE AUTENTICACION Y ROL DE ADMIN
Route::middleware(['auth:sanctum', 'role.admin'])->group(function (){
    Route::apiResource('/products', ProductController::class)
        ->only(['store', 'destroy', 'update']);

    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
    
});



Route::apiResource('/upload/image', ImageController::class)
    ->only(['store']);



Route::post('/auth/login', [ AuthController::class, 'login']);