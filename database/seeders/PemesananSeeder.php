<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Pemesanan::create([
            'layanan_id' => 1,
            'nama_pelanggan' => 'John Doe',
            'telepon_pelanggan' => '08123456789',
            'jalan' => 'Jl. Sudirman No. 1',
            'kelurahan' => 'Menteng',
            'kecamatan' => 'Menteng',
            'kota' => 'Jakarta Pusat',
            'tanggal_mulai' => now()->addDays(1),
            'tanggal_selesai' => now()->addDays(5),
            'harga_final' => 5000000,
            'catatan' => 'Pemesanan interior rumah',
            'status' => 'menunggu',
            'review_token' => \Illuminate\Support\Str::random(32),
        ]);

        \App\Models\Pemesanan::create([
            'layanan_id' => 2,
            'nama_pelanggan' => 'Jane Smith',
            'telepon_pelanggan' => '08198765432',
            'jalan' => 'Jl. Thamrin No. 10',
            'kelurahan' => 'Tanah Abang',
            'kecamatan' => 'Tanah Abang',
            'kota' => 'Jakarta Pusat',
            'tanggal_mulai' => now()->addDays(2),
            'tanggal_selesai' => now()->addDays(7),
            'harga_final' => 3000000,
            'catatan' => 'Renovasi kantor',
            'status' => 'menunggu',
            'review_token' => \Illuminate\Support\Str::random(32),
        ]);

        \App\Models\Pemesanan::create([
            'layanan_id' => 3,
            'nama_pelanggan' => 'Bob Johnson',
            'telepon_pelanggan' => '08111222333',
            'jalan' => 'Jl. Gatot Subroto No. 20',
            'kelurahan' => 'Kuningan',
            'kecamatan' => 'Setiabudi',
            'kota' => 'Jakarta Selatan',
            'tanggal_mulai' => now()->addDays(3),
            'tanggal_selesai' => now()->addDays(10),
            'harga_final' => 7500000,
            'catatan' => 'Desain interior cafe',
            'status' => 'proses',
            'review_token' => \Illuminate\Support\Str::random(32),
        ]);
    }
}
