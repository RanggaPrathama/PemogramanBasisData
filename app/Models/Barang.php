<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';
    protected $primaryKey='id_barang';
    protected $fillable = [
        'id_satuan',
        'jenis',
        'nama_barang',
        'status',
        'harga'
    ];
}
