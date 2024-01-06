<?php

namespace App\Http\Controllers;

use App\Models\TVShow;
use Illuminate\Http\Request;

class TVShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tvshows = TVShow::orderBy('id', 'desc')->get();

        return inertia('TVShow/index',[
            'tvshows' => $tvshows
        ]);
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('TVShow/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string',
            'genres' => 'required|string',
            'release_date' => 'required|string',
            'summary' => 'required|string'
        ]);

        $fileName = null;

        if($request->tvshow_pic) {
            $fileName = time().'.'.$request->tvshow_pic->extension();
            $request->tvshow_pic->move(public_path('uploads/tvshow_pic'), $fileName);
            $fields['tvshow_pic'] = $fileName;
        }

        TVShow::create($fields);

        return redirect('/tvshows')->with('success', 'TV Show added successfully!');
    }

    public function show(TVShow $tvshow) {
        return inertia('TVShow/show', compact('tvshow'));
    }

    public function edit(TVShow $tvshow) {
        return inertia('TVShow/edit', compact('tvshow'));
    }

    public function update(TVShow $tvshow, Request $request) {
        $request->validate([
            'title' => 'string|required',
            'genres' => 'string|required',
            'release_date' => 'date|required',
            'summary' => 'string|required',
        ]);

        $tvshow->update($request->all());

        return redirect('/tvshows/' . $tvshow->id);
    }

    public function search($searchKey) {
        return inertia('TVShow/index', ['tvshows' => TVShow::where('title', 'like', "%$searchKey%")->orWhere('genres', 'like', "%$searchKey%")->orWhere('release_date', 'like', "%$searchKey%")->orWhere('summary', 'like', "%$searchKey%")->get()]);
    }
}
