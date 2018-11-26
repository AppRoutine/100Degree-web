<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signup','API\UserController@signup');
Route::post('login','API\UserController@login');
Route::get('majors','API\UserController@majors');
Route::get('universities','API\UserController@universities');
Route::get('community','API\UserController@community');
Route::post('profile','API\UserController@profile');
Route::get('events','API\UserController@events');
Route::get('tutors','API\UserController@tutors');
Route::get('musics','API\UserController@musics');
Route::post('edit_profile','API\UserController@edit_profile');
Route::get('sports','API\UserController@sports');
Route::post('forgot_password','API\UserController@forgot_password');
Route::post('activity_wall','API\UserController@activity_wall');
Route::get('activitywalls','API\UserController@activitywalls');
Route::Post('social_login','API\UserController@social_login');
