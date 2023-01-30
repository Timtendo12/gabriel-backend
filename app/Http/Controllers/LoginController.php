<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\tokenTrait;

class LoginController extends Controller{
    use tokenTrait;
    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {

            $data = json_encode([
                "message" => "No valid email given",
                "status" => 404
            ]);

            return response($data, 404);

        } else {
            $user = User::where('email', '=', $validator['email'])->first();

            if (Hash::check($validator['password'], $user->password)) {
                //login successfull

                $token = $this->generateToken();

                //save token to database
                $user->APIToken = $token;
                $user->save();

                $data = json_encode([
                    "token" => $token,
                    "status" => 200
                ]);
                return response($data, 200);
            } else {
                $data = json_encode([
                    "message" => "login failed",
                    "status" => 404
                ]);
                return response($data, 404);
            }

        }
    }

    public function doLogout(){
        $token = request('token');

        $user = User::where('APIToken', $token)->first();

        $user->APIToken = $this->generateToken();
        $user->save();

        $data = json_encode([
            "message" => "success",
            "status" => 200
        ]);

        return response($data, 200);
    }

    public function tokenLogin()
    {
        $token = request('token');

        if (User::where('APIToken', $token)->count()){
            $APIToken = User::where('APIToken', $token)->first()['APIToken'];

            $data = json_encode([
                "token" => $APIToken,
                "status" => 200
            ]);

        } else {
            $data = json_encode([
                "token" => null,
                "status" => 404
            ]);
        }

        return response($data, 200);
    }
}
