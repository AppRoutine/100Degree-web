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

Auth::routes();
Route::get('/','Auth\LoginController@showloginform');
Route::get('logout','Auth\LoginController@logout');
Route::get('register','Auth\LoginController@showloginform')->name('register');


Route::get('verifyemail/{id}','API\UserController@verifyemail');

Route::group(['middleware' => 'auth'], function () {

Route::get('dashboard', function () {
    return view('dashboard');
});

Route::get('majors','UserController@majors');
Route::post('update_major','UserController@update_major')->name('update_major');
Route::post('submit_major','UserController@submit_major')->name('submit_major');
Route::post('delete_major','UserController@delete_major')->name('delete_major');

Route::get('universities','UserController@universities');
Route::post('update_universities','UserController@update_universities')->name('update_universities');
Route::post('submit_universities','UserController@submit_universities')->name('submit_universities');
Route::post('delete_universities','UserController@delete_universities')->name('delete_universities');

Route::get('community','UserController@community');
Route::post('delete_community','UserController@delete_community')->name('delete_community');

Route::get('edit_community/{id}','UserController@edit_community')->name('edit_community');

Route::post('update_community','UserController@update_community')->name('update_community');

Route::get('add_community','UserController@add_community')->name('add_community');

Route::post('submit_community','UserController@submit_community')->name('submit_community');


Route::get('sports','UserController@sports');
Route::post('delete_sport','UserController@delete_sport')->name('delete_sport');

Route::get('edit_sport/{id}','UserController@edit_sport')->name('edit_sport');

Route::post('update_sport','UserController@update_sport')->name('update_sport');

Route::get('add_sport','UserController@add_sport')->name('add_sport');

Route::post('submit_sport','UserController@submit_sport')->name('submit_sport');


Route::get('tutors','UserController@tutors');

Route::post('delete_tutor','UserController@delete_tutor')->name('delete_tutor');

Route::get('edit_tutor/{id}','UserController@edit_tutor')->name('edit_tutor');

Route::post('update_tutor','UserController@update_tutor')->name('update_tutor');

Route::get('add_tutor','UserController@add_tutor')->name('add_tutor');

Route::post('submit_tutor','UserController@submit_tutor')->name('submit_tutor');


Route::get('events','UserController@events');

Route::post('delete-event','UserController@delete_event')->name('delete-event');

Route::get('edit-event/{id}','UserController@edit_event')->name('edit-event');

Route::post('update-event','UserController@update_event')->name('update-event');

Route::get('add_event','UserController@add_event')->name('add_event');

Route::post('submit_event','UserController@submit_event')->name('submit_event');
});

