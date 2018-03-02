<?php

namespace chatty\Http\Controllers;

use Auth;
use chatty\Models\User;
use Illuminate\Http\Request;
use chatty\Http\Requests;

class FriendController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  |user friends
  |--------------------------------------------------------------------------
  */
  /*Get Friends of a valid user*/
  public function getFriends($username){
    $profile_user = User::where('username', $username)->first();

    if ($profile_user === null) {
        abort(404, 'No such user found...');
    }
    return view('profile.showFriends', compact('profile_user'));
  }

  /*Get Friend Requests of auth user*/
  public function getFriendRequests($username){
    if($username !== Auth::User()->username)
    {
      abort(403, 'You are not authorised to see requests of other user !!');
    }

    $requests = Auth::User()->friendRequests();
    return view('profile.showFriendRequests', compact('requests'));
  }

  /*Add a friend*/
  public function addFriend($username)
  {
    $friend = User::where('username', $username)->first();
    if(!$friend)
    {
      abort(404, 'user could not be found');
    }

    $info_message = 'Friend request sent';

    if (Auth::User()->id === $friend->id) {
      $info_message = 'You cannot add youself as a friend';
    }
    elseif(Auth::User()->ifsentRequestPending($friend) || Auth::User()->ifReceivedRequestPending($friend)){
      if (Auth::User()->ifsentRequestPending($friend)) {
        $info_message = 'Your request has already been sent, let '.$friend->getName().' accept it to become a friend';
      }else{
        $info_message = $friend->getName().' has already sent a request to you, accept it to become a friend';
      }
    }
    elseif (Auth::User()->ifIsFriendWith($friend)) {
      $info_message = 'You and '.$friend->getName().' are already friends';
    }
    else{
      Auth::User()->addAsMyFriend($friend);
    }

    return redirect()
           ->route('profile.user', ['username' => $friend->username])
           ->with('info', $info_message);
  }

  /*Accept a friend request*/
  public function acceptFriend($username)
  {
    $friend = User::where('username', $username)->first();

    if(!$friend)
    {
      abort(404, 'User could not be found');
    }

    $info_message = 'Request accepted, you and '.$friend->getName().' are friends now.';

    if(Auth::User()->ifReceivedRequestPending($friend))
    {
      Auth::User()->acceptFriendRequest($friend);
    }
    elseif(Auth::User()->ifIsFriendWith($friend))
    {
      $info_message = 'You and '.$friend->getName().' are already friends';
    }
    elseif(Auth::User()->id == $friend -> id)
    {
      $info_message = 'You can not accept your own request';
    }
    else
    {
      $info_message = $friend->getName().' has not sent any request to you.';
    }

    return redirect()
           ->route('profile.user', ['username' => $friend->username])
           ->with('info', $info_message);
  }

  /*Ignore Friend Request*/
  public function ignoreFriend($username)
  {
    $friend = User::where('username', $username)->first();

    if(!$friend)
    {
      abort(404, 'User could not be found');
    }

    $info_message = 'Request Ignored';

    if(Auth::User()->id == $friend -> id)
    {
      $info_message = 'You can not ignore yourself';
    }
    elseif(Auth::User()->ifReceivedRequestPending($friend))
    {
      Auth::User()->ignoreFriendRequest($friend);
    }
    elseif(Auth::User()->ifIsFriendWith($friend))
    {
      $info_message = ' you and '.$friend->getNameOrUsername().' are friends; ignore request is invalid option, try unfriend option';
    }
    else
    {
      $info_message = $friend->getNameOrUsername().' has not sent any request to ignore';
    }

    return redirect()
           ->route('profile.user', ['username' => $friend -> username])
           ->with('info', $info_message);

  }

  /*unfriend a friend*/
  public function deleteFriend($username)
  {
    $friend = User::where('username', $username)->first();

    if(!$friend)
    {
      abort(404, 'user could not be found');
    }

    $info_message = 'you unfriended '.$friend->getName().', you and '.$friend->getFirstNameOrUsername().' are no more friends';

    if (Auth::User()->id === $friend->id) {
      $info_message = 'You cannot unfriend youself.';
    }
    elseif (Auth::User()->ifIsFriendWith($friend)) {
      Auth::User()->removeAsFriend($friend);
    }
    else{
      $info_message = 'You and '.$friend->getName().' are not friends yet, so you can not unfriend '.$friend->getFirstNameOrUsername();
    }

    return redirect()
           ->route('profile.user', ['username' => $friend->username])
           ->with('info', $info_message);
  }
}
