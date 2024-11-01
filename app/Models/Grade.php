<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\GradeDetail;

class Grade extends Model
{
    protected $table = 'grades';
    use HasFactory;
    protected $guarded = [];

    public function UserGrade() 
    {
        return $this->belongsToMany(User::class, GradeDetail::class, 'grade_id','user_id');
    }
    public static function countUserByGrade() 
    {
        $grades = Grade::withCount('UserGrade')->get();
        foreach ($grades as $grade) {
            $data[] = $grade->user_grade_count;
        }
        return $data;
    }
    public static function allgrade() 
    {
        $grades =  Grade::get();
        foreach ($grades as $grade) {
            $data[] = $grade->gradeFr;
        }
        return $data;
    }
}
