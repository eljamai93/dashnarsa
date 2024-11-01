<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Echelon;
use App\Models\Sexe;
use App\Models\EchlonDetail;
use App\Models\Assignment;
use App\Models\AssignmentDetail;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles ;
    public $incrementing = false;
    protected $primaryKey ='matricule';
    
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function Echelon_Actuelle()
    {
        return $this->belongsToMany(Echelon::class, EchlonDetail::class, 'user_id', 'echelon_id')
        ->withTimestamps()
        ->withPivot('echelonSeniority' , 'echelon_id');
    }
    public function getechelonSeniority()
    {
        return $this->hasOne(EchlonDetail::class , 'user_id');
    }
    
    public function Grade_Actuelle()
    {
        return $this->belongsToMany(Grade::class, GradeDetail::class, 'user_id', 'grade_id')
        ->withTimestamps()
        ->withPivot('gradeSeniority' , 'grade_id');
    }

    public function getgradeSeniority()
    {
        return $this->hasOne(GradeDetail::class , 'user_id');
    }
    public function UsersCount()
    {
        return User::get()->count();
    }


    /* Relation between user and assignment */

    public function Affectation()
    {
        return $this->belongsToMany(Assignment::class, AssignmentDetail::class, 'user_id', 'assignment_id')
        ->withTimestamps()
        ->withPivot('assignmentSeniority');
    }
    public function getAssignmentSeniority()
    {
        return $this->hasOne(AssignmentDetail::class,'user_id');
    }
    
    
    /*************************************************     WIDGETS    ********************************************************************/
    /**** count of Women & man ***/

    public static function getManCount()
    {
        return  $count = User::where('id_sexe', 1)->count();
    }
    public static function getWomenCount()
    {
         return  $count = User::where('id_sexe', 2)->count();
    }

    /********************** Assignment Local Widget ******************************/

    public static function getAssignmentextErnalCount()
    {
        return User::whereHas('Affectation', function ($query) {
        $query->where('pertaining', 'like', 'S.Exterieurs');
        })->count();
    }
    public static function getAssignmentCentralCount()
    {
        return User::whereHas('Affectation', function ($query) {
            $query->where('pertaining', 'like', 'S.Centraux');
            })->count();
    }
    public static function getAssignmentStagiaireCount()
    {
        return User::whereHas('Affectation', function ($query) {
            $query->where('assignment_id', '=', 0);
            })->count();
    }

    /********************** Age Pyramid Type Widget ******************************/
    public function getAge(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::parse($this->dateBirth)->age,
        );
    }
    public static function countByAgeHomme()
    {
         $data;
         $i =0;
         $j = 0;
         $k = 0;
         $l = 0;
         $n = 0;
         $m = 0;
         $o = 0;
         $p = 0;
         $q = 0;
         $users = User::where('id_sexe', 1)->get();
         foreach( $users as $user )
         {
            if(Carbon::parse($user->dateBirth)->age <= 25)
            {
            $i++;
            $data[0] = $i;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 26 && Carbon::parse($user->dateBirth)->age <=30 )
            {
            $j++;
            $data[1] = $j;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 31 && Carbon::parse($user->dateBirth)->age <=35 )
            {
            $k++;
            $data[2] = $k;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 36 && Carbon::parse($user->dateBirth)->age <=40 )
            {
            $l++;
            $data[3] = $l;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 41 && Carbon::parse($user->dateBirth)->age <=45 )
            {
            $n++;
            $data[4] = $n;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 46 && Carbon::parse($user->dateBirth)->age <=50 )
            {
            $m++;
            $data[5] = $m;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 51 && Carbon::parse($user->dateBirth)->age <=55 )
            {
            $o++;
            $data[6] = $o;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 56 && Carbon::parse($user->dateBirth)->age <=60 )
            {
            $p++;
            $data[7] = $p;
            }
            elseif(Carbon::parse($user->dateBirth)->age > 60 )
            {
            $q++;
            $data[8] = $q;
            }
         }
         return $data;
        
    }

    public static function countByAgeFemme()
    {
         $data;
         $i =0;
         $j = 0;
         $k = 0;
         $l = 0;
         $n = 0;
         $m = 0;
         $o = 0;
         $p = 0;
         $q = 0;
         $users = User::where('id_sexe', 2)->get();
         foreach( $users as $user )
         {
            if(Carbon::parse($user->dateBirth)->age <= 25)
            {
            $i++;
            $data[0] = $i;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 26 && Carbon::parse($user->dateBirth)->age <=30 )
            {
            $j++;
            $data[1] = $j;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 31 && Carbon::parse($user->dateBirth)->age <=35 )
            {
            $k++;
            $data[2] = $k;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 36 && Carbon::parse($user->dateBirth)->age <=40 )
            {
            $l++;
            $data[3] = $l;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 41 && Carbon::parse($user->dateBirth)->age <=45 )
            {
            $n++;
            $data[4] = $n;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 46 && Carbon::parse($user->dateBirth)->age <=50 )
            {
            $m++;
            $data[5] = $m;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 51 && Carbon::parse($user->dateBirth)->age <=55 )
            {
            $o++;
            $data[6] = $o;
            }
            elseif(Carbon::parse($user->dateBirth)->age >= 56 && Carbon::parse($user->dateBirth)->age <=60 )
            {
            $p++;
            $data[7] = $p;
            }
            elseif(Carbon::parse($user->dateBirth)->age > 60 )
            {
            $q++;
            $data[8] = $q;
            }
         }
         return $data;
        
    }
    /* Controle access to admin panel */
    public function canAccessFilament(): bool
    {
        return $this->hasRole(['Admin' , 'Consultant' , 'Basic']);
    }
}
