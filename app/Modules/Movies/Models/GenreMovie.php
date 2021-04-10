<?php
namespace App\Modules\Movies\Models;

use HZ\Illuminate\Mongez\Managers\Database\mysql\Model;

class GenreMovie extends Model
{
    protected $table = 'genre_movie';
}
