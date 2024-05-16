<?php

namespace App\Traits;

trait ApiResponseTrait
{
    protected function success($message, $data, $status = 200)
    {
        if (is_array($data) && count($data) == 0) {
            return $this->failure('No records found');
        }
        if (!is_array($data)) {
            return $this->failure('Invalid request data type');
        }
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function failure($message, $status = 422)
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }

}