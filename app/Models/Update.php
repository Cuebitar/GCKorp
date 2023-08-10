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

    
}
