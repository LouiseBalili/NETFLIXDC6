<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::orderBy('id', 'desc')->get();

        return inertia('Movie/index',[
            'movies' => $movies
        ]);
    }

    public function search($searchKey) {
        return inertia('Movie/index', ['movies' => Movie::where('title', 'like', "%$searchKey%")->orWhere('genres', 'like', "%$searchKey%")->orWhere('release_date', 'like', "%$searchKey%")->orWhere('summary', 'like', "%$searchKey%")->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Movie/create');
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

        if($request->movie_pic) {
            $fileName = time().'.'.$request->movie_pic->extension();
            $request->movie_pic->move(public_path('uploads/movie_pic'), $fileName);
            $fields['movie_pic'] = $fileName;
        }

        Movie::create($fields);

        return redirect('/movies')->with('success', 'Movie added successfully!');
    }

    public function show(Movie $movie) {
        return inertia('Movie/show', compact('movie'));
    }

}
