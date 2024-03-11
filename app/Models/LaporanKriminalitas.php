<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKriminalitas extends Model
{
    use HasFactory;
    public $table = "pelaporankegiatankriminalitas";
    protected $primaryKey = 'id_pelaporankegiatankriminalitas';
    protected $guarded = [];
    protected $fillable = ['id_pelaporankegiatankriminalitas','username', 'deskripsi', 'foto', 'statuspelaporan'];


}
