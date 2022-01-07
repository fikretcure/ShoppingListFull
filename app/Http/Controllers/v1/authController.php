<?php
namespace App\Http\Controllers\v1;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;
class authController extends Controller
{
    public function create_token($type, $id)
    {
        $data = null;
        switch ($type) {
            case 'access':
                $data = [
                    'id' => $id,
                    'iat' => time(),
                    "exp" => time() + 60 * 3
                ];
                break;
            case 'refresh':
                $data = [
                    'id' => $id,
                ];
                break;
            default:
                # code...
                break;
        }
        return JWT::encode($data, env('JWT_SECRET'));
    }
    public function login(AuthRequest $req)
    {
        $user = user::where("email", $req->email)->first(["password", "id"]);
        if ($user && Hash::check($req->password, $user->password)) {
            return $this->try(["access" => $this->create_token("access", $user->id), "refresh" => $this->create_token("refresh", $user->id)]);
        }
        return $this->catch("Giriş bilgilerinizi kontrol ederek, tekrar deneyiniz !");
    }
    public function check()
    {
        try {
            return $this->try();
        } catch (\Throwable $th) {
            return $this->catch($th);
        }
    }
}