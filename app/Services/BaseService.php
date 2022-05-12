<?php

namespace App\Services;

use App\Traits\ResponseTrait;

/**
 * Class BaseService.
 *
 * @package namespace App\Services;
 */
abstract class BaseService
{
    use ResponseTrait;

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
