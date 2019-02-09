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
// Route::get('/', function () {
//     return 'Hello World';
// });
// Route::get('/', function () {
//     return view('welcome');
// });
Route::resource('/', 'LandingController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('boy', 'BoyController');
Route::resource('scorecard', 'ScorecardController');
Route::resource('hole', 'HoleController');
Route::resource('round', 'RoundController');
Route::resource('score', 'ScoreController');
Route::resource('shot', 'ShotController');
