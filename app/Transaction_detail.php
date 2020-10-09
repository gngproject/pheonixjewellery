<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_detail extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id';
    public $table = "transaction_detail";
    public $fillable = [
        'TransactionID',
        'ProductID',
        'userID',
        'nama',
        'email',
        'phone',
        'alamat',
        'amount',
        'quantity',
        'notes',
        'currency',
    ];
}
