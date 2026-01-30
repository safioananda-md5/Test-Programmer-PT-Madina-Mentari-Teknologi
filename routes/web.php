<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('no-bootstrap.login'));
});

Route::group(['prefix' => '/no-bootstrap', 'as' => 'no-bootstrap.'], function () {
    Route::get('/login', [AuthController::class, 'NB_login'])->name('login');
    Route::post('/login', [AuthController::class, 'NB_login_post'])->name('post.login');
});

Route::group(['prefix' => '/bootstrap', 'as' => 'bootstrap.'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['login'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/add-employee', [EmployeeController::class, 'add'])->name('employee.add');
    Route::post('/store-employee', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/edit-employee/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('/update-employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/delete-employee', [EmployeeController::class, 'delete'])->name('employee.delete');
});
