<?php

namespace Database\Seeders;

use App\Models\Data\JenisRewash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisRewashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisRewash::create([
            'keterangan' => 'Masih Kotor',
            'modified_by' => 1
        ], [
            'keterangan' => 'Kurang Wangi',
            'modified_by' => 1
        ], [
            'keterangan' => 'Masih Setengah Kering',
            'modified_by' => 1
        ], [
            'keterangan' => 'Salah Parfum',
            'modified_by' => 1
        ]);
    }
}
