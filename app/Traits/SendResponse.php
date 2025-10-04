<?php
namespace App\Traits;

trait SendResponse {

    public function sendResponse($data = null, $message = '', $error = false, $status = 200) {

        $data = $data === null ? false : $data;
        $response = [
            'data' => $data,
            'message' => $message,
            'error' => $error,
            'status' => $status,
        ];

        return response()->json($response, $status);
    }
}
