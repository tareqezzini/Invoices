<?php

use App\Http\Controllers\invoices_Reports;
use App\Http\Controllers\InvoicesArchiveController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\InvoicesAttachmentsController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes([]);
Route::get('/home', 'HomeController@index')->name('home');

//main route Invoices
Route::resource('invoices' , 'InvoicesController');

//main route sections
Route::resource('sections' , 'SectionsController');
//Route Invoices Archive
Route::resource('archive' , 'InvoicesArchiveController');
// route get Products 
Route::get('/section/{id}' , 'InvoicesController@getProducts');

//main route products
Route::resource('products' , 'ProductsController');

//main route InvoiceAttachments
Route::resource('InvoiceAttachments', 'InvoicesAttachmentsController');


// route edit invoices Details
Route::get('/edit_invoice/{id}' , 'InvoicesController@edit');

// route edit payments show form
Route::get('/Status_show/{id}' , 'InvoicesController@show')->name('Status_show');

// route update payments 
Route::post('/Status_Update/{id}' , 'InvoicesController@status_update')->name('Status_Update');

// route edit invoices Details
Route::get('/InvoicesDetails/{id}' , 'InvoicesDetailsController@edit');

// route View file
Route::get('/View_file/{id_invoices}/{file_name}' , 'InvoicesDetailsController@open_file');

// route Download file
Route::get('/download/{id_invoices}/{file_name}' , 'InvoicesDetailsController@get_file');


// route delete file
Route::post('delete_file', 'InvoicesDetailsController@destroy')->name('delete_file');

//route invoice paid 
Route::get('Invoices_Paid' , 'InvoicesController@invoicesPaid');
//route invoice unpaid 
Route::get('invoices_unpaid' , 'InvoicesController@invoicesUnpaid');
//route invoice unpaid 
Route::get('invoices_partial' , 'InvoicesController@invoicesPartial');

// route Print Invoices
Route::get('Print_invoice/{id}' , 'InvoicesController@Print_invoice');

//Route Export Excel Invoices
Route::get('export_invoices','InvoicesController@export');
//Sptile packge route

Route::group(['middleware' => ['auth']], function() {
                Route::resource('roles','RoleController');
                //Route Users
                Route::resource('users','UserController');
            });

//Reports Route
Route::get('invoices_reports' , 'invoices_Reports@index');
Route::post('invoices_search', 'invoices_Reports@search_reports');
Route::get('customer_reports' , 'invoices_Reports@show');
Route::post('customer_search', 'invoices_Reports@search_customer');


//main Route
Route::get('/{page}', 'AdminController@index');