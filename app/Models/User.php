<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'IC',
        'ICDocument',
        'gender',
        'religion',
        'race',
        'userType',
        'status',
        'address',
        'isVerified',
        'rejectId'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'isVerified' => 'boolean',
    ];

    public function uniqueIds(){
        return ['user_id', 'email', 'IC', 'ICDocument'];
    }

    public function account(){
        return $this->hasOne(Accoount::class);
    }

    public function bankAccount(){
        return $this->hasMany(Account::class);
    }
    public function verifyBankAccount(){
        return $this->hasMany(Account::class);
    }

    public function tradingAccount(){
        return $this->hasOne(TradingAccount::class);
    }
}
