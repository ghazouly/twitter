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
Route::get('/home/tweet/', 'TweetController@index');
Route::post('/home/tweet/', 'TweetController@store')->name('tweet.store');
Route::get('/home/tweet/{id}', 'TweetController@destroy')->name('tweet.destroy');

// Users index and profiles
Route::get('/home/user/', 'UserProfileController@getAll');

// User search request "by username"
Route::get('/home/user/search', 'UserProfileController@search');
Route::get('/home/user/{username}', 'UserProfileController@getOne')->name('user.show');

// Users' Follow & Unfollow Actions
Route::group(['middleware' => 'auth'], function () {
    Route::get('/follows/{username}', 'UserFollowController@follows');
    Route::get('/unfollows/{username}', 'UserFollowController@unfollows');
});

// Tweets Like & Unlike Actions
Route::group(['middleware' => 'auth'], function () {
    Route::get('/likes/{id}', 'UserLikeController@likes');
    Route::get('/unlikes/{id}', 'UserLikeController@unlikes');
});
