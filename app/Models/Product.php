<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id'; 
    protected $guarded = [];
    protected $fillable = ['product_id','product_name', 'product_picture', 'product_price', 'product_stock','category_id'];

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
