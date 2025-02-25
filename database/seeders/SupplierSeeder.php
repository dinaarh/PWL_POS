<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id'    => 1,
                'supplier_kode'  => 'SP001',
                'supplier_nama'  => 'PT Sumber Makmur',
                'supplier_alamat'=> 'Jl. Bandung No 32',
            ],
            [
                'supplier_id'    => 2,
                'supplier_kode'  => 'SP002',
                'supplier_nama'  => 'CV Cahaya Bersinar',
                'supplier_alamat'=> 'Jl. Mawar No 15',
            ],
            [
                'supplier_id'    => 3,
                'supplier_kode'  => 'SP003',
                'supplier_nama'  => 'PT Jaya Sentosa',
                'supplier_alamat'=> 'Jl. Blimbing No 54',
            ],
        ];

        DB::table('m_supplier')->insert($data);
    }
}
