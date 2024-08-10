<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\InvoiceController;
use  App\Http\Controllers\SectionController;

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
    return view('auth.login');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/section/{id}', 'App\Http\Controllers\InvoiceController@getproducts');
Route::post('/Status_Update/{id}', 'App\Http\Controllers\InvoiceController@Status_Update')->name('Status_Update');
Route::get('/Status_show/{id}', 'App\Http\Controllers\InvoiceController@show')->name('Status_show');

Route::get('/Invoice_Paid', 'App\Http\Controllers\InvoiceController@invoice_paid');
Route::get('/Invoice_UnPaid', 'App\Http\Controllers\InvoiceController@invoice_unPaid');
Route::get('/Invoice_Partial', 'App\Http\Controllers\InvoiceController@invoice_Partial');
Route::get('/print_invoice/{id}', 'App\Http\Controllers\InvoiceController@print_invoice');
Route::get('/InvoicesDetails/{id}', 'App\Http\Controllers\InvoicesDetailsController@edit');
Route::get('invoice/export/', [InvoiceController::class, 'export']);
Route::get('download/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicesDetailsController@get_file');

Route::get('View_file/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicesDetailsController@open_file');

Route::post('delete_file', 'App\Http\Controllers\InvoicesDetailsController@destroy')->name('delete_file');

Route::resource('invoices','App\Http\Controllers\InvoiceController');

Route::resource('Archive','App\Http\Controllers\InvoiceArchiveController');
Route::resource('sections','App\Http\Controllers\SectionController');
Route::resource('products','App\Http\Controllers\ProductController');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Our resource routes
    Route::resource('roles', RoleController::class);
    Route::resource('users', 'App\Http\Controllers\UserController');

});




Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
