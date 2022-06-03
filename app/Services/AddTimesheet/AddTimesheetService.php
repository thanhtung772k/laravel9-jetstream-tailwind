<?php

namespace App\Services\AddTimesheet;

use App\Repositories\AddTimesheet\AddTimesheetRepository;
use App\Services\BaseService;
use App\Traits\ManageFile;

/**
 * Class AddTimesheetService
 *
 * @property-read AddTimesheetRepository $repository
 *
 * @package App\Services\AddTimesheet
 */
class AddTimesheetService extends BaseService
{
    use ManageFile;

    /**
     * @return string
     */
    public function repository()
    {
        return AddTimesheetRepository::class;
    }

    /**
     * create Add Timesheet
     * @param $request
     * @return mixed
     */
    public function createAddTimesheet($request)
    {
        $path = 'images';
        $imageName = $this->uploadFileTo($request->evidence_image, $path)['fileName'];
        return $this->repository->createAddTimesheet($request, $imageName);
    }

    /*
     * get list Additional timesheet
     */
    public function getListAddTimesheet()
    {
        return $this->repository->getListAddTimesheet();
    }

    /**
     * List detail Additional timesheet
     * @return mixed
     */
    public function getListDetailAddTimesheet($timesheetID)
    {
        return $this->repository->getListDetailAddTimesheet($timesheetID);
    }

    /**
     * update Additional timesheet
     * @param $addTimeID
     * @param $request
     * @return mixed
     */
    public function updateAddTimesheet($addTimeID, $request)
    {
        try {
            $imgEvidence = $request->old_evidence_image;
            $path = 'images/';
            if ($request->evidence_image !== null) {
                $this->removeFile($request->old_evidence_image, $path);
                $imgEvidence = $this->uploadFileTo($request->evidence_image, $path)['fileName'];
            }
            return $this->repository->updateAddTimesheet($addTimeID, $request, $imgEvidence);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * find Additional timesheet by ID
     * @param $idAddTimesheet
     * @return mixed
     */
    public function findIDAddTimesheet($idAddTimesheet)
    {
        try {
            return $this->repository->findIDAddTimesheet($idAddTimesheet);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * delete Additional timesheet
     * @param $addTimeID
     * @param $evidence
     * @return mixed
     */
    public function deleteAddTimesheet($addTimeID, $evidence)
    {
        try {
            $path = 'images/';
            $this->removeFile($evidence, $path);
            return $this->repository->deleteAddTimesheet($addTimeID);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * list approval timsheet
     * @return void
     */
    public function getListApprovalTimesheet()
    {
        return $this->repository->getListApprovalTimesheet();
    }

    /**
     * approval add timesheet
     * @param $request
     * @param $status
     * @return void
     */
    public function update($request, $status)
    {
        return $this->repository->updateAdd($request, $status);
    }

}
