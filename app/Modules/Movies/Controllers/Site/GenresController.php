<?php
namespace App\Modules\Movies\Controllers\Site;

use Illuminate\Http\Request;
use HZ\Illuminate\Mongez\Managers\ApiController;

class GenresController extends ApiController
{
    /**
     * Repository name
     *
     * @var string
     */
    protected const REPOSITORY_NAME = 'genres';



    /**
     * {@inheritDoc}
     */
    public function index(Request $request)
    {

        $options = [];

        if ($request->has('page')) {
            $options ['page'] = (int) $request->page;
        }
        if ($request->has('itemsPerPage')) {
            $options ['itemsPerPage'] = (int) $request->itemsPerPage;
        }

        return $this->success([
            'records' => $this->repository->list($options),
            'paginationInfo' => $this->repository->getPaginateInfo()
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function show($id, Request $request)
    {
        return $this->success([
            'record' => $this->repository->get($id),
        ]);
    }
}
