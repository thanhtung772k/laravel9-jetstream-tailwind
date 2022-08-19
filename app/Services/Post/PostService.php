<?php

namespace App\Services\Post;

use App\Repositories\Post\PostRepository;
use App\Services\BaseService;

/**
 * Class PostService
 *
 * @property-read PostRepository $repository
 *
 * @package App\Services\Post
 */
class PostService extends BaseService
{
    /**
     * @return string
     */
    public function repository()
    {
        return PostRepository::class;
    }
}
