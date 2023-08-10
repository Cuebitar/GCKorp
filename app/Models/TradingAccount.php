<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingAccount extends Model
{
    use HasFactory;

    protected $table = 'trading_accounts';
    protected $primaryKey = 'tradingAccount_id';

    protected $fillable = [
        'accountNo',
        'initialBalance',
        'balance',
        'status',
        'suspendedAt',
        'userId'
    ];

    public function uniqueIds(){
        return ['accountNo'];
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'userId');
    }
}
