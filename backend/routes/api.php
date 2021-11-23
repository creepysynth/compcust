<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);

    Route::get('/companies', [CompanyController::class, 'index']);
    Route::post('/companies', [CompanyController::class, 'store']);
    Route::get('/companies/{id}', [CompanyController::class, 'show']);
    Route::put('/companies/{id}', [CompanyController::class, 'update']);
    Route::delete('/companies/{id}', [CompanyController::class, 'destroy']);
    Route::get('/customers/{id}/companies', [CompanyController::class, 'relatedToCustomer']);

    Route::get('/customers', [CustomerController::class, 'index']);
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers/{id}', [CustomerController::class, 'show']);
    Route::put('/customers/{id}', [CustomerController::class, 'update']);
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
    Route::get('/companies/{id}/customers', [CustomerController::class, 'relatedToCompany']);
    Route::get('/companies/{id}/customers/ids', [CustomerController::class, 'relatedToCompanyGetIDs']);
    Route::post('/companies/{id}/customers', [CustomerController::class, 'createAndAttachToCompany']);
    Route::put('/companies/{id}/customers', [CustomerController::class, 'attachToCompany']);
    Route::delete('/companies/{id}/customers', [CustomerController::class, 'detachFromCompany']);
});
