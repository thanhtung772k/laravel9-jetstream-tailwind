<?php

namespace App\Services\Post;

use App\Repositories\Post\PostRepository;
use App\Services\BaseService;
use App\Traits\ManageFile;

/**
 * Class PostService
 *
 * @property-read PostRepository $repository
 *
 * @package App\Services\Post
 */
class PostService extends BaseService
{
    use ManageFile;

    /**
     * @return string
     */
    public function repository()
    {
        return PostRepository::class;
    }

    /**
     * show all list post
     *
     * @return void
     */
    public function index()
    {
        return $this->repository->index();
    }

    /**
     * insert a new post
     *
     * @return void
     */
    public function insert($request)
    {
        $path = 'imgPost';
        $imgPost = $this->uploadFileTo($request->evidence_image, $path)['fileName'];
        $status = config('constant.STATUS_DRAFF');
        if ($request->toggleBtn) {
            $status = config('constant.STATUS_PUBLIC');
        }
        return $this->repository->insert($request, $imgPost, $status);
    }
}
