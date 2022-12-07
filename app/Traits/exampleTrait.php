<?php

namespace App\Traits;

use Illuminate\Http\Request;

//Dit is een trait, Zie het als een groep functies die je kan gebruiken in alle controllers met "$this->exampleFunction()";

trait exampleTrait {
    function exampleFunction(): string
    {
        return "example";
    }
}
