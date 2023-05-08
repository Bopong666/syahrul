<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Kriteria extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kriteria')->insert([
            'nama' => 'Kehadiran',
            'bobot' => 0.2,
            'tipe' => 'benefit',
        ]);
        DB::table('kriteria')->insert([
            'nama' => 'Kualitas kerja',
            'bobot' => 0.2,
            'tipe' => 'benefit',
        ]);
        DB::table('kriteria')->insert([
            'nama' => 'Disiplin',
            'bobot' => 0.2,
            'tipe' => 'benefit',
        ]);
        DB::table('kriteria')->insert([
            'nama' => 'Ketaatan pada peraturan',
            'bobot' => 0.15,
            'tipe' => 'benefit',
        ]);
        DB::table('kriteria')->insert([
            'nama' => 'Kerja sama',
            'bobot' => 0.15,
            'tipe' => 'benefit',
        ]);
        DB::table('kriteria')->insert([
            'nama' => 'Pengembangan pribadi',
            'bobot' => 0.1,
            'tipe' => 'benefit',
        ]);
    }
}
