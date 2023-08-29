<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Update extends Model
{
    use HasFactory;

    protected $table = 'updates';
    protected $primaryKey = 'updates_id';
    public $timestamps = false;
    public $fillable = [
        'transactionid',
        'tradingAccountid',
        'bankAccountId',
        'userId',
        'statusBefore',
        'updatedBy',
        'updatedAt',
        'rejectId'
    ];

    // Remove the $attributes property
    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributes['updatedAt'] = Carbon::now();
    }


    public function user(){
        return $this->belongsTo(User::class, 'userId', 'user_id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class, 'updateBy', 'user_id');
    }
    public function bankAccount(){
        return $this->belongsTo(BankAccount::class, 'bankAccountId', 'bankAccount_id');
    }

    public function tradingAccount(){
        return $this->belongsTo(TradingAccount::class, 'tradingAccountId', 'tradingAccount_id');
    }
    public function transactions(){
        return $this->belongsTo(Transaction::class, 'tradingAccountId', 'tradingAccount_id');
    }
    public function reject(){
        return $this->belongsTo(RejectReason::class, 'rejectId', 'reject_id');
    }

}
