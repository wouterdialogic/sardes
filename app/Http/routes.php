<?php

//use App\Http\Controllers\SchoolsController;
//use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('schools.index');
});

Route::get('/schools', function () {
    return view('schools.index');
});

Route::get('zoeken', 'Schools@index');
Route::get('sozoeken', 'Schools@soindex');

Route::get('/geavanceerd_zoeken', function () {
    return view('geavanceerd_zoeken.index');
});

Route::get('start', function () {
    return view('start.index');
});

Route::get('api/postcode/{postcode}', 'Postcodes@getCoordinatesOfPostcode');

Route::get('api/adres/{address}', 'Postcodes@getGoogleMapOfAddress');

Route::get('admin/provision', 'Admin@provision');

Route::get('api/googleMap/{postcode}', 'Postcodes@getGoogleMapOfPostcode');

Route::get('api/afstand/{postcode}', 'Postcodes@getSchoolsOfPostcode2');
Route::get('api/getSchoolsOfPostcode/{postcode}', 'Postcodes@getSchoolsOfPostcode');

Route::resource('schools', 'Schools');

Route::get('/', function () {
    return view('welcome');
});
