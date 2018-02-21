<?php

namespace chatty\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Set attributes to save in a particular format in db
     *
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

    /**
     * The Functions to get results from db
     *
     */
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
}
