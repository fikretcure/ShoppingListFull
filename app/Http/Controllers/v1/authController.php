<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function login(AuthRequest $req)
    {
        try {
            return 1453;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
