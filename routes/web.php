<?php

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\App;
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
    return view('welcome');
});

Route::get('/employees', 'EmployeeController@index')->name('employees.index');
Route::get('/employees/create', 'EmployeeController@create')->name('employees.create');
Route::post('/employees', 'EmployeeController@store')->name('employees.store');
Route::get('/employees/{id}', 'EmployeeController@show')->name('employees.show');
Route::delete('/employees/{id}', 'EmployeeController@destroy')->name('employees.destroy');
Route::get('/employees/{id}/edit', 'EmployeeController@edit')->name('employees.edit');
Route::patch('/employees/{id}/', 'EmployeeController@update')->name('employees.update');


Route::get('/companies', 'CompanyController@index')->name('companies.index');
Route::get('/companies/create', 'CompanyController@create')->name('companies.create');
Route::post('/companies', 'CompanyController@store')->name('companies.store');
Route::get('/companies/{id}', 'CompanyController@show')->name('companies.show');
Route::delete('/companies/{id}', 'CompanyController@destroy')->name('companies.destroy');
Route::get('/companies/{id}/edit', 'CompanyController@edit')->name('companies.edit');
Route::patch('/companies/{id}/', 'CompanyController@update')->name('companies.update');

Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('locale/{locale}', function ($locale){
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale.change');

