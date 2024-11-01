<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Echelon;

class EchlonDetail extends Model
{
    protected $table = 'detailechelon';
    use HasFactory;
    protected $guarded = [];

}
