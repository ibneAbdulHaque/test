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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');

Route::group(['prefix' => 'employee', 'as' => 'employee.'], function ()
{
    Route::get('/', 'EmployeeController@index')->name('index');
    Route::post('/upazila-list', 'EmployeeController@upazilaList')->name('upazila.list');
    Route::post('/store', 'EmployeeController@store')->name('store');
    Route::post('/list', 'EmployeeController@employee_list')->name('list');
});

