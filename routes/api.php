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

        Route::group([], function() {
            Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
                Route::get('/', 'UserController@index')->name('list');
                Route::post('/', 'UserController@store')->name('store');
                Route::get('/{user}/show', 'UserController@show')->name('show');
                Route::put('/{user}', 'UserController@update')->name('update');
                Route::delete('/{user}/delete', 'UserController@destroy')->name('destroy');
            });

            Route::group(['prefix' => 'department', 'as' => 'department.'], function () {
                Route::get('/', 'DepartmentController@index')->name('list');
                Route::post('/', 'DepartmentController@store')->name('store');
                Route::put('/{department}', 'DepartmentController@update')->name('update');
                Route::get('/{department}/show', 'DepartmentController@show')->name('show');
                Route::delete('/{department}/delete', 'DepartmentController@destroy')->name('destroy');
            });
            Route::group(['prefix' => 'project-info', 'as' => 'project.'], function () {
                Route::get('/', 'ProjectInfoController@index')->name('list');
                Route::post('/', 'ProjectInfoController@store')->name('store');
                Route::put('/{project}', 'ProjectInfoController@update')->name('update');
                Route::get('/{project}/show', 'ProjectInfoController@show')->name('show');
                Route::delete('/{project}/delete', 'ProjectInfoController@destroy')->name('destroy');
            });
            Route::group(['prefix' => 'team-project', 'as' => 'team_project.'], function () {
                Route::get('/', 'TeamProjectController@index')->name('list');
                Route::post('/', 'TeamProjectController@store')->name('store');
                Route::put('/{project}', 'TeamProjectController@update')->name('update');
                Route::get('/{project}/show', 'TeamProjectController@show')->name('show');
                Route::delete('/{project}/delete', 'TeamProjectController@destroy')->name('destroy');
            });
            Route::group(['prefix' => 'user-team-project', 'as' => 'user_team_project.'], function () {
                Route::get('/', 'UserTeamProjectController@index')->name('list');
                Route::post('/', 'UserTeamProjectController@store')->name('store');
                Route::put('/{user_team_project}', 'UserTeamProjectController@update')->name('update');
                Route::get('/{user_team_project}/show', 'UserTeamProjectController@show')->name('show');
                Route::delete('/{user_team_project}/delete', 'UserTeamProjectController@destroy')->name('destroy');
            });
        });
    });
});
