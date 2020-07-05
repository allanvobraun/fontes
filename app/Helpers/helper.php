<?php

if (! function_exists('jsonData')) {
    function jsonData($data)
    {
      return response()->json([
        'data' => $data
      ]);
    }
}