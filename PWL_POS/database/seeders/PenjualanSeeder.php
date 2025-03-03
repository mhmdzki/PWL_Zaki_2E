<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
                'user_id' => 1, 
                'pembeli' => 'John Doe',
                'penjualan_kode' => 'TRX001',
                'penjualan_tanggal' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'pembeli' => 'Jane Smith',
                'penjualan_kode' => 'TRX002',
                'penjualan_tanggal' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'pembeli' => 'Bob Johnson',
                'penjualan_kode' => 'TRX003',
                'penjualan_tanggal' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'pembeli' => 'Alice Lee',
                'penjualan_kode' => 'TRX004',
                'penjualan_tanggal' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'pembeli' => 'Chris Evans',
                'penjualan_kode' => 'TRX005',
                'penjualan_tanggal' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'pembeli' => 'Natasha Romanoff',
                'penjualan_kode' => 'TRX006',
                'penjualan_tanggal' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Bruce Wayne',
                'penjualan_kode' => 'TRX007',
                'penjualan_tanggal' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Diana Prince',
                'penjualan_kode' => 'TRX008',
                'penjualan_tanggal' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Clark Kent',
                'penjualan_kode' => 'TRX009',
                'penjualan_tanggal' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Steve Rogers',
                'penjualan_kode' => 'TRX010',
                'penjualan_tanggal' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
