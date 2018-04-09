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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


Route::get('/create/patient','PatientController@create');

Route::post('/create/patient','PatientController@store');


Route::get('/patients', 'PatientController@index');



Route::get('/edit/patient/{id}','PatientController@edit');
Route::patch('/edit/patient/{id}','PatientController@update');

Route::delete('/delete/patient/{id}','PatientController@destroy');



Route::get('/home1', function () {
    return view('app');
});


Route::group(['middleware' => ['web']], function () {
    Route::resource('items', 'ItemController');
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