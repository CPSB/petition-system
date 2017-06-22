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
Route::get('auth/{provider}', 'Auth\SocialAuthencation@redirectToProvider')->name('social');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthencation@handleProviderCallback')->name('social.callback');

Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@backend')->name('home');

Route::resource('contact', 'ContactController');
Route::resource('disclaimer', 'DisclaimerController');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/settings', 'AccountSettingsController@index')->name('settings.index');
    Route::post('/settings/info', 'AccountSettingsController@updateInfo')->name('settings.info');
    Route::post('/settings/password', 'AccountSettingsController@updateSecurity')->name('settings.security');

    Route::resource('backend/contact', 'ContactBackendController', ['names' => [
        'index'   => 'contact.backend.index',
        'show'    => 'contact.backend.show',
        'store'   => 'contact.backend.store',
        'destroy' => 'contact.backend.destroy'
    ]]);

    Route::get('/users/ban/{id}', 'UserController@block')->name('user.ban');
    Route::get('users/unban/{id}', 'UserController@unblock')->name('user.unban');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');

    Route::get('notifications/mark/{id}', 'NotificationsController@markOne')->name('notifications.mark');
    Route::get('notifications/read/all', 'NotificationsController@markAll')->name('notifications.all-read');
    Route::get('notifications/index', 'NotificationsController@index')->name('notifications.index');
});

/**
 * Application routes.
 *
 * Below you can fill in your application routes.
 */
