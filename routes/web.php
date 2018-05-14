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

Route::get('/', function () {
    return Redirect::route('company.index');
});

Route::resource('company', 'CompanyController')
    ->middleware('auth');
Route::resource('employe', 'EmployeController')
    ->middleware('auth');

Auth::routes();

Route::match(['get','post'], 'register', function () {
    abort(403, "Registrations are disabled");
})->name('register');