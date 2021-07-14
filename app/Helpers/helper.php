<?php


if (!function_exists('jsonData')) {
    function jsonData($data, $status = 200)
    {
        return response()->json([
            'data' => $data
        ], $status);
    }
}

if (!function_exists('jsonError')) {
    function jsonError(\Throwable $error)
    {
        return response()->json([
            'erros' => [
                'erro' => $error->getMessage()
            ]
        ], 400);
    }
}
