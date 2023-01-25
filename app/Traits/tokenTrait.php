<?php

namespace App\Traits;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

trait tokenTrait {

    /**
     * Returns a generated token.
     * @return string
     * @throws Exception if an appropriate source of randomness cannot be found.
     */
    public function generateToken()
    {
        return bin2hex(random_bytes(16));
    }

    /**
     * @param $token String APIToken to check
     * @param $userID int ID of the user to check
     * @param $returnUser boolean If true, the user will be returned
     * @return boolean|User Returns true if the token is valid, false if not. If $returnUser is true, the user will be returned.
     */
    public function checkToken(string $token, int $userID, bool $returnUser = false): User|bool
    {

        //checks if user exists with the given ID where the token is the same as the given token
        if(User::all()->where("id", $userID)->where("token", $token)->count() > 0){
            //if returnUser is true, return the user else return boolean
            if ($returnUser) {
                return User::all()->where("id", $userID)->where("token", $token)->first();
            } else {
                return true;
            }
        }
        //User does not exist or token is invalid so always return false.
        return false;
    }
}
