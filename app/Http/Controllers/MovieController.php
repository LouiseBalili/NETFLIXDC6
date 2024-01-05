<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as HttpRequest;

class MovieController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Movie/index', [
            'movies' => Movie::query()
                ->when(HttpRequest::input('search'), function ($query, $search) {
                    $query->where('title', 'like', '%' . $search . '%');
                })
                ->orderBy('release_date', 'desc')
                ->paginate(7)
                ->withQueryString(),
            'filters' => HttpRequest::only(['search'])
        ]);
    }
}
