<?php

namespace App\Traits;

use App\Enums\Constant;
use Illuminate\Support\Facades\Storage;
use Log;
use Image;

trait ManageFile
{
    /**
     * @param $file
     * @param $path
     * @return array
     */
    public function uploadFileTo($file, $path)
    {
        if ($file) {
            $newImage = now()->timestamp . '.' . $file->getClientOriginalExtension();
            $urlPath = Storage::disk(config('filesystems.default'))->putFileAs($path, $file, $newImage);
            $fileName = $newImage;
            return [
                'urlPath' => $urlPath,
                'fileName' => $fileName
            ];
        }
    }

    /**
     * @param $file
     * @param $path
     * @return void
     */
    public function removeFile($file, $path)
    {
        if ($file) {
            Storage::disk(config('filesystems.default'))->delete($path . $file);
        }
    }

    /**
     * update timesheet when it have new checkin, checkout
     * @param $checkIn
     * @param $checkOut
     * @return array
     */
    public function updateTimesheet($checkIn, $checkOut)
    {
        $sub = now()->parse($checkOut)->diffInSeconds($checkIn);
        $actualWorkingTime = gmdate("H:i:s", $sub);
        //Convert hours to seconds
        $sumIn = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($checkIn));
        $sumOut = now()->parse(config('constant.midnight'))->diffInSeconds(now()->parse($checkOut));
        //Declare value =0
        $morning = config('constant.default_number');
        $afternoon = config('constant.default_number');
        //Check in before 12h
        if ((config('constant.twelfth_PM') - $sumIn) >= config('constant.positive_integer')) {
            if ((config('constant.eight_AM') - $sumIn) > config('constant.positive_integer')) {
                $sumIn = config('constant.eight_AM');
            }
            //checkout before 12h
            if ((config('constant.twelfth_PM')) - $sumOut > config('constant.positive_integer')) {
                $morning = $sumOut - $sumIn;
            } //checkout after 12h
            else if (((config('constant.thirteem_haftpast_PM')) - $sumOut) > config('constant.positive_integer') && ((config('constant.twelfth_PM')) - $sumOut) <= config('constant.positive_integer')) {
                $sumOut = config('constant.twelfth_PM');
                $morning = $sumOut - $sumIn;
            } //checkout after 13h30
            else {
                $morning = config('constant.twelfth_PM') - $sumIn;
                $afternoon = $sumOut - (config('constant.thirteem_haftpast_PM'));
            }
        } //check in after 12h
        else {
            //checkin from 12h to 13h30
            if (((config('constant.thirteem_haftpast_PM')) - $sumIn) > config('constant.positive_integer')) {
                $sumIn = config('constant.thirteem_haftpast_PM');
            }
            //checkin after 17h30
            if (((config('constant.seventeen_haftpast_PM')) - $sumOut) < config('constant.positive_integer')) {
                $sumOut = config('constant.seventeen_haftpast_PM');
            }
            $afternoon = $sumOut - $sumIn;
        }
        // Max paid = 4h
        $sumMorning = ($morning > config('constant.four_hour')) ? config('constant.four_hour') : $morning;
        $sumAfternoon = ($afternoon > config('constant.four_hour')) ? config('constant.four_hour') : $afternoon;
        $sum = $sumMorning + $sumAfternoon;
        $paidWorkingTime = gmdate("H:i:s", $sum);
        if (config('constant.eight_AM') - $sumOut > config('constant.positive_integer') || (config('constant.thirteem_haftpast_PM') - $sumIn) < config('constant.positive_integer')) {
            $actualWorkingTime = null;
            $paidWorkingTime = null;
        }
        return [
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'actWorking' => $actualWorkingTime,
            'paidWorking' => $paidWorkingTime,
        ];
    }
}
