<?php

namespace App\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait ValidateTrait
{
    public function valid($rules)
    {
        $req = new Request;
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response($validator->errors()->messages(), 202);
        } else {
            return false;
        }
    }
}
