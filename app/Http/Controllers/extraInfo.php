<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class extraInfo extends Controller
{
    public function getExtraInfo(HttpFoundationRequest $request, $id){

        $user = DB::table('extra_info_student')->where('userId', $id)->first();
        $name = DB::table('users')->where('id', $id)->first();
        return response()->json(['username' => $name, 'user' => $user]);


    }
}
