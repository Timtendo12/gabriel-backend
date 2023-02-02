<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Traits\tokenTrait;

class extraInfo extends Controller
{
    use tokenTrait;
    public function getExtraInfo(){
        //gets token from the request
        $token = request('token');

        //gets the user from the token
        $user = $this->getUserFromToken($token);

        //gets the extra info from the database
        $extraInfo = DB::table('extra_info_student')->where('userId', $user['id'])->first();

        //returns extra info and user
        $data = json_encode([
            "extraInfo" => $extraInfo,
            "user" => $user,
            "status" => 200
        ]);

        //returns json data with 200
        return response($data, 200);


    }

    public function getUser() {
        //the token from the request
        $token = request('token');

        //gets the user from the token
        $user = $this->getUserFromToken($token);


        //returns the user in json format.
        $data = json_encode([
            "user" => $user,
            "status" => 200
        ]);

        return response($data, 200);
    }
}
