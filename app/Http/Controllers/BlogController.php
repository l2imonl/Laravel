<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Post::paginate(4);
        return view('blog/index', compact('blog'));
    }


    /**
     * nächste Blog-Seite mit älteren Posts
     * 4 Posts pro Seite. Wenn es keine Einträge mehr gibt, wird nen error geworfen
     */
    public function next( $id)
    {
        $post = Post::find($id);
        $blog = Post::where('created_at', '<', $post->created_at)->orderBy('created_at', 'desc')->take(4)->get();

        if ($blog->count() == 0) {
            return back()->with('error', 'No older Posts');
        }

        return view('blog/index', compact('blog'));
    }

    /**
     * nächste Blog-Seite mit älteren Posts
     * 4 Posts pro Seite. Wenn es keine Einträge mehr gibt, wird nen error geworfen
     * Einträge werden mit asc gesucht und mit Desc sortiert, damit sie auch richtig angezeigt werden
     */
    public function prev($id)
    {
        $post = Post::find($id);
        $blog = Post::where('created_at', '>', $post->created_at)->orderBy('created_at', 'asc')->take(4)->get();
        $blog = $blog->SortByDesc('created_at');

        if ($blog->count() == 0) {
            return back()->with('error', 'No new Posts');
        }

        return view('blog/index', compact('blog'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('blog/single', compact('blog'));
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * ProfilSeite
     *
     */
    public function profile_edit($id)
    {
        $user = User::find($id);
        return view('blog/profil', compact('user'));
    }

    /**
     * ProfilSeite
     *
     */
    public function profile_update(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect(route('blog.index'));
    }
}
