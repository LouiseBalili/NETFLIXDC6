<?php

namespace App\Http\Controllers;

use App\Models\TVShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as HttpRequest;

class TVShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('TVShow/index', [
            'tvshows' => TVShow::query()
                ->when(HttpRequest::input('search'), function ($query, $search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('genres', 'like', '%' . $search . '%')
                        ->orWhere('release_date', 'like', '%' . $search . '%');
                })
                ->orderBy('release_date', 'desc')
                ->paginate(7)
                ->withQueryString(),
            'filters' => HttpRequest::only(['search'])
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
            $request->tvshow_pic->move(public_path('images/client_tvshow_pics'), $fileName);
            $fields['tvshow_pic'] = $fileName;
        }

        TVShow::create($fields);

        return redirect('/tvshows')->with('success', 'TV Show added successfully!');
    }
}
