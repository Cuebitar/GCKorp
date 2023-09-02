<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectReason extends Model
{
    use HasFactory;

    protected $table = 'reject_reasons';
    protected $primaryKey = 'reject_id';

    protected $fillable = [
        'rejectType',
        'rejectCode',
        'description'
    ];


    public function user(){
        return $this->belongsToMany(User::class, 'rejectId');
    }

    public function bankAccount(){
        return $this->belongsToMany(BankAccount::class, 'rejectId');
    }

    public function transaction(){
        return $this->belongsToMany(Transaction::class, 'rejectId');
    }

    public function updates(){
        return $this->belongsToMany(Update::class, 'rejectId');
    }

    
}

