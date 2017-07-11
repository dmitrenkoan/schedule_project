<?php
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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'CalendarController@index');

    Route::get('/services', 'ServicesController@index');

    Route::post('/services/new', 'ServicesController@add');

    Route::post('/services/update/{id}', 'ServicesController@update');

    Route::post('/services/update_form/{id}', 'ServicesController@update_form');

    Route::post('/services/delete/{id}', 'ServicesController@delete');

    Route::get('/schedule', 'ScheduleController@index');

    Route::get('/employees', 'StaffController@index');

    Route::post('/employees/update_form/{id}', 'StaffController@update_form');

    Route::post('/employees/update/{id}', 'StaffController@update');

    Route::post('/employees/new', 'StaffController@add');

    Route::post('/employees/delete/{id}', 'StaffController@delete');

    Route::post('/employees/inventory/add', 'StaffController@InventoryAdd');

    Route::get('/employees/inventory/show/{id}', 'StaffController@InventoryShow');

    Route::get('/calendar', 'CalendarController@index');

    Route::post('/calendar/add_form', 'CalendarController@addForm');

    Route::post('/calendar/event/add', 'CalendarController@addEvent');

    Route::post('/calendar/event/confirm_form/{id}', 'CalendarController@confirmFormEvent');

    Route::post('/calendar/event/confirm/{id}', 'CalendarController@confirmEvent');

    Route::post('/calendar/event/cancel_form/{id}', 'CalendarController@cancelFormEvent');

    Route::post('/calendar/event/cancel/{id}', 'CalendarController@cancelEvent');

    Route::get('/customers', 'ClientsController@index');

    Route::get('/inventory/products', 'InventaryProductsController@index');

    Route::post('/inventory/products/new', 'InventaryProductsController@add');

    Route::post('/inventory/products/update/{id}', 'InventaryProductsController@update');

    Route::post('/inventory/products/update_form/{id}', 'InventaryProductsController@update_form');

    Route::post('/inventory/issue_invantary_form/{id}', 'InventaryProductsController@issue_form');

    Route::post('/fast_search', 'SearchController@index');

    Route::get('/clients', 'ClientsController@index');

    Route::post('/clients/new', 'ClientsController@add');

    Route::get('/reports', 'ReportController@index');

    Route::get('/reports/staff', 'ReportController@staff');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');