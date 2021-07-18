<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api\V1')->prefix('v1')->name('api.v1.')->group(function () {
    Route::post('/register', 'AuthController@register')->name('register');
    Route::post('/login', 'AuthController@login')->name('login');
    Route::post('/reset-password', 'ResetPasswordController@sendMail');
    Route::put('/reset-password/{token}', 'ResetPasswordController@reset');
    Route::middleware(['auth:api'])->group(function () {
        Route::get('/profile', 'AuthController@getProfile')->name('profile');
        Route::post('/update-profile', 'AuthController@updateProfile')->name('update.profile');
        Route::post('change-password', 'AuthController@changePassword')->name('change.password');
        Route::post('/logout', 'AuthController@logout')->name('logout');

        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('/', 'UserController@index')->name('list');
            Route::post('/', 'UserController@store')->name('store');
            Route::get('/{user}/show', 'UserController@show')->name('show');
            Route::put('/{user}', 'UserController@update')->name('update');
            Route::delete('/{user}/delete', 'UserController@destroy')->name('destroy');
        });
    });
});
