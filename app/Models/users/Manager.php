<?php

namespace App\Models\users;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    protected $table = "managers";
    protected $fillable = [
        "name",
        "password"
    ];
}
