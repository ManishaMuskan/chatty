<?php

namespace chatty\Http\Controllers;

use DB;
use URL;
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
      $query = $request->query('query');
      if (!$query) {
       $message = 'Search for empty string cannot be performed.';
       return redirect()
       ->back()
       ->with('info', $message);
      }

      $users = User::where(DB::raw("CONCAT(first_name, '', last_name)"), 'LIKE', "%{$query}")
                    ->orWhere('username', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->get();
      return view('search.results', compact('users'));
    }
}
