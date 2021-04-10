<?php
namespace App\Modules\Movies\Models;

use App\Modules\Movies\Models\Genre;
use HZ\Illuminate\Mongez\Managers\Database\mysql\Model;

class Movie extends Model
{
    public function genre()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie', 'movie_id', 'genre_id', 'original_id');
    }
}
