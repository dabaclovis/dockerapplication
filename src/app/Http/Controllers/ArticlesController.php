<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => 'index','show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('articles.index',[
            'articles' => Article::orderBy('id','desc')->paginate(7),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => [ 'required','string','max:255'],
            'body' => ['required', 'string','max:2500'],
        ],[
            'title' => "This field can't be empty.",
            'body' => "The content field can't be empty !!",
        ]);
        if ($request->hasFile('imaged')) {
            $file = $request->file('imaged')->getClientOriginalName();
            $filename = $file.'.'.time();
            $path = $request->file('imaged')->storeAs('images',$filename,'public');

        }else {
            $filename = 'noimaged';
        }

        DB::table('articles')->insert([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => Auth::user()->id,
            'imaged' => $filename,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): View
    {
        return view('articles.show',[
            'article' => $article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): View
    {
        return view('articles.edit',[
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:2500'],
        ], [
            'title' => "This field can't be empty.",
            'body' => "The content field can't be empty !!",
        ]);

        if (DB::table('articles')->where('imaged')->exists()) {
            DB::table('articles')->where('imaged',$article->imaged)->delete();
        }
        $path = 'public/storage/images/'. $article->imaged;
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
        if ($request->hasFile('imaged')) {
            $file = $request->file('imaged')->getClientOriginalName();
            $clovis = $file.'.'.time();
            $path = $request->file('imaged')->storeAs('images',$clovis,'public');
        } else {
            $clovis = 'noimaged';
        }

        $article->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => Auth::user()->id,
            'imaged' => $clovis,
        ]);


        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if (Auth::user()->id == $article->user_id) {
            $article->delete();
        }else{
            return back();
        }
        return redirect()->route('articles.index');
    }
}
