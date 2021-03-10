<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaveController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ItemSearchController;
use App\Http\Controllers\CustomerSearchController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customsearch', [CustomerSearchController::class, 'index'])->name('customsearch.index');
Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');

// flutterwave payment route
Route::get('/payment', [RaveController::class, 'formIndex'])->name('payment');
Route::post('/pay', [RaveController::class, 'initialize'])->name('pay');
Route::get('/rave/callback', [RaveController::class, 'callback'])->name('callback');