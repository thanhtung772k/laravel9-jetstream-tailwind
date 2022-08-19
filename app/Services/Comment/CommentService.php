<?php

namespace App\Services\Comment;

use App\Repositories\Comment\CommentRepository;
use App\Services\BaseService;

/**
 * Class CommentService
 *
 * @property-read CommentRepository $repository
 *
 * @package App\Services\Comment
 */
class CommentService extends BaseService
{
    /**
     * @return string
     */
    public function repository()
    {
        return CommentRepository::class;
    }
}
