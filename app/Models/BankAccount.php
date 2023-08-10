<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $table = 'bank_accounts';
    protected $primaryKey = 'bankAccount_id';

    protected $fillable = [
        'bankName',
        'accountName',
        'accountNo',
        'bankStatement',
        'status',
        'isPrimary',
        'userId',
        'verifyBy',
        'rejectId',
    ];

    protected $hidden = [];

    public function uniqueIds(){
        return ['accountNo', 'bankStatement'];
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'userId');
    }

    public function verifyBankAccount(){
        return $this->hasOne(User::class, 'user_id', 'verifyBy');
    }

    public function transaction(){
        return $this->belongsToMany(Transaction::class);
    }

    public function reject(){
        return $this->hasOne(RejectReason::class, 'reject_Id', 'rejectId');
    }
}
