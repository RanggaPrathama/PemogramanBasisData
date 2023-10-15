<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendors';
    protected $primaryKey='id_vendor';
    protected $fillable=[
        'nama_vendor',
        'badan_hukum',
        'status'
    ];
}
