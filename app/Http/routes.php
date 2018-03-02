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

  /*Get User friends*/
  Route::get('/{username}/friends', [
    'uses' => '\chatty\Http\controllers\FriendController@getFriends',
    'as' => 'user.friends'
  ]);

  /*Get Auth user friend Requests*/
  Route::get('/{username}/requests', [
    'uses' => '\chatty\Http\Controllers\FriendController@getFriendRequests',
    'as' => 'user.requests'
  ]);

  /*Add friend*/
  Route::get('friend/add/{username}', [
    'uses' => '\chatty\Http\Controllers\FriendController@addFriend',
    'as' => 'friend.add'
  ]);

  /*Igrore friend request*/
  Route::get('friend/ignore/{username}', [
    'uses' => '\chatty\Http\Controllers\FriendController@ignoreFriend',
    'as' => 'friend.ignore'
  ]);

  /*Accept friend request*/
  Route::get('friend/accept/{username}', [
    'uses' => '\chatty\Http\Controllers\FriendController@acceptFriend',
    'as' => 'friend.accept'
  ]);

  /*Delete a friend Request or unfriend a friend*/
  Route::get('friend/delete/{username}', [
    'uses' => '\chatty\Http\Controllers\FriendController@deleteFriend',
    'as' => 'friend.delete'
  ]);

});
