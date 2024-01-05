<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\MovieRequest;
use Illuminate\Http\Request;

class MovieRequestController extends Controller
{
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Movie/request');
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'year_released' => 'required',
        ]);

        $user = auth()->user();
        $log_entry = "{$user->name} has requested for '{$attributes['title']}' ({$attributes['year_released']})";

        $type = 'Movie';

        event(new UserLog($log_entry, $type));

        MovieRequest::create($attributes);

        return redirect('/movies')->with('success', 'Request is being processed.');
    }
}
