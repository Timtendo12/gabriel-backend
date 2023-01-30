<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Traits\tokenTrait;

class extraInfo extends Controller
{
    use tokenTrait;
    public function getExtraInfo(){
        $token = request('token');

        $id = $this->getUserFromToken($token)['id'];

        $user = DB::table('extra_info_student')->where('userId', $id)->first();
        $name = DB::table('users')->where('id', $id)->first();

        $data = json_encode([
            "user" => $user,
            "username" => $name,
            "status" => 200
        ]);

        return response($data, 200);


    }

    public function getUser() {
        $token = request('token');

        $user = $this->getUserFromToken($token);

        $data = json_encode([
            "user" => $user,
            "status" => 200
        ]);

        return response($data, 200);
    }
}
