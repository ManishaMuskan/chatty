<?php

namespace chatty\Http\Controllers;

use Auth;
use chatty\Models\User;
use Illuminate\Http\Request;

use chatty\Http\Requests;

class ProfileController extends Controller
{
  /*Redirect to user profile*/
    public function getProfile($username)
    {
      $profile_user = User::where('username', $username)->first();
      $user = Auth::User();// user's friend list will be passed

      if (!$profile_user) {
          abort(404, 'No such user found...');
      }

      // if(!$user){
      //   abort(404);
      // }
      return view('profile.index', compact('profile_user','user'));
    }

    /*Edit and Update Authenticated user's profile*/
    public function editProfile($username)
    {
      if($username !== Auth::User()->username)
      {
        abort(403, "you are not authorised to update profile of others");
      }
      return view('profile.edit');
    }

    public function updateProfile(Request $request)
    {
      $this->validate($request, [
        'first_name' => 'required|alpha|max:50',
        'last_name' => 'alpha|max:50',
        'username' => 'required|alpha_dash|max:30'
      ]);

      $user = Auth::User();
      if ($request->has('password')) $user->password = bcrypt($request->input('password'));
      $user->update($request->all());

      return redirect()
             ->route('profile.user', ['username' => Auth::User()->username])
             ->with('info', 'your profile has been updated successfully!!');
    }
}
