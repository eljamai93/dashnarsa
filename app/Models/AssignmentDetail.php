<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AssignmentDetail extends Model
{
    protected $table = 'asignmentsdetails';
    public $incrementing = false;
    use HasFactory;
    protected $guarded = [];

    public function AssignmentDetail()
    {
        return $this->belongsTo(Assignment::class , 'assignment_id');
    }
   
    public static function countUserByAssignmentCent($id1 , $id2)
    {
        return  $count = AssignmentDetail::whereBetween('assignment_id', [$id1, $id2])->count();
    }
    public static function countUserByAssignmentReg($id1 , $id2)
    {
        return  $count = AssignmentDetail::whereBetween('assignment_id', [$id1, $id2])->count();
    }
    
}
