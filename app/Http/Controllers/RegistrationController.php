<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class RegistrationController extends Controller
{
    public function store(HttpFoundationRequest $request){


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



        $user = User::create($attributes);

        auth()->login($user);

        return response()->json($user);
    }
}
