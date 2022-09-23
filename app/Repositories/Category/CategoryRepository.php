<?php

namespace App\Repositories\Category;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository.
 *
 * @package namespace App\Repositories\Category;
 */
interface CategoryRepository extends RepositoryInterface
{
    /**
     * get all category
     *
     * @return void
     */
    public function getAll();

    /**
     * count all category
     *
     * @return void
     */
    public function countCategory();

    /**
     * find category by slug
     *
     * @param $slug
     * @return void
     */
    public function findCategory($slug);
}
