<?php

namespace App\Http;

use Illuminate\Http\Request;

trait ApiResponseTrait
{
    private $status = 200;
    public function exp($data = null, $status = null)
    {
        if ($status) $this->status = $status;
        return response($data, $this->status);
    }
}
