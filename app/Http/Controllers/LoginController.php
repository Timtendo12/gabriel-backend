<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use App\Traits\tokenTrait;

class LoginController extends Controller{
    use tokenTrait;
    public function doLogin(HttpFoundationRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'false', 'message' => 'not a email']);
        } else {
            $user = User::where('email', '=', $validator['email'])->first();

            if (Hash::check($validator['password'], $user->password)) {
                //login successfull
                $data = array([
                    "user" => $user,
                    "token" => $this->generateToken(),
                    "status" => 200
                ]);
                return response()->json($data);
            } else {
                return response()->json(['status' => 'false', 'message' => 'login failed']);
            }

        }
    }

    public function doLogout(){
        auth()->logout();
        return response()->json(auth()->user());
    }
}
