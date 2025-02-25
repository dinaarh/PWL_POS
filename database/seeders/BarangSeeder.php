<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Barang untuk Supplier 1
            [
                'barang_id'   => 1,
                'kategori_id' => 1,
                'barang_kode' => 'BRG001',
                'barang_nama' => 'Laptop ASUS',
                'harga_beli'  => 7000000,
                'harga_jual'  => 9000000,
            ],
            [
                'barang_id'   => 2,
                'kategori_id' => 1,
                'barang_kode' => 'BRG002',
                'barang_nama' => 'Smartphone Samsung',
                'harga_beli'  => 5000000,
                'harga_jual'  => 6500000,
            ],
            [
                'barang_id'   => 3,
                'kategori_id' => 1,
                'barang_kode' => 'BRG003',
                'barang_nama' => 'TV LG 43 Inch',
                'harga_beli'  => 3000000,
                'harga_jual'  => 4000000,
            ],
            [
                'barang_id'   => 4,
                'kategori_id' => 1,
                'barang_kode' => 'BRG004',
                'barang_nama' => 'Kamera Canon',
                'harga_beli'  => 4500000,
                'harga_jual'  => 5500000,
            ],
            [
                'barang_id'   => 5,
                'kategori_id' => 1,
                'barang_kode' => 'BRG005',
                'barang_nama' => 'Headphone Sony',
                'harga_beli'  => 800000,
                'harga_jual'  => 1200000,
            ],

            // Barang untuk Supplier 2
            [
                'barang_id'   => 6,
                'kategori_id' => 2,
                'barang_kode' => 'BRG006',
                'barang_nama' => 'Kaos Polos',
                'harga_beli'  => 50000,
                'harga_jual'  => 100000,
            ],
            [
                'barang_id'   => 7,
                'kategori_id' => 2,
                'barang_kode' => 'BRG007',
                'barang_nama' => 'Jaket Denim',
                'harga_beli'  => 150000,
                'harga_jual'  => 250000,
            ],
            [
                'barang_id'   => 8,
                'kategori_id' => 2,
                'barang_kode' => 'BRG008',
                'barang_nama' => 'Celana Jeans',
                'harga_beli'  => 200000,
                'harga_jual'  => 350000,
            ],
            [
                'barang_id'   => 9,
                'kategori_id' => 2,
                'barang_kode' => 'BRG009',
                'barang_nama' => 'Sepatu Sneakers',
                'harga_beli'  => 300000,
                'harga_jual'  => 500000,
            ],
            [
                'barang_id'   => 10,
                'kategori_id' => 2,
                'barang_kode' => 'BRG010',
                'barang_nama' => 'Topi Baseball',
                'harga_beli'  => 50000,
                'harga_jual'  => 120000,
            ],

            // Barang untuk Supplier 3
            [
                'barang_id'   => 11,
                'kategori_id' => 3,
                'barang_kode' => 'BRG011',
                'barang_nama' => 'Beras 5Kg',
                'harga_beli'  => 60000,
                'harga_jual'  => 75000,
            ],
            [
                'barang_id'   => 12,
                'kategori_id' => 3,
                'barang_kode' => 'BRG012',
                'barang_nama' => 'Minyak Goreng 1L',
                'harga_beli'  => 14000,
                'harga_jual'  => 18000,
            ],
            [
                'barang_id'   => 13,
                'kategori_id' => 3,
                'barang_kode' => 'BRG013',
                'barang_nama' => 'Gula Pasir 1Kg',
                'harga_beli'  => 12000,
                'harga_jual'  => 15000,
            ],
            [
                'barang_id'   => 14,
                'kategori_id' => 3,
                'barang_kode' => 'BRG014',
                'barang_nama' => 'Susu Kental Manis',
                'harga_beli'  => 10000,
                'harga_jual'  => 13000,
            ],
            [
                'barang_id'   => 15,
                'kategori_id' => 3,
                'barang_kode' => 'BRG015',
                'barang_nama' => 'Mie Instan',
                'harga_beli'  => 2500,
                'harga_jual'  => 3000,
            ],
        ];

        DB::table('m_barang')->insert($data);
    }
}
