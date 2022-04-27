<?php

namespace App\Traits;

use App\Enums\Constant;

trait ResponseTrait
{
    /**
     * Success response method.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResponse()
    {
        //
    }

    /**
     * Return error response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendError()
    {
        //
    }
}
