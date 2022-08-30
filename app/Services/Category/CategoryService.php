<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepository;
use App\Services\BaseService;

/**
 * Class CategoryService
 *
 * @property-read CategoryRepository $repository
 *
 * @package App\Services\Category
 */
class CategoryService extends BaseService
{
    /**
     * @return string
     */
    public function repository()
    {
        return CategoryRepository::class;
    }

    /**
     * get all category
     *
     * @return void
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * count all category
     *
     * @return void
     */
    public function countCategory()
    {
        return $this->repository->countCategory();
    }
}
