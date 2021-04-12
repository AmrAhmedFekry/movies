<?php
namespace App\Modules\Movies\Models;

use App\Modules\Movies\Models\Genre;
use HZ\Illuminate\Mongez\Managers\Database\mysql\Model;

class Movie extends Model
{
    protected $table = 'movies';

    protected $primaryKey = 'original_id';

    protected $fillable = [
        'original_id',
        'original_language',
        'original_title',
        'backdrop_path',
        'overview',
        'release_date',
        'title',
        'vote_count',
        'adult',
        'video',
        'popularity',
        'vote_average'
    ];
    /**
     * The genres that belong to the collection.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }
}
