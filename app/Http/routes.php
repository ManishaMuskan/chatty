<?php
/*
|--------------------------------------------------------------------------
| Root
|--------------------------------------------------------------------------
*/
Route::get('/', [
  'uses' => '\chatty\Http\Controllers\HomeController@index',
  'as' => 'home'
]);

/*
|--------------------------------------------------------------------------
| Guest user Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['guest']], function () {
  /*Signup*/
  Route::get('/signup', [
    'uses' => '\chatty\Http\Controllers\AuthController@getSignup',
    'as' => 'auth.signup'
  ]);

  Route::post('/signup', [
    'uses' => '\chatty\Http\Controllers\AuthController@postSignup',
  ]);

/*Signin*/
  Route::get('/signin', [
    'uses' => '\chatty\Http\Controllers\AuthController@getSignin',
    'as' => 'auth.signin'
  ]);

  Route::post('/signin', [
    'uses' => '\chatty\Http\Controllers\AuthController@postSignin',
  ]);
});

/*
|--------------------------------------------------------------------------
| Authenticated user Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth','revalidate']], function () {
  /*Signout*/
  Route::get('/signout', [
    'uses' => '\chatty\Http\Controllers\AuthController@getSignout',
    'as' => 'auth.signout'
  ]);

  /*Search People*/
  Route::get('/search', [
    'uses' => '\chatty\Http\Controllers\SearchController@searchPeople',
    'as' => 'search.results'
  ]);

  /*Go to user Profile*/
  Route::get('/profile/{username}',[
    'uses' => '\chatty\Http\Controllers\ProfileController@getProfile',
    'as' => 'profile.user'
  ]);

  /*Update Profile*/
  Route::get('/profile/{username}/edit', [
    'uses' => '\chatty\Http\Controllers\ProfileController@editProfile',
    'as' => 'profile.edit'
  ]);

  Route::post('/profile/{username}/edit', [
    'uses' => '\chatty\Http\Controllers\ProfileController@updateProfile',
  ]);
});
