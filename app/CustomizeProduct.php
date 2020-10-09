<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialProduct extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id';
    public $table = "customize_product";
    public $fillable = [
        'user_id',
        'nama',
        'contact',
        'email',
        'kebutuhan',
        'referensi',
        'infotmbh',
    ];
}
