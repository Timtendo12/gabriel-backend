<?php

namespace App\Http\Controllers;

use App\Models\Swipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class SwipeController extends Controller
{
    public function swipe() {
        $companyID = \request("company_id");
        $studentID = \request("student_id");
        $status = \request("status");

        //checks if the current user already has a swipe with the other user.
        if (Swipe::all()->where("company_id", $companyID)->where("student_id", $studentID)->count() > 0) {
            return response()->json(["message" => "Swipe already exists"], 400);
        } else {
            //creates new swipe
            $swipe = new Swipe();
            $swipe->company_id = $companyID;
            $swipe->student_id = $studentID;
            $swipe->status = $status;
            $swipe->save();
        }
    }

    public function getSwipes() {
        //get id from request
        $user = \request("user_id");
        //gets the type from the request
        $type = \request("type");

        switch ($type) {
            case "company":
                $swipes = Swipe::all()->where("company_id", $user);
                break;
            case "student":
                $swipes = Swipe::all()->where("student_id", $user);
                break;
            default:
                return response()->json(["message" => "Invalid type"], 400);
        }

        $data = [
            "swipes" => $swipes,
            "count" => count($swipes),
            "user_id" => $user
        ];
        return response()->json($data, 200);

    }

    //get logged in user
    //check if company
    //get a user to swipe from database


    function showUserToSwipe(){
        //get user from token
        $token = request('token');


        $user = $this->getUserFromToken($token);

        $isCompany = DB::table('users')->where('id', $user['id'])->get(['company'])->first();



        return response()->json($user['id']);
    }
}
