<?php

namespace chatty\Http\Controllers;

use chatty\Models\User;
use Illuminate\Http\Request;

use chatty\Http\Requests;

class ProfileController extends Controller
{
    public function getProfile($username)
    {
      $user = User::where('username', $username)->first();

      if(!$user){
        abort(404);
      }
      return view('profile.index', compact('user'));
    }
}
