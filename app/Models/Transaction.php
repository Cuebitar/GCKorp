<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';
    protected $fillable = [
        'amount',
        'status',
        'type',
        'transactionPurpose',
        'referenceId',
        'completedAt',
        'tradingAccountId',
        'bankAccountId',
        'rejectId',
        'completedBy'
    ];

    public function bankAccount(){
        return $this->hasOne(BankAccount::class, 'bankAccount_id', 'bankAccountId');
    }

    public function tradingAccount(){
        return $this->belongsTo(TradingAccount::class, 'tradingAccountId', 'tradingAccount_id');
    }

    public function reject(){
        return $this->hasOne(RejectReason::class, 'reject_id', 'rejectId');
    }

    public function completedBy(){
        return $this->hasOne(User::class, 'user_id', 'completedBy');
    }

    public function updates(){
        return $this->hasMany(Update::class);
    }
}
