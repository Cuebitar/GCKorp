<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    use HasFactory;

    protected $table = 'updates';
    protected $primaryKey = 'updates_id';
    public $timestamp = false;
    public $fillable = [
        'transactionid',
        'tradingAccountid',
        'bankAccountId',
        'userId',
        'statusBefore',
        'updateBy',
        'updateAt',
        'rejectId'
    ];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'userId');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class, 'user_id', 'updateBy');
    }
    public function bankAccount(){
        return $this->belongsTo(BankAccount::class, 'bankAccount_id', 'bankAccountId');
    }

    public function tradingAccount(){
        return $this->belongsTo(TradingAccount::class, 'tradingAccount_id', 'tradingAccountId');
    }
    public function transactions(){
        return $this->belongsTo(Transaction::class, 'tradingAccount_id', 'tradingAccountId');
    }
    public function reject(){
        return $this->belongsTo(RejectReason::class, 'reject_id', 'rejectId');
    }

}
