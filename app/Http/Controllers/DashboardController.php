<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\TVShow;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $auth = User::count();
        $tvshow = TVShow::count();

        $user = auth()->user(); // Get the authenticated user

        $query = Movie::with('employee.user')
            ->orderBy('id', 'desc');

        if ($user->type === 'employee') {
            // If the user is an employee, filter the cash advances for that specific employee
            $query->whereHas('employee.user', function ($q) use ($user) {
                $q->where('id', $user->id);
            });
        }

        $movie = $query->paginate(6);
        // $userCount = User::count();
        return inertia('Dashboard',[
            'user' => $auth,
            'tvshow' => $tvshow,
            'movie' => $movie
        ]);
    }
}
