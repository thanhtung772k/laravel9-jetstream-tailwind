<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Database\Query\Builder;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories\Category;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * get all category
     *
     * @return void
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * count all category
     *
     * @return void
     */
    public function countCategory()
    {
        return $this->model->withCount([
            'posts' => function ($query) {
                $query->where('status', config('constant.STATUS_PUBLIC'));
            },
        ])->get();
    }
}
