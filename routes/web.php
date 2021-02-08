<?php

use Illuminate\Support\Facades\Route;
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
Route::get('algolia_search/items-lists', [ItemSearchController::class,'index'])->name('items-lists');
Route::post('algolia_search/create-item', [ItemSearchController::class,'create'])->name('create-item');

