<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class LoginController extends Controller
{
    public function doLogin(HttpFoundationRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'false', 'message' => 'not a email']);
        } else {
            $user = User::where('email', '=', $request->email)->first();

            if (Hash::check($request->password, $user->password)) {
                auth()->login($user);
                return response()->json(Auth::user());
            } else {
                return response()->json(['status' => 'false', 'message' => 'password is wrong']);
            }
        }
    }

    public function doLogout(){
        auth()->logout();
        return response()->json(auth()->user());
    }


}
