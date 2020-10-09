<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id';
    public $table = "orders";
    public $fillable = [
        'id',
        'user_id',
        'ProductID',
        'code',
        'status',
        'order_date',
        'payment_status',
        'base_total_price',
        'discount_amount',
        'discount_percent',
        'code_discount',
        'shipping_cost',
        'grand_total',
        'note',
        'customer_first_name',
        'customer_last_name',
        'customer_address',
        'customer_phone',
        'customer_email',
        'customer_city_id',
        'customer_province_id',
        'customer_postcode',
        'customer_point',
        'quantity',
    ];

    public function user()
    {
    	return $this->hasMany('App\User');
    }
}
