<?php

namespace App\Http\Controllers;

use App\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = $request->validate([
                'title' => 'required|max:63|min:4',
                'content' => 'required|max:65535|min:4',
            ]);

            $publication = new \App\Publication([
                'title' => $request['title'],
                'content' => $request['content'],
                'user_id' => \Auth::id(),
            ]);
            $publication->save();
            alert()->success('Publication created successfully!')->persistent('Cerrar');
            return back();
        } catch (\Throwable $th) {
            alert()->error('Error Message', 'Oops, something wrong')->persistent('Close');
            return back()->withErrors(['msg' => $validator]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $publication = \App\Publication::find($id);
            $publishers = \App\User::all();

            return view('publications.show', compact(['publication', 'publishers']));
        } catch (\Throwable $th) {
            alert()->error('Error Message', 'Oops, something wrong')->persistent('Close');
            return back()->withErrors(['msg' => $th]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        //
    }
}
