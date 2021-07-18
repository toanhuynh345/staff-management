<?php

use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;


if (!function_exists('uc_first')) {
    function uc_first($string)
    {
        if (empty($string)) {
            return '';
        }

        $string[0] = mb_strtoupper($string[0]);

        return $string;
    }
}

if (!function_exists('removeWhiteSpaces')) {
    function removeWhiteSpaces($string)
    {
        return trim(preg_replace('/\s+/', '', $string));
    }
}

if (!function_exists('response_validation_error')) {
    function response_validation_error($rules, $errors = [], $message = 'Please input again.')
    {
        $code = $http_status = Response::HTTP_UNPROCESSABLE_ENTITY;
        $response = [
            'success' => false,
            'code' => $code,
            'message' => $message,
            'errors' => $errors,
        ];

        foreach ($rules as $key => $rule) {
            foreach ($errors as $exception => $error) {
                if ($key === $exception && isset($error[0])) {
                    $response['errors'][$key] = uc_first($error[0]);
                }
            }
        }

        return response()->json($response, $http_status);
    }

    if (!function_exists('res_error')) {
        function res_error($message = 'Error', $code = 400, $http_status = 400, $errors = [])
        {
            $response = [
                'success' => false,
                'code' => $code,
                'message' => $message,
                'errors' => $errors,
            ];
            return response()->json($response, $http_status);
        }
    }

    if (!function_exists('res_success')) {
        function res_success($data = [], $message = 'Success', $code = 200, $http_status = 200)
        {
            $response = [
                'success' => true,
                'code' => $code,
                'message' => $message,
                'data' => $data,
            ];
            return response()->json($response, $http_status);
        }
    }

    if (!function_exists('lc_first')) {
        function lc_first($string)
        {
            if (empty($string)) {
                return '';
            }

            $string[0] = mb_strtolower($string[0]);

            return $string;
        }
    }

    if (!function_exists('response_not_found')) {
        function response_not_found($item, $errors = [])
        {
            $code = $http_status = Response::HTTP_NOT_FOUND;
            $response = [
                'success' => false,
                'code' => $code,
                'message' => __('messages.is_not_found', ['item' => $item]),
                'errors' => $errors,
            ];
            return response()->json($response, $http_status);
        }
    }


}
