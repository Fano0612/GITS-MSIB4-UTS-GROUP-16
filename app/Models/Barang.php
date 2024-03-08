<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    public $table = "barang";
    protected $primaryKey = 'id_barang';
    protected $guarded = [];
    protected $fillable = ['id_barang','namabarang', 'jenisbarang', 'harga', 'deskripsi', 'komposisi', 'tanggalkedaluwarsa', 'foto', 'jumlahstokbarang', 'kategori_id'];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }
}
