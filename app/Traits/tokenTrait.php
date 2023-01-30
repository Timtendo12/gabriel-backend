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
     * @return boolean|User Returns true if the token is valid, false if not. If $returnUser is true, the user will be returned.
     */
    public function checkToken(string $token, int $userID): User|bool
    {
        //checks if user exists with the given ID where the token is the same as the given token
        if(User::all()->where("id", $userID)->where("token", $token)->count() > 0){
            //if returnUser is true, return the user else return boolean
                return true;
            }
        //User does not exist or token is invalid so always return false.
        return false;
    }

    /**
     * @param string $token Token to get the user object from
     * @return User|bool Returns the user object if the token is valid, false if not.
     */
    public function getUserFromToken(string $token): User|bool
    {

        $user = User::all()->where("APIToken", $token)->first();

        //checks if user exists with the given ID where the token is the same as the given token
        if($user->count() > 0){
            //if returnUser is true, return the user else return boolean
                return $user;
            }
        //User does not exist or token is invalid so always return false.
        return false;
    }
}
