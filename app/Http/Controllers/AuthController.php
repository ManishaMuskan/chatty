<?php

namespace chatty\Http\Controllers;

use Auth;
use chatty\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Sign up
  |--------------------------------------------------------------------------
  */
  public function getSignup()
  {
    return view('auth.signup');
  }

  public function postSignup(Request $request )
  {
    $this -> validate($request, [
      'email' => 'required|unique:users|email',
      'username' => 'required|alpha_dash|max:30',
      'password' => 'required|min:6',
      'first_name' => 'required|max:50',
    ]);

    /*------In this all the attributes are specified------*/
    // User::create([
    //   'email' => $request->input('email'),
    //   'username' => $request->input('username'),
    //   'password' => bcrypt($request->input('password')),
    //   'first_name' => $request->input('first_name'),
    //   'last_name' => $request->input('last_name'),
    // ]);

     /*------In this password is hashed in the model itself------*/
    User::create($request->all());

    return redirect()
    ->route('auth.signin')
    ->with('info', 'your account has been successfully created, you can now sign in!');

  }

  /*
  |--------------------------------------------------------------------------
  | Authenticated user to get signin
  |--------------------------------------------------------------------------
  */

  public function getSignin()
  {
    return view('auth.signin');
  }

  public function postSignin(Request $request)
  {
    $this -> validate($request, [
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
      return redirect()->back()->with('error', 'Could not sign you in with those details.');
    }

    return redirect()->route('home')->with('info', 'you are now signed in.');
  }

  /*
  |--------------------------------------------------------------------------
  | Sign out
  |--------------------------------------------------------------------------
  */
  public function getSignout()
  {
    Auth::logout();
    return redirect()->route('home');
  }
}
