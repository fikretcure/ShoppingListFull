<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;

class authController extends Controller
{
    public function get_jwt($type, $id)
    {
        $data = null;
        if ($type == "access") {
            $data = [
                'id' => $id,
                'iat' => time(),
                "exp" => time() + 60 * 3
            ];
        } else if ("refresh") {
            $data = [
                'id' => $id,
            ];
        }
        return JWT::encode($data, env('JWT_SECRET'));
    }
    public function login(AuthRequest $req)
    {
        try {
            $user = user::where("email", $req->email)->first(["password", "id"]);
            if (Hash::check($req->password, $user->password)) {
                return $this->exp(["access" => $this->get_jwt("access", $user->id), "refresh" => $this->get_jwt("refresh", $user->id)]);
            } else {
                return $this->exp("Giriş bilgilerinizi kontrol ederek, tekrar deneyiniz !", 422);
            }
        } catch (\Throwable $th) {
            return $this->catch($th);
        }
    }
    public function check()
    {
        try {
            return "fiko";
        } catch (\Throwable $th) {
            return $this->catch($th);
        }
    }
}
