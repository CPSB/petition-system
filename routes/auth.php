<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application authencation. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// GET	    login	                    login	            App\Http\Controllers\Auth\LoginController@showLoginForm	                    web, guest
// POST	    login		                                    App\Http\Controllers\Auth\LoginController@login	                            web, guest
// POST	    logout	                    logout	            App\Http\Controllers\Auth\LoginController@logout	                        web
// GET	    register	                register	        App\Http\Controllers\Auth\RegisterController@showRegistrationForm	        web, guest
// POST	    register		                                App\Http\Controllers\Auth\RegisterController@register	web, guest
// GET	    password/reset	            password.request	App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm	    web, guest
// POST	    password/email	            password.email	    App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail	    web, guest
// GET	    password/reset/{token}	    password.reset	    App\Http\Controllers\Auth\ResetPasswordController@showResetForm	            web, guest
// POST	    password/reset		                            App\Http\Controllers\Auth\ResetPasswordController@reset	                    web, guest
// GET	    auth/{provider}	            social	            App\Http\Controllers\Auth\SocialAuthencation@redirectToProvider	            web
// GET	    auth/{provider}/callback	social.callback	    App\Http\Controllers\Auth\SocialAuthencation@handleProviderCallback	        web

Route::get('auth/{provider}', 'Auth\SocialAuthencation@redirectToProvider')->name('social');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthencation@handleProviderCallback')->name('social.callback');