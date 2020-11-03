<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\Post as PostResource;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;

class PostAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::sortable()->paginate(5);
        if($posts){
            return response()->json([
               'data' => $posts,
            ]);
        }else{
            return response()->json([
               'failed' => 'can\'t find posts' ,
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
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {

        $jwt = $request->bearerToken();

        $tokenParts = explode('.', $jwt);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);

        //get id from Token
        $id = json_decode($payload)->user_id;

        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $id;
        $post->save();

        //Image
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $post->updateHeadingImage($request->file('image'));
            } else {
                return back()->with('error', 'Could not upload image');
            }
        }

        $post->save();

        return response()->json([
           'success' => 'post '.$post->id.' created',
            'post' => new PostResource($post),
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return PostResource|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post){
            return new PostResource($post);
        }else{
            return response()->json([
               'failed' => 'can\'t find post',
            ]);
        }
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
     * @return PostResource[]|array|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if($post){
            $return = ['success' => 'updated post',
                'old-post' => new PostResource(Post::find($id)),];
            $post->title = $request->title;
            $post->body = $request->body;

            //Image
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $post->updateHeadingImage($request->file('image'));
                } else {
                    return response()->json([
                        'failed' => 'can\'t upload image'
                    ]);
                }
            }
            $post->save();
            $return+=['new-post' => new PostResource(Post::find($id)),];
            return $return;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post = Post::find($request->id);
        if($post){
            $post->delete();
            return response()->json([
               'success' => 'post deleted',
               'post' => new PostResource($post),
            ]);
        }else{
            return response()->json([
                'failed' => 'can\'t delete post',
            ]);
        }
    }

    public function headerImage(Request $request){



    }
}
