<?php

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

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth:sanctum']);

Route::resource('company', 'App\Http\Controllers\CompanieController')->middleware(['auth:sanctum']);
Route::resource('employee', 'App\Http\Controllers\EmployeeController')->middleware(['auth:sanctum']);


Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
