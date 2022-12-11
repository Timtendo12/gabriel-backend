<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class RegistrationController extends Controller
{
    public function store(HttpFoundationRequest $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'unique:users,email',
            'password' => 'required'
        ]);



        $user = User::create(request(['name', 'email', 'password']));

        return response()->json($user);
    }
}
