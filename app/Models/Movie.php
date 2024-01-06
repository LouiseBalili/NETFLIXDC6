<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_pic',
        'title',
        'genres',
        'release_date',
        'summary',
    ];

    protected $appends = [
        'movie_pic_url',
    ];

    public function getMoviePicUrlAttribute() {
        $url = $this->movie_pic ? asset("uploads/movie_pic/" . $this->movie_pic) : 'https://www.pngitem.com/pimgs/m/144-1441488_computer-icons-clapperboard-film-animation-clapperboard-png-transparent.png';
        return $url;
    }
}
