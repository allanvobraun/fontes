<?php


if (!function_exists('jsonData')) {
    function jsonData($data)
    {
        return response()->json([
            'data' => $data
        ]);
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
