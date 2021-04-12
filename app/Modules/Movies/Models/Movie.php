<?php
namespace App\Modules\Movies\Models;

use App\Modules\Movies\Models\Genre;
use HZ\Illuminate\Mongez\Managers\Database\mysql\Model;

class Movie extends Model
{

    /**
     * The genres that belong to the collection.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }
}
