<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeDetail extends Model
{
    protected $table = 'detailgrade';
    public $incrementing = false;
    use HasFactory;
    protected $guarded = [];
}
