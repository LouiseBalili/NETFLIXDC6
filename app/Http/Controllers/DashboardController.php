<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\TVShow;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $movie = Movie::count();
        $tvshow = TVShow::count();

        return inertia('Dashboard',[
            'tvshow' => $tvshow,
            'movie' => $movie
        ]);
    }
}
