<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends User
{
    protected $table = 'users';
    protected $guarded = [];
    use HasFactory;
}
