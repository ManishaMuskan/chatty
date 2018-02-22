<?php

namespace chatty\Http\Controllers;

use chatty\Models\User;
use Illuminate\Http\Request;
use chatty\Http\Requests;

class SearchController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Search people by Name
  |--------------------------------------------------------------------------
  */
    // public function getsearchPeople(Request $request)
    // {
    //   dd('you can search');
    // }

    public function searchPeople(Request $request)
    {
      dd('search');
    }
}
