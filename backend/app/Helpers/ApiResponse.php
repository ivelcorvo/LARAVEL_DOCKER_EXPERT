<?php

  namespace App\Helpers;

  class ApiResponse
  {

    public static function success($message, $data=null, $status=200)
    {
      return response()->json([
        "success" => true,
        "message" => $message,
        "data"    => $data
      ], $status);
    }

    public static function errors($message, $error=null, $status=500)
    {
      return response()->json([
        "success" => false,
        "message" => $message,        
        "error"   => $error
      ], $status);
    }

  }