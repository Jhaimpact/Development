<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Admin extends Authenticatable
{
    use Notifiable , HasFactory;

    protected $guard = 'admin';


    protected $fillable = [
        'name',
        'email',
        'contact',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   
   
    public function role(){
        return $this->belongsTo(Role::class);
    }
}
