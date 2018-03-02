<?php

namespace chatty\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'location',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

     /*
     |--------------------------------------------------------------------------
     | Set attributes to save in a particular format in db
     |--------------------------------------------------------------------------
     */
    public function setPasswordAttribute($password)
    {
      $this->attributes['password'] = bcrypt($password);
    }

    public function setFirstNameAttribute($first_name)
    {
      $this->attributes['first_name'] = ucfirst ($first_name);
    }

    public function setLastNameAttribute($last_name)
    {
      $this->attributes['last_name'] = ucfirst ($last_name);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Gravatar URL
    |--------------------------------------------------------------------------
    */
     public function getGravatarImg($size){
       return 'https://www.gravatar.com/avatar/{{ md5(strtolower(trim($this->email))) }}?d=mm&s='.$size;
     }

    /*
    |--------------------------------------------------------------------------
    | The Functions to get results from db
    |--------------------------------------------------------------------------
    */

    /*firstName or fullname or username*/
    public function getName()
    {
      if ($this->first_name && $this->last_name) {
        return $this->first_name.' '.$this->last_name; //full name
      }
      if ($this->first_name) {
        return $this->first_name; //first name
      }
      return null;
    }

    public function getNameOrUsername()
    {
      return $this->getName()?:$this->username;
    }

    public function getFirstNameOrUsername()
    {
      return $this->first_name ?: $this->username;
    }

    /*User to another user relationship - friends*/
    // Relation - friendship that I started
    public function friendsOfMine(){
      return $this->belongstoMany('chatty\Models\User', 'friends', 'user_id', 'friend_id')->withPivot('accepted')->withTimestamps(); //By using user_id, pick the row from friends table and then search for the user (having corresponding friend-id) from the user table.
    }

    // Relation - friendship that I was invited to
    public function iAmFriendOf(){
      return $this->belongstoMany('chatty\Models\User', 'friends', 'friend_id', 'user_id')->withPivot('accepted')->withTimestamps(); //By using friend_id, pick the row from friends table and then search for the user (having corresponding user-id) from the user table.
    }

    // friends after accepting the rquest
    public function friends(){
      return $this->friendsOfMine()->wherePivot('accepted', true)->get()
             ->merge($this->iAmFriendOf()->wherePivot('accepted', true)->get());
    }

    //friends which i have not accepted
    public function friendRequests(){
      return $this->iAmFriendOf()->wherepivot('accepted', false)->get();
    }

    //get friends i added but am not accepted
    public function sentRequests(){
      return $this->friendsOfMine()->wherepivot('accepted', false)->get();
    }

    //check if a friend i added has accepted my request
      public function ifsentRequestPending(User $receipent){
      return (bool) $this->sentRequests()->where('id', $receipent -> id)->count();
    }

    //check if a friend i added has accepted my request
    public function ifReceivedRequestPending(User $sender){
      return (bool) $this->friendRequests()->where('id', $sender -> id)->count();
    }

    //check if both are friends
    public function ifIsFriendWith(User $user){
      return (bool) $this->friends()->where('id', $user -> id)->count();
    }

    //add friend by attaching id to the intermediate table
    public function addAsMyFriend(User $user){
      return $this->friendsOfMine()->attach($user-> id);
    }

    //add friend by attaching id to the intermediate table
    public function acceptFriendRequest(User $sender){
      return $this->friendRequests()->where('id', $sender -> id)->first()->pivot
             ->update([
               'accepted' => true,
             ]);
    }

    //add friend by attaching id to the intermediate table
    public function ignoreFriendRequest(User $sender){
      return $this->iAmFriendOf()->detach($sender-> id);
    }

    //detaching user - unfriend funcionality
    public function removeAsFriend(User $friend)
    {
      /*check if user sent request*/
      if($this->iAmFriendOf()->wherepivot('accepted', true)->where('id', $friend -> id)->count()){
        return $this->iAmFriendOf()->detach($friend-> id);
      }
      /*check if i sent request*/
      if($this->friendsOfMine()->wherepivot('accepted', true)->where('id', $friend -> id)->count()){
        return $this->friendsOfMine()->detach($friend-> id);
      }
    }
}
