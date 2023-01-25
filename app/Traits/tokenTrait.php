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
     * @return boolean
     */
    public function checkToken(string $token, int $userID) {
        if(User::all()->where("id", $userID)->where("token", $token)->count() > 0){
            return true;
        }
        return false;
    }
}
