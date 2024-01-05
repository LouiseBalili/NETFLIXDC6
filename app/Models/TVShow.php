<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TVShow extends Model
{
    use HasFactory;

    protected $fillable = [
        'tvshow_pic',
        'title',
        'genres',
        'release_date',
        'summary',
    ];

    protected $appends = [
        'tvshow_pic_url',
    ];

    public function getTVShowPicUrlAttribute() {
        $url = $this->tvshow_pic ? asset("images/show_tvshow_pics/" . $this->tvshow_pic) : 'https://www.pngitem.com/pimgs/m/144-1441488_computer-icons-clapperboard-film-animation-clapperboard-png-transparent.png';
        return $url;
    }
}
