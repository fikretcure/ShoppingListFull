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
        $user = user::where("email", $req->email)->first(["password", "id"]);
        if ($user && Hash::check($req->password, $user->password)) {
            return $this->try(["access" => $this->get_jwt("access", $user->id), "refresh" => $this->get_jwt("refresh", $user->id)]);
        }
        return $this->catch("Giriş bilgilerinizi kontrol ederek, tekrar deneyiniz !");
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
