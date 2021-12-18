<?php

namespace App\Http;

use App\Http\Controllers\v1\authController;
use Illuminate\Http\Request;

trait ApiResponseTrait
{
    private $status = 200;
    public function exp($data = null, $status = null)
    {
        if ($status) $this->status = $status;
        switch (request()->route()->action["as"]) {
            case 'auth.login':
                if ($this->status == 200) {
                    return response()->json(true, 201)->header('x-refresh-token', $data["refresh"])->header('x-access-token', $data["access"]);
                } else {
                    return response()->json($data, $this->status);
                }
                break;
            default:
                $access = new authController;
                return response()->json([$data], $this->status)->header('x-access-token', $access->get_jwt("access", request("user_id")));
                break;
        }
    }
    public function catch($data = null)
    {
        return response($data, 422);
    }
}
