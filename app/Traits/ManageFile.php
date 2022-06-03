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
}
