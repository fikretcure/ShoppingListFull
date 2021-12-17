<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class authController extends Controller
{
    public function login(Request $request)
    {
        return $this->exp($request->route()->getName());
    }
}
