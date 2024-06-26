<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guarded = [];

    
    public function products(){
        return $this->hasMany(Barang::class,'kategori_id');
}
}
