<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Account extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'accounts';
    protected $primaryKey = 'account_id';

    protected $fillable = [
        'email',
        'passwordHash',
        'userId'
    ];

    protected $hidden = [
        'passwordHash',
        'userId'
    ];

    public function uniqueIds(){
        return ['email', 'passwordHash', 'userId'];
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'userId');
    }

    
}
