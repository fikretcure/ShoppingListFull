<?php

namespace App\Http;

use App\Http\Controllers\v1\authController;

trait ApiResponseTrait
{
    private $status = null;
    public function try($data = null, $status = null)
    {
        $this->status = 200;
        if ($status) $this->status = $status;
        switch (request()->route()->action["as"]) {
            case 'auth.login':
                return response()->json(true, $this->status)->header('x-refresh-token', $data["refresh"])->header('x-access-token', $data["access"], $this->status);
                break;
            default:
                $access = new authController;
                return response()->json($data, $this->status)->header('x-access-token', $access->create_token("access", request("user_id")), $this->status);
                break;
        }
    }
    public function catch($data = null, $status = null)
    {
        $this->status = 422;
        if ($status) $this->status = $status;
        return response()->json($data, $this->status);
    }
}
