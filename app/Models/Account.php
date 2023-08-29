<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'accounts';
    protected $primaryKey = 'account_id';

    protected $fillable = [
        'email',
        'password',
        'userId',
        
    ];

    protected $hidden = [
        'password',
        'rememberToken'
    ];

    public function uniqueIds(){
        return ['email', 'passwordHash', 'userId'];
    }

    public function user(){
        return $this->belongsTo(User::class, 'userId', 'user_id');
    }

    public function username(){
        return $this->email;
    }
}
