<?php

namespace App\Traits;

use App\Enums\Constant;

trait ResponseTrait
{
    /**
     * Success response method.
     *
     * @param null $message
     * @param null $data
     * @param $count
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResponse($message = null, $data = null, $count = 1)
    {
        $response = [
            'status_code' => Constant::STATUS_CODE_SUCCESS,
            'message' => $message,
            'count' => $count,
        ];

        if (!empty($data)) {
            $response['result'] = $data;
        }

        return response()->json($response, Constant::HTTP_STATUS_CODE_SUCCESS);
    }

    /**
     * Return error response.
     *
     * @param mixed $errorMessages
     * @param mixed $statusCode
     * @param null $dataError
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendError($errorMessages, $statusCode = 422, $dataError = null)
    {
        $response = [
            'status_code' => Constant::STATUS_CODE_FAIL,
            'message' => $errorMessages,
        ];

        if (!empty($dataError)) {
            $response['errors'] = $dataError;
        }

        return response()->json($response, (int)$statusCode);
    }
}
