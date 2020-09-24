<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
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
     * Erstellt Comment und attacht ihn auf den aktuellen Post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'body' => 'required',
        ));

        if(!Auth::check()){
            $request->flash();
            return back()->with('error', 'Login first');
        }

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->body = $request->body;
        $comment->post_id = $request->post_id;
        $comment->save();

        $blog = Post::find($request->post_id);

        return back();
    }

    /**
     * Erstellt Comment und attacht ihn auf den aktuellen Post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function replyStore(Request $request)
    {
        $this->validate($request, array(
            'body' => 'required',
        ));

        if(!Auth::check()){
            $request->flash();
            return back()->with('error', 'Login first');
        }

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->body = $request->body;
        $comment->post_id = $request->post_id;
        $comment->parent_id = $request->comment_id;
        $comment->save();


        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Comment::find($id)->delete($id);

        return response()->json(['success' => $id]);
    }
}
