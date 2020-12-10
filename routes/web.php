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

// Topページ
Route::get('/', 'PostsController@index')->name('posts.get');  // 上書き

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


Route::group(['middleware' => ['auth']], function (){
  Route::group(['prefix' => 'users/{id}'], function () {
    Route::post('follow', 'UserFollowController@store')->name('user.follow');
    Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
    Route::get('followings', 'UsersController@followings')->name('users.followings');
    Route::get('followers', 'UsersController@followers')->name('users.followers');
    Route::get('posts', 'UsersController@show')->name('users.posts');
    Route::get('favorites', 'UsersController@favorites')->name('user.favorites');
    Route::patch('show', 'UsersController@update')->name('users.update');
    Route::get('edit', 'UsersController@getEdit')->name('users.edit');
  });
  
  Route::get('posts.posting', 'PostsController@posting')->name('posts.posting');
  
  // フィラリア予防投薬スケジュールのためのルート
  Route::group(['prefix' => 'medications/{medId}'], function () {
    //Route::post('/medications_show', function(Request $request){});
    Route::post('medications_show', 'FilariasisMedicationsController@store')->name('medications.store');
    Route::get('medications_show', 'FilariasisMedicationsController@show')->name('medications.show');
    Route::get('edit', 'FilariasisMedicationsController@edit')->name('medications.edit');
    Route::post('medications_show', 'FilariasisMedicationsController@administered')->name('medications.administered');
    Route::patch('medications_show', 'FilariasisMedicationsController@update')->name('medications.update');
  });
    Route::resource('medications', 'FilariasisMedicationsController', ['only' => ['store', 'update']]);
  Route::get('medications.input', 'FilariasisMedicationsController@input')->name('medications.input');
  Route::get('medications.medications_show', 'FilariasisMedicationsController@show')->name('medications.show');

  
  Route::resource('users', 'UsersController', ['only' => ['index', 'create','show', 'store']]);
  
  Route::post('users.card', 'UsersController@storePhoto')->name('user.photo');
  Route::post('users.show', 'UsersController@storeAbout')->name('user.about');
  
  Route::group(['prefix' => 'posts/{id}'], function(){
    Route::post('favorite', 'PostFavoriteController@store')->name('post.favorite');
    Route::delete('unfavorite', 'PostFavoriteController@destroy')->name('post.unfavorite');
  });
  
  Route::resource('posts', 'PostsController', ['only' => ['store', 'destroy', 'show']]);
  

  
  
});
