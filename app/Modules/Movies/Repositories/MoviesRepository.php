<?php
namespace App\Modules\Movies\Repositories;

use DB;
use App\Modules\Movies\{
    Models\Movie as Model,
    Resources\Movie as Resource,
    Filters\Movie as Filter
};
use Illuminate\Support\Arr;
use App\Modules\Movies\Models\GenreMovie;
use App\Services\Movies\Movies;
use HZ\Illuminate\Mongez\{
    Contracts\Repositories\RepositoryInterface,
    Managers\Database\MYSQL\RepositoryManager
};

class MoviesRepository extends RepositoryManager implements RepositoryInterface
{
    /**
     * Repository Name
     *
     * @const string
     */
    const NAME = 'movies';

    /**
     * Model class name
     *
     * @const string
     */
    const MODEL = Model::class;

    /**
     * Resource class name
     *
     * @const string
     */
    const RESOURCE = Resource::class;

    /**
     * Set the columns of the data that will be auto filled in the model
     *
     * @const array
     */
    const DATA = ['original_language', 'original_title', 'backdrop_path', 'overview', 'release_date', 'title'];

    /**
     * Auto save uploads in this list
     * If it's an indexed array, in that case the request key will be as database column name
     * If it's associated array, the key will be request key and the value will be the database column name
     *
     * @const array
     */
    const UPLOADS = [];

    /**
     * Auto fill the following columns as arrays directly from the request
     * It will encoded and stored as `JSON` format,
     * it will be also auto decoded on any database retrieval either from `list` or `get` methods
     *
     * @const array
     */
    const ARRAYBLE_DATA = [];

    /**
     * Set columns list of integers values.
     *
     * @cont array
     */
    const INTEGER_DATA = ['vote_count', 'original_id'];

    /**
     * Set columns list of float values.
     *
     * @cont array
     */
    const FLOAT_DATA = ['popularity', 'vote_average'];

    /**
     * Set columns of booleans data type.
     *
     * @cont array
     */
    const BOOLEAN_DATA = ['adult', 'video'];

    /**
     * Set columns list of date values.
     *
     * @cont array
     */
    const DATE_DATA = [];

    /**
     * Add the column if and only if the value is passed in the request.
     *
     * @cont array|true
     */
    const WHEN_AVAILABLE_DATA = [];

    /**
     * Set the default order by for the repository
     * i.e ['id', 'DESC']
     *
     * @const array
     */
    const ORDER_BY = [
        'original_id', 'DESC'
    ];

    /**
     * Filter by columns used with `list` method only
     *
     * @const array
     */
    const FILTER_BY = [];

    /**
     * Set all filter class you will use in this module
     *
     * @const array
     */
    const FILTERS = [
        Filter::class
    ];

    /**
     * Determine wether to use pagination in the `list` method
     * if set null, it will depend on pagination configurations
     *
     * @const bool
     */
    const PAGINATE = null;

    /**
     * Number of items per page in pagination
     * If set to null, then it will taken from pagination configurations
     *
     * @const int|null
     */
    const ITEMS_PER_PAGE = null;

    /**
     * Number of pages that we call from API
     *
     * @const int
     */
    const NUMBER_OF_PAGES = 5;

    /**
     * API method name
     *
     * @const string
     */
    const METHOD_NAME = 'topRated';

    /**
     * Set any extra data or columns that need more customizations
     * Please note this method is triggered on create or update method
     * If the model id is present, then its an update operation otherwise its a create operation.
     *
     * @param   Model $model
     * @param   \Illuminate\Http\Request $request
     * @return  void
     */
    protected function setData($model, $request)
    {
        //
        $model->original_id = $request->id;
    }


    /**
     * Manage Selected Columns
     *
     * @return void
     */
    protected function select()
    {
        //
    }

    /**
     * Do any extra filtration here
     *
     * @return  void
     */
    protected function filter()
    {
        // By category id
        if ($categoryId =  $this->option('category_id')) {
            $this->query->whereHas('genres', function($query) use ($categoryId) {
                $query->where('genre_id', $categoryId);
            });
        }

        // Filter By Popularity
        if ($popular =  $this->option('popular')) {
            $this->query->orderBy('popularity', $popular);
        }

        // Filter By Rating
        if ($rated = $this->option('rated')) {
            $this->query->orderBy('vote_average', $rated);
        }

    }

    /**
     * Get a specific record with full details
     *
     * @param  int id
     * @return mixed
     */
    public function get(int $id)
    {
        //
    }

    /**
     * Save bulk data
     *
     * @param array $data
     * @param int   $pageNumber
     * @return void
     */
    public static function saveFromAPI($pageNumber)
    {
        $movies =  new Movies;
        $data = $movies->fetch(static::METHOD_NAME, ['page' => $pageNumber]);
        foreach($data->results as $singleResult) {
            $model = Model::updateOrCreate([
                'original_id' => $singleResult->id
            ], (array) $singleResult);
            $model->find($singleResult->id)->genres()->sync($singleResult->genre_ids);
        }
    }
}
