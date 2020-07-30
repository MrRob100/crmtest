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
    return redirect('home');
});

Auth::routes();

//sort out naming
Route::get('/home', 'CompaniesController@index')->name('home');
Route::get('/home/employees', 'EmployeesController@index')->name('home.employees');



//sport out if resource works
//Route::get('/create', 'CompaniesController@create')->name('create'); //test
//

//companies
Route::post('/store', 'CompaniesController@store')->name('companies.store');
Route::post('/update/{company}', 'CompaniesController@update')->name('companies.update');
Route::get('/destroy/{company}', 'CompaniesController@destroy')->name('companies.destroy');


//Route::resource('companies', 'CompaniesController');



Route::resource('Employees', 'EmployeesController');