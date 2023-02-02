<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\TokenTrait;

class RegistrationController extends Controller
{
    use tokenTrait;
    public function store(Request $request){

        //validating the user
        $attributes = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:7', 'max:255']
        ]);

        //hashing the password so its unreadable in the database

        $attributes['password'] = bcrypt($attributes['password']);


        //creating the user
        $user = User::create($attributes);


        //Generating API token and saving it to the database
        $user->APIToken = $this->generateToken();
        $user->save();

        //dd($user, $attributes);

        //returning the token of the user
        $data = json_encode([
            "token" => $user->APIToken,
            "status" => 200
        ]);

        return response($data, 200);
    }
}
