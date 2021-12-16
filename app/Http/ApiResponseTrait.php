<?php

namespace App\Http;

use Illuminate\Http\Request;

trait ApiResponseTrait
{
    public function exp($data = null)
    {
        return response()->json([
            "data" => $data
        ], 200);
    }
}
