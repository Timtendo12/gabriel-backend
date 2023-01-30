<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\TokenTrait;

class RegistrationController extends Controller
{
    use tokenTrait;
    public function store(Request $request){


        $attributes = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:7', 'max:255']
        ]);

//        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'unique:users,email',
//            'password' => 'required'
//        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);


        $user->APIToken = $this->generateToken();
        $user->save();

        //dd($user, $attributes);

        $data = json_encode([
            "token" => $user->APIToken,
            "status" => 200
        ]);

        return response($data, 200);
    }
}
