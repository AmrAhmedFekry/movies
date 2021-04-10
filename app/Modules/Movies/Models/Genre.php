<?php
namespace App\Modules\Movies\Models;

use App\Modules\Movies\Models\Movie;
use HZ\Illuminate\Mongez\Managers\Database\mysql\Model;

class Genre extends Model
{
    public function movie()
    {
        return $this->belongsToMany(Movie::class, 'genre_movie', 'genre_id', 'movie_id', 'original_id');
    }
}
