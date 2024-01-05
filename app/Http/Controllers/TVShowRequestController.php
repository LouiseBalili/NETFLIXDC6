<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\TVShowRequest;
use Illuminate\Http\Request;

class TVShowRequestController extends Controller
{
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('TVShow/request');
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

        $type = 'TV Show';

        event(new UserLog($log_entry, $type));

        TVShowRequest::create($attributes);

        return redirect('/tvshows')->with('success', 'Request is being processed.');
    }

}
