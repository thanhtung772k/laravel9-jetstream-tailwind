<?php

namespace App\Services\UserDetail;

use App\Repositories\UserDetail\UserDetailRepository;
use App\Services\BaseService;
use App\Traits\ManageFile;

/**
 * Class UserDetailService
 *
 * @property-read UserDetailRepository $repository
 *
 * @package App\Services\UserDetail
 */
class UserDetailService extends BaseService
{
    use ManageFile;

    /**
     * @return string
     */
    public function repository()
    {
        return UserDetailRepository::class;
    }

    /**
     * insert a new user created resource in storage.
     *
     * @param $request
     * @param $id
     * @return void
     */
    public function insert($request, $id)
    {

        $path = 'avatarUser';
        $avatar = $this->uploadFileTo($request->evidence_image, $path)['fileName'];
        return $this->repository->insert($request, $id, $avatar);
    }

    /**
     * Show all users
     *
     * @param $request
     * @return void
     */
    public function getAll($request)
    {
        return $this->repository->getAll($request);
    }

    /**
     * Show the form for editing user by ID
     *
     * @param int $id
     * @return mixed
     */
    public function userById($id)
    {
        return $this->repository->userById($id);
    }

    /**
     * Update user byt id resource in storage.
     *
     * @param $request
     * @param int $id
     * @return void
     */
    public function update($request, $id)
    {
        try {
            $imgEvidence = $request->old_evidence_image;
            $path = 'avatarUser/';
            if ($request->evidence_image !== null) {
                $this->removeFile($request->old_evidence_image, $path);
                $imgEvidence = $this->uploadFileTo($request->evidence_image, $path)['fileName'];
            }
            return $this->repository->updateDetail($request, $id, $imgEvidence);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete user by id resource in storage.
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * Show all users leave
     *
     * @param $request
     * @return void
     */
    public function userLeave($request)
    {
        return $this->repository->userLeave($request);
    }

    /**
     * Show detail user
     *
     * @param int $id
     * @return mixed
     */
    public function detail($id)
    {
        return $this->repository->detail($id);
    }

    /**
     * Update or create info User
     *
     * @param $info
     * @return void
     */
    public function updateInfo($info)
    {
        return $this->repository->updateInfo($info);
    }
}
