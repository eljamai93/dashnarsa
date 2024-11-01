<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Conge extends Model
{
    use HasFactory;
    protected $table = 'conges';
    protected $primaryKey ='idConge';
    protected $guarded = [];



    public function getuserinfos()
    {
        return $this->belongsTo(User::class,'id_user');
    }
}
