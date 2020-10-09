<?php

namespace App;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use Sortable;

    protected $primaryKey = 'productID';
    public $table = "product";
    public $fillable = [
        'productID_view',
        'Product_type',
        'Product_img_1',
        'Product_img_2',
        'Product_img_3',
        'Product_img_4',
        'Product_img_5',
        'Product_Name',
        'description',
        'Price',
        'stock',
        'Gender',
        'status',
    ];

    public function getImage()
    {
        return "Product_img_1/$this->image";
    }

    public function wishlist()
    {
    	return $this->belongsTo('App\Wishlist');
    }

    protected $sortable = [
        'Product_Name',
        'Price',
        'stock',
    ];
}
