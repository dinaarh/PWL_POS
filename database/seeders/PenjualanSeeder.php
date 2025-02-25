<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id'    => 1,
                'user_id'         => 1,
                'pembeli'         => 'Budi Santoso',
                'penjualan_kode'  => 'PJ001',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id'    => 2,
                'user_id'         => 2,
                'pembeli'         => 'Siti Aminah',
                'penjualan_kode'  => 'PJ002',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id'    => 3,
                'user_id'         => 3,
                'pembeli'         => 'Rudi Hartono',
                'penjualan_kode'  => 'PJ003',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id'    => 4,
                'user_id'         => 1,
                'pembeli'         => 'Dewi Lestari',
                'penjualan_kode'  => 'PJ004',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id'    => 5,
                'user_id'         => 2,
                'pembeli'         => 'Andi Pratama',
                'penjualan_kode'  => 'PJ005',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id'    => 6,
                'user_id'         => 3,
                'pembeli'         => 'Nurul Hasanah',
                'penjualan_kode'  => 'PJ006',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id'    => 7,
                'user_id'         => 1,
                'pembeli'         => 'Joko Wasilo',
                'penjualan_kode'  => 'PJ007',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id'    => 8,
                'user_id'         => 2,
                'pembeli'         => 'Mega Putri',
                'penjualan_kode'  => 'PJ008',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id'    => 9,
                'user_id'         => 3,
                'pembeli'         => 'Adi Saputra',
                'penjualan_kode'  => 'PJ009',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'penjualan_id'    => 10,
                'user_id'         => 1,
                'pembeli'         => 'Lina Maharani',
                'penjualan_kode'  => 'PJ010',
                'penjualan_tanggal' => Carbon::now(),
            ],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
