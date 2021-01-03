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

Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});

/***********************************************************
******** PROS - ROUTES *************************************
***********************************************************/
Route::get('dashboard', 'JobController@dashboard')->middleware('auth');
Route::get('dashboard/{month}/overview', 'JobController@overview')->name('overview')->middleware('auth');
Route::get('jobUpcoming/{id}', 'JobController@coming')->middleware('auth');
Route::post('jobUpcoming/{id}/confirmation', 'JobController@confirm')->name('job.confirmation')->middleware('auth');
Route::get('jobToday/{id}', 'JobController@today')->middleware('auth');
Route::put('jobToday/{id}','JobController@CheckIn')->middleware('auth');
Route::get('jobToday/{id}/calculator','JobController@calculator')->name('job.calculator')->middleware('auth');
Route::post('jobToday/{id}/calculator','JobController@result')->middleware('auth');
Route::post('jobToday/{id}/calculator/upload','JobController@upload')->name('job.upload')->middleware('auth');
Route::post('jobToday/{id}/uploadPhoto','JobController@uploadPhoto')->name('job.photo')->middleware('auth');
Route::put('jobToday/{id}/issue','JobController@issue')->name('job.issue')->middleware('auth');
Route::put('jobToday/{id}/checklist','JobController@checklist')->name('job.checklist')->middleware('auth');
Route::get('jobs', 'JobController@jobs')->middleware('auth');
Route::get('jobdetails/{id}', 'JobController@job')->middleware('auth');
Route::resource('myAccount', 'MyAccountController')->middleware('auth');
Route::resource('jobReplacement', 'JobReplacementController')->middleware('auth');
Route::get('jobReplacement/{id}/status', 'JobReplacementController@status')->middleware('auth');

/***********************************************************
******** ADMIN ROUTES **************************************
***********************************************************/


Route::get('admin', 'AdminHomeController@index')->middleware('auth');
Route::post('admin/reminder', 'AdminHomeController@reminder')->name('home.reminder')->middleware('auth');

// Customers
Route::get('admin/customers/search', 'CustomerController@index')->name('customers.index')->middleware('auth');
Route::resource('admin/customers', 'CustomerController')->middleware('auth');


// Replacements
Route::resource('admin/replacements', 'ReplacementController')->middleware('auth');

// Users
Route::resource('admin/users', 'UserController')->middleware('auth');

// Orders
Route::get('admin/orders/search', 'OrderController@index')->name('orders.index')->middleware('auth');
Route::resource('admin/orders', 'OrderController')->middleware('auth');
Route::get('admin/orders/{id}/payment', 'OrderController@payment')->name('orders.payment')->middleware('auth');
Route::post('admin/orders/{id}/payment', 'OrderController@processPayment')->name('orders.processPayment')->middleware('auth');


//Order - Revenue
Route::post('admin/orders/{id}/revenue/create', 'OrderRevenueController@store')->name('revenue.store')->middleware('auth');
Route::delete('admin/orders/{orderId}/revenue/{revenueId}/delete', 'OrderRevenueController@destroy')->name('revenue.destroy')->middleware('auth');

// Order - Resources
Route::post('admin/orders/{id}/edit', 'OrderResourceController@store')->name('resource.store')->middleware('auth');
Route::delete('admin/orders/{id}/delete', 'OrderResourceController@destroy')->name('resource.destroy')->middleware('auth');
Route::get('admin/orders/{orderId}/resource/{resourceId}/edit', 'OrderResourceController@edit')->name('resource.edit')->middleware('auth');
Route::post('admin/orders/{orderId}/resource/{resourceId}/update', 'OrderResourceController@update')->name('resource.update')->middleware('auth');

// Order - Equipment
Route::post('admin/orders/{id}/equipment/store', 'OrderEquipmentController@store')->name('equipment.store')->middleware('auth');
Route::delete('admin/orders/{id}/equipment/delete', 'OrderEquipmentController@destroy')->name('equipment.destroy')->middleware('auth');


// Order - Files
Route::post('admin/orders/{id}/file/store', 'OrderFilesController@store')->name('file.store')->middleware('auth');
Route::delete('admin/orders/{id}/file/delete', 'OrderFilesController@destroy')->name('file.destroy')->middleware('auth');

// Order - Addresses
Route::get('admin/orders/{orderId}/address/create', 'AddressController@create')->name('address.create')->middleware('auth');
Route::post('admin/orders/{orderId}/address/store', 'AddressController@store')->name('address.store')->middleware('auth');
Route::get('admin/orders/{orderId}/address/{addressId}/edit', 'AddressController@edit')->name('address.edit')->middleware('auth');
Route::post('admin/orders/{orderId}/address/{addressId}/update', 'AddressController@update')->name('address.update')->middleware('auth');
Route::delete('admin/orders/{id}/address/{addressId}/delete', 'AddressController@destroy')->name('address.destroy')->middleware('auth');

// Orders - Booking
Route::post('admin/booking/day', 'BookingController@index')->name('booking.day')->middleware('auth');
Route::resource('admin/booking', 'BookingController')->middleware('auth');

// Resources
Route::resource('admin/resources', 'ResourceController')->middleware('auth');

// Equipments
Route::resource('admin/equipments', 'EquipmentController')->middleware('auth');

// Expenses (Revenue)
Route::resource('admin/expenses', 'ExpensesController')->middleware('auth');

// Services
Route::resource('admin/services', 'ServiceController')->middleware('auth');


// Reports
Route::get('admin/reports', 'ReportsController@index')->middleware('auth');
Route::get('admin/reports/earningsByOrder', 'ReportsController@earningsByOrder')->name('reports.earningsByOrder')->middleware('auth');
Route::post('admin/reports/earningsByOrder', 'ReportsController@earningsByOrder')->name('reports.earningsByOrder')->middleware('auth');
Route::get('admin/reports/accountingGroups', 'ReportsController@accountingGroups')->name('reports.accountingGroups')->middleware('auth');
Route::post('admin/reports/accountingGroups', 'ReportsController@accountingGroups')->name('reports.accountingGroups')->middleware('auth');
Route::get('admin/reports/ordersBySource', 'ReportsController@ordersBySource')->name('reports.ordersBySource')->middleware('auth');
Route::post('admin/reports/ordersBySource', 'ReportsController@ordersBySource')->name('reports.ordersBySource')->middleware('auth');
Route::get('admin/reports/paymentByResource', 'ReportsController@paymentByResource')->name('reports.paymentByResource')->middleware('auth');
Route::post('admin/reports/paymentByResource', 'ReportsController@paymentByResource')->name('reports.paymentByResource')->middleware('auth');

// Reviews
Route::get('admin/reviews', 'OrderReviewController@index')->middleware('auth');
Route::get('admin/reviews/{orderId}/create', 'OrderReviewController@create')->name('reviews.create')->middleware('auth');
Route::post('admin/reviews/{orderId}/store', 'OrderReviewController@store')->name('reviews.store')->middleware('auth');
Route::get('admin/reviews/{id}/edit', 'OrderReviewController@edit')->name('reviews.edit')->middleware('auth');
Route::post('admin/reviews/{id}/update', 'OrderReviewController@update')->name('reviews.update')->middleware('auth');
Route::delete('admin/reviews/{id}/delete', 'OrderReviewController@destroy')->name('reviews.destroy')->middleware('auth');

/***********************************************************
******** TASKS *********************************************
***********************************************************/
Route::get('admin/tasks/prosReminders', 'TaskController@prosReminders');
Route::get('admin/tasks/customerReminders', 'TaskController@customerReminders');

/***********************************************************
********** PWA *********************************************
**********************************************************
Route::group(['as' => 'laravelpwa.'], function()
{
    Route::get('/manifest.json', 'LaravelPWAController@manifestJson')->name('manifest');
    Route::get('/offline/', 'LaravelPWAController@offline');
});
*/