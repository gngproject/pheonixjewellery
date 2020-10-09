<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $guarded = [];
    protected $table = 'wishlist';
    protected $primaryKey = 'id';
    protected $fillable = [
            "productID",
            "userID"
        ];

    public function user()
    {
    	return $this->hasMany('App\User');
    }
}
