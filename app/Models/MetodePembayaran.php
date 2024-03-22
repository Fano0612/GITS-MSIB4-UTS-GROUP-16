<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;
    public $table = "metode_pembayaran";
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = ['id','namametodepembayaran', 'saldo'];


}
