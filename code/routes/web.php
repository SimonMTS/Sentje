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
    Route::get('/profile/{id}', 'HomeController@profile');
    Route::post('/profile/{id}', 'HomeController@profilePOST');

    Auth::routes();

// bank accounts CRUD
Route::get('/accounts', 'AccountsController@index');
    Route::get('/accounts/add', 'AccountsController@add');
    Route::post('/accounts/add', 'AccountsController@addPOST');

    Route::get('/accounts/edit/{id}', 'AccountsController@edit');
    Route::post('/accounts/edit/{id}', 'AccountsController@editPOST');
    
    Route::post('/accounts/delete/{id}', 'AccountsController@destroy');

// payment
Route::get('/payment', 'PaymentController@index');
    Route::post('/payment', 'PaymentController@addPOST');
    Route::get('/pay/{id}', 'PaymentController@receivePayment');
    Route::get('/paysetup/{id}', 'PaymentController@setupPayment');
    Route::get('/paycomplete/{id}', 'PaymentController@completePayment');

// not loggedin homepage
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');