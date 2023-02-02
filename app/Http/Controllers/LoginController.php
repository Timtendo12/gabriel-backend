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
        //validating the given data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            //no valid info given
            $data = json_encode([
                "message" => "No valid email or password given",
                "status" => 404
            ]);

            return response($data, 404);

        } else {

            //getting the user from the email
            $user = User::where('email', '=', $validator['email'])->first();

            //checking if the password is correct
            if (Hash::check($validator['password'], $user->password)) {
                //login successfull

                $token = $this->generateToken();

                //save token to database
                $user->APIToken = $token;
                $user->save();

                //returning the token of the user
                $data = json_encode([
                    "token" => $token,
                    "status" => 200
                ]);
                return response($data, 200);

            } else {
                //login failed, returning 404
                $data = json_encode([
                    "message" => "login failed",
                    "status" => 404
                ]);
                return response($data, 404);
            }

        }
    }

    public function doLogout(){
        //the token to logout
        $token = request('token');

        //getting the user from the token
        $user = $this->getUserFromToken($token);

        //regenerating the token so the session is destroyed
        $user->APIToken = $this->generateToken();
        $user->save();

        //returning success
        $data = json_encode([
            "message" => "success",
            "status" => 200
        ]);

        return response($data, 200);
    }

    public function tokenLogin()
    {
        //gets the token from the request
        $token = request('token');

        //checks if the token is valid
        if (User::where('APIToken', $token)->count()){
            //token is valid, returning the token in json format
            $APIToken = User::where('APIToken', $token)->first()['APIToken'];

            $data = json_encode([
                "token" => $APIToken,
                "status" => 200
            ]);

        } else {
            //token is not valid, returning 404 and null token
            $data = json_encode([
                "token" => null,
                "status" => 404
            ]);
        }

        return response($data, 200);
    }
}
