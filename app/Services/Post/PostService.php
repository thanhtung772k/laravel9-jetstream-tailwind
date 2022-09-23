<?php

namespace App\Services\Post;

use App\Repositories\Post\PostRepository;
use App\Services\BaseService;
use App\Traits\ManageFile;
use Illuminate\Support\Str;

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
     * @param $request
     * @return void
     */
    public function index($request)
    {
        return $this->repository->index($request);
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
        $request->toggleBtn ? $status = config('constant.STATUS_PUBLIC') : $status = config('constant.STATUS_DRAFF');
        isset($request->slug) ? $slug = Str::slug($request->slug) : $slug = Str::slug($request->title);

        return $this->repository->insert($request, $imgPost, $status, $slug);
    }

    /**
     * find post by slug
     *
     * @param $id
     * @return void
     */
    public function findBySlug($id)
    {
        return $this->repository->findBySlug($id);
    }

    /**
     * Update post by id
     *
     * @param $request
     * @param $id
     * @return void
     */
    public function update($request, $id)
    {
        $imgEvidence = $request->old_evidence_image;
        $path = 'imgPost/';
        if ($request->evidence_image !== null) {
            $this->removeFile($request->old_evidence_image, $path);
            $imgEvidence = $this->uploadFileTo($request->evidence_image, $path)['fileName'];
        }
        $request->toggleBtn ? $status = config('constant.STATUS_PUBLIC') : $status = config('constant.STATUS_DRAFF');
        isset($request->slug) ? $slug = Str::slug($request->slug) : $slug = Str::slug($request->title);

        return $this->repository->updatePost($request, $id, $status, $imgEvidence, $slug);
    }

    /**
     * Delete post
     *
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * detail post
     *
     * @param $id
     * @return void
     */
    public function detail($id)
    {
        return $this->repository->detail($id);
    }

    /**
     * show all public post
     *
     * @return void
     */
    public function publicPost($id)
    {
        return $this->repository->publicPost($id);
    }

    /**
     * sho detail post with slug
     *
     * @param $slug
     * @return void
     */
    public function slugPostDetail($slug)
    {
        return $this->repository->slugPostDetail($slug);
    }


    /**
     * get all top 4 most interested posts
     *
     * @return mixed
     */
    public function allPopularPost()
    {
        return $this->repository->allPopularPost();
    }

    /**
     * get all top 4 latest posts
     *
     * @return mixed
     */
    public function allNewPost()
    {
        return $this->repository->allNewPost();
    }
}
