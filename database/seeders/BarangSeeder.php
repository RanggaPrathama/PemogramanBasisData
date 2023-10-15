<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barangs')->insert([
            'jenis'=>'1',
            'nama_barang'=>'Meja',
            'id_satuan'=>'1',
            'harga'=>'20000'
        ]);
    }
}
