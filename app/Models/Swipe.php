<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swipe extends Model
{
    protected $table = "swipes";
    protected $guarded = [];
    use HasFactory;
}
