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

// Auth with Laravel
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Auth with Facebook
Route::get('/redirect', [
  'as' => 'redirect',
  'uses' => 'SocialAuthController@redirect'
]);
Route::get('/callback', [
  'as' => 'callback',
  'uses' => 'SocialAuthController@callback'
]);

// Tweet posting & Timeline
Route::resource('/home/tweet/', 'TweetController');
Route::get('/home/tweet/{id}', 'TweetController@show');

// Users index and profiles
Route::get('/home/user/', 'UserProfileController@getAll');
Route::get('/home/user/{username}', 'UserProfileController@getOne');

// Follow & Unfollow Actions
Route::group(['middleware' => 'auth'], function () {
    Route::get('/follows/{username}', 'UserFollowController@follows');
    Route::get('/unfollows/{username}', 'UserFollowController@unfollows');
});
