<?php
namespace App\Modules\Movies\Models;

use App\Modules\Movies\Models\Movie;
use HZ\Illuminate\Mongez\Managers\Database\mysql\Model;

class Genre extends Model
{

    protected $table = 'genres';

    protected $fillable = [
        'id',
        'name'
    ];

    /**
     * The movies that belong to the collection.
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

}
