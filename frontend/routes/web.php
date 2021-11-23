<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login', [UserController::class, 'loginForm'])->name('user.login.form');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('/register', [UserController::class, 'registerForm'])->name('user.register.form');
Route::post('/register', [UserController::class, 'register'])->name('user.register');

Route::redirect('/', '/companies')->name('homepage');
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
Route::delete('/companies/{id}', [CompanyController::class, 'destroy'])->name('companies.destroy');
Route::get('/companies/{id}', [CompanyController::class, 'show'])->name('companies.show');
Route::put('/companies/{id}', [CompanyController::class, 'update'])->name('companies.update');
Route::get('/companies/{id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');

Route::get('/companies/{id}/customers', [CustomerController::class, 'createRelationsToCompanyCreate'])->name('companies.customers.index');
Route::get('/companies/{id}/customers/create', [CustomerController::class, 'createAndAttachToCompanyCreate'])->name('companies.customers.create');
Route::post('/companies/{id}/customers', [CustomerController::class, 'createAndAttachToCompanyStore'])->name('companies.customers.store');
Route::put('/companies/{id}/customers', [CustomerController::class, 'createRelationsToCompanyStore'])->name('companies.customers.update');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customers.show');
Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
