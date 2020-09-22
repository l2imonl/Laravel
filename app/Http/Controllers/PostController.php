<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Post::sortable()->paginate(5);
        return view('admin/postlist', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog = Post::all();
        return view('admin/createpost', compact('blog'));
    }

    /**
     * speichern von neuem Post mit Image.
     * Image Validierung und ablegen in Storage
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, array(
            'title' => 'required|max:225',
            'body' => 'required',
        ));

        $blog = new Post;
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->user_id = $request->user_id;
        $blog->save();

        //Image
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $blog->updateHeadingImage($request->file('image'));
            } else {
                return back()->with('error', 'Could not upload image');
            }
        }

        $blog->save();

        return redirect('blog');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Post::find($id);
        return view('admin/showpost', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Post::find($id);
        return view('admin/editpost', compact('blog'));
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
        $this->validate($request, array(
            'title' => 'required|max:225',
            'body' => 'required',
        ));

        $blog = Post::find($id);
        $blog->title = $request->title;
        $blog->body = $request->body;

        //Image
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $blog->updateHeadingImage($request->file('image'));
            } else {
                return back()->with('error', 'Could not upload image');
            }
        }

        $blog->save();

        return redirect(route('blog.show', compact('id')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete($id);
        return response()->json(['success' => $id]);
    }
}
