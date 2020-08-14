<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try{
            $publications = \App\Publication::paginate(8);
            $last = \App\Publication::all()->last();
            return view('home', compact(['publications', 'last']));
        } catch (\Throwable $th) {
            alert()->error('Error Message', 'Oops, something wrong')->persistent('Close');
            return back()->withErrors(['msg' => $th]);
        }
    }

    /**
     * Show the main page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the publications writen by th user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userPublications($id)
    {
        try{
            $user = \App\User::find($id);
            $publications = $user->publications()->paginate(8);

            return view('publications.user', compact(['publications', 'user']));
        } catch (\Throwable $th) {
            alert()->error('Error Message', 'Oops, something wrong')->persistent('Close');
            return back()->withErrors(['msg' => $th]);
        }
    }
}
