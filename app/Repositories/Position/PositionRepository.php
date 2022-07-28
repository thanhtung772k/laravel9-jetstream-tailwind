<?php

namespace App\Repositories\Position;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PositionRepository.
 *
 * @package namespace App\Repositories\Position;
 */
interface PositionRepository extends RepositoryInterface
{
    /**
     * get all list Position
     *
     * @return mixed
     */
    public function getAll();
}
