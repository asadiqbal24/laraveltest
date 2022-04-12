<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;

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
    return redirect()->route('index');
});
Route::get('index', [ExcelController::class, 'index'])->name('index');
Route::post('importData', [ExcelController::class, 'importData'])->name('importData');
Route::get('exportData', [ExcelController::class, 'exportData'])->name('exportData');

Route::get('customer-data-delete/{id}', [ExcelController::class, 'customer_data_delete'])->name('customer-data-delete');


