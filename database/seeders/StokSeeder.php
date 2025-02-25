<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Stok untuk Barang Elektronik (Supplier 1)
            [
                'stok_id'       => 1,
                'supplier_id'   => 1, 
                'barang_id'     => 1,  // Laptop ASUS
                'user_id'       => 1, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 10,
            ],
            [
                'stok_id'       => 2,
                'supplier_id'   => 1, 
                'barang_id'     => 2,  // Smartphone Samsung
                'user_id'       => 2, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 15,
            ],
            [
                'stok_id'       => 3,
                'supplier_id'   => 1, 
                'barang_id'     => 3,  // TV LG 43 Inch
                'user_id'       => 3, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 20,
            ],
            [
                'stok_id'       => 4,
                'supplier_id'   => 1, 
                'barang_id'     => 4,  // Kamera Canon
                'user_id'       => 1, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 8,
            ],
            [
                'stok_id'       => 5,
                'supplier_id'   => 1, 
                'barang_id'     => 5,  // Headphone Sony
                'user_id'       => 2, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 25,
            ],

            // Stok untuk Barang Fashion (Supplier 2)
            [
                'stok_id'       => 6,
                'supplier_id'   => 2, 
                'barang_id'     => 6,  // Kaos Polos
                'user_id'       => 1, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 50,
            ],
            [
                'stok_id'       => 7,
                'supplier_id'   => 2, 
                'barang_id'     => 7,  // Jaket Denim
                'user_id'       => 3, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 30,
            ],
            [
                'stok_id'       => 8,
                'supplier_id'   => 2, 
                'barang_id'     => 8,  // Celana Jeans
                'user_id'       => 2, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 40,
            ],
            [
                'stok_id'       => 9,
                'supplier_id'   => 2, 
                'barang_id'     => 9,  // Sepatu Sneakers
                'user_id'       => 1, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 20,
            ],
            [
                'stok_id'       => 10,
                'supplier_id'   => 2, 
                'barang_id'     => 10, // Topi Baseball
                'user_id'       => 3, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 35,
            ],

            // Stok untuk Barang Makanan (Supplier 3)
            [
                'stok_id'       => 11,
                'supplier_id'   => 3, 
                'barang_id'     => 11, // Beras 5Kg
                'user_id'       => 2, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 100,
            ],
            [
                'stok_id'       => 12,
                'supplier_id'   => 3, 
                'barang_id'     => 12, // Minyak Goreng 1L
                'user_id'       => 3, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 120,
            ],
            [
                'stok_id'       => 13,
                'supplier_id'   => 3, 
                'barang_id'     => 13, // Gula Pasir 1Kg
                'user_id'       => 1, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 110,
            ],
            [
                'stok_id'       => 14,
                'supplier_id'   => 3, 
                'barang_id'     => 14, // Susu Kental Manis
                'user_id'       => 2, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 90,
            ],
            [
                'stok_id'       => 15,
                'supplier_id'   => 3, 
                'barang_id'     => 15, // Mie Instan
                'user_id'       => 3, 
                'stok_tanggal'  => Carbon::now(),
                'stok_jumlah'   => 200,
            ],
        ];

        DB::table('t_stok')->insert($data);
    }
}
