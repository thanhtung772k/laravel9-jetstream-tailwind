<?php

namespace App\Services;

use App\Traits\ResponseApi;

/**
 * Class BaseService.
 *
 * @package namespace App\Services;
 */
abstract class BaseService
{
    use ResponseApi;

    /**
     * @var $repository
     */
    public $repository;

    /**
     * UserRegisterService constructor.
     */
    public function __construct()
    {
        $this->repository = app($this->repository());
    }

    /**
     * @return string
     */
    public abstract function repository();
}
