<?php

namespace App\Services\Position;

use App\Repositories\Position\PositionRepository;
use App\Services\BaseService;

/**
 * Class PositionService
 *
 * @property-read PositionRepository $repository
 *
 * @package App\Services\Position
 */
class PositionService extends BaseService
{
    /**
     * @return string
     */
    public function repository()
    {
        return PositionRepository::class;
    }

    /**
     * get all list Position
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }
}
