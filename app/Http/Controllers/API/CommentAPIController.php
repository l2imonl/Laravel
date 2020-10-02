<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentCollection;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Support\Facades\Auth;


class CommentAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if (Comment::whereNotNull('post_id')->get()) {
            return new CommentCollection(Comment::whereNotNull('post_id')->get());
        } else {
            return response()->json([
                'failed' => 'can\'t find any comments',
            ]);
        }

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'body' => 'required',
        ));

//        if (!Auth::check()) {
//            return response()->json([
//                'faild' => 'login first',
//            ]);
//        }

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->body = $request->body;
        $comment->post_id = $request->post_id;
        $comment->parent_id = $request->parent_id;
        $comment->save();

        return response()->json([
            'success' => 'comment created',
            'comment' => new CommentResource($comment)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function destroy(Request $request)
    {
        $comment = Comment::find($request->id);
        if ($comment) {
            $comment->delete();
            return response()->json([
                'success' => 'comment deleted',
                'comment' => $comment,
            ]);
        } else {
            return response()->json([
                'failed' => 'cant\'t find comment',
            ]);
        }
    }

    public function comments($id)
    {

    }
}
