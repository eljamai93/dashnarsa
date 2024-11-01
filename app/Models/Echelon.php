<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class Echelon extends Model
{
    protected $table = 'echelons';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
   
}

