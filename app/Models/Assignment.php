<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AssignmentDetail;

class Assignment extends Model
{
    public $incrementing = false;
    protected $primaryKey ='id';
    protected $table = 'assignments';
    use HasFactory;
    protected $guarded = [];

    public function UserAssignment() 
    {
        return $this->belongsToMany(User::class, AssignmentDetail::class, 'assignment_id', 'user_id');
    }
    public function AssignmentParent()
    {
        return $this->belongsTo(Assignment::class , 'idParent');
    }
}