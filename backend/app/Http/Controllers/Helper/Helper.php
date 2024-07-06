<?php

namespace App\Http\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;

class Helper
{
    public static function sendError($message, $error = [], $code = 401)
    {
        $response = ['success'];

        if (!empty($errors)) {
            $response['data'] = $errors;
        }
        throw new HttpResponseException(response()->json($response, $code));
    }
}