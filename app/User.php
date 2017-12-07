<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // protected $table = "users";
    // public function posts()
    // {
    //   return $this->hasMany("App\Post");
    // }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
// class User extends Model
// {
//     //
//     protected $table = "users";
//
//     public function posts()
//     {
//       return $this->hasMany("App\Post");
//     }
// }
