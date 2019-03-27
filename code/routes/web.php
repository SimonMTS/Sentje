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

// homepage & user profile
Route::get('/', 'HomeController@index');
    Route::get('/profile/{id}', 'HomeController@profile')->middleware('auth');
    Route::post('/profile/{id}', 'HomeController@profilePOST')->middleware('auth');

    Auth::routes();

// bank accounts CRUD
Route::get('/accounts', 'AccountsController@index')->middleware('auth');
    Route::get('/accounts/add', 'AccountsController@add')->middleware('auth');
    Route::post('/accounts/add', 'AccountsController@addPOST')->middleware('auth');

    Route::get('/accounts/edit/{id}', 'AccountsController@edit')->middleware('auth');
    Route::post('/accounts/edit/{id}', 'AccountsController@editPOST')->middleware('auth');
    
    Route::post('/accounts/delete/{id}', 'AccountsController@destroy')->middleware('auth');

// payment
Route::get('/payment', 'PaymentController@index')->middleware('auth');
    Route::post('/payment', 'PaymentController@addPOST')->middleware('auth');

    Route::get('/pay/{id}', 'PaymentController@receivePayment');
    Route::post('/paysetup/{id}', 'PaymentController@setupPayment');
    Route::get('/paycomplete/{id}', 'PaymentController@completePayment');

    Route::get('/paymentdone/{id}', 'PaymentController@paymentDone');

    Route::get('/payment/view/{id}', 'PaymentController@viewPaymentRequest')->middleware('auth');
    Route::post('/payment/delete/{id}', 'PaymentController@deletePaymentRequest')->middleware('auth');

// not loggedin homepage
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');