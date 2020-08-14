<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
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
        //try {
            $validator = $request->validate([
                'content' => 'required|max:65535|min:4',
                'publication_id' => 'required|min:1',
            ]);

            $publication = \App\Publication::find($request['publication_id']);

            if (count($publication->comments()->where('user_id', \Auth::id())->get()) ==0) {

                $comment = new \App\Comment([
                    'publication_id' => $request['publication_id'],
                    'content' => $request['content'],
                    'status' => 'RECHAZADO',
                ]);
                $comment->user_id = \Auth::id();
                $comment->save();

                // Sending mail
                $data = array(
                    'user' => \Auth::user()->name,
                    'comment' => $request['content'],
                    'publication' => $publication->title,
                    'id' => $publication->id,
                );
                $mail = $publication->user->email;

                \Mail::send('emails.notification', $data, function($message) use($mail)
                {
                    $message->to($mail)
                    ->subject('Attention to new COMMENT');
                });

                alert()->success('Publication created successfully!')->persistent('Cerrar');
                return back();
            }
            else {
                alert()->error('Error Message', 'Only one comment per user is allowed on each publication')->persistent('Close');
                return back();
            }
        /* } catch (\Throwable $th) {
            alert()->error('Error Message', 'Oops, something wrong')->persistent('Close');
            return back()->withErrors(['msg' => $validator]);
        } */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
