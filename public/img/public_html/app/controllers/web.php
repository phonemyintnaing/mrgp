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
    return view('welcome');
});

Route::get('/home1', 'HomeController@index')->name('home');

Auth::routes();

/*
Route::get('/create/patient','PatientController@create');

Route::post('/create/patient','PatientController@store');


Route::get('/patients', 'PatientController@index');



Route::get('/edit/patient/{id}','PatientController@edit');
Route::patch('/edit/patient/{id}','PatientController@update');

Route::delete('/delete/patient/{id}','PatientController@destroy');
*/

#After Angular 
Route::get('/home', function () {
    return view('app');
});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');







Route::group(['middleware' => ['web']], function () {
    Route::resource('items', 'ItemController');
});

Route::group(['middleware' => ['web']], function () {
    //Route::resource('patients', 'PatientsController');
    Route::get('/patients', 'PatientsController@index');
    Route::post('/create/patients','PatientsController@store');
    Route::get('/edit/patients/{id}','PatientsController@edit');
    Route::post('/patients/edit','PatientsController@update');
    Route::delete('/delete/patients/{id}','PatientsController@destroy');

});


// Templates
Route::group(array('prefix'=>'/templates/'),function(){
    Route::get('{template}', array( function($template)
    {
        $template = str_replace(".html","",$template);
        View::addExtension('html','php');
        return View::make('templates.'.$template);
    }));
});