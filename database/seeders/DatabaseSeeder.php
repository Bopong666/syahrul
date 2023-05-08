<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Database\Seeders\Kriteria;
use Illuminate\Database\Seeder;
use Database\Seeders\SubKriteria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'username' => 'admin',
            'nama' => 'admin',
            'level' => '0',
            'password' => Hash::make('admin'),
        ]);

        DB::table('user')->insert([
            'username' => 'pimpinan',
            'nama' => 'pimpinan',
            'level' => '1',
            'password' => Hash::make('pimpinan'),
        ]);

        DB::table('user')->insert([
            'username' => 'syahrulramadhani',
            'nama' => 'Syahrul Ramadhani',
            'level' => '2',
            'tanggal_masuk' => Carbon::create(2019, 11, 6),
            'password' => Hash::make('pegawai123'),
        ]);
        DB::table('user')->insert([
            'username' => 'dewikus',
            'nama' => 'Dewi Kus Sandra',
            'level' => '2',
            'tanggal_masuk' => Carbon::create(2019, 8, 6),
            'password' => Hash::make('pegawai123'),
        ]);
        DB::table('user')->insert([
            'username' => 'lulukmei',
            'nama' => 'Luluk Mei Wulandari',
            'level' => '2',
            'tanggal_masuk' => Carbon::create(2020, 8, 6),
            'password' => Hash::make('pegawai123'),
        ]);
        DB::table('user')->insert([
            'username' => 'ridhaagustina',
            'nama' => 'Ridha Agustina',
            'level' => '2',
            'tanggal_masuk' => Carbon::create(2022, 8, 6),
            'password' => Hash::make('pegawai123'),
        ]);
        DB::table('user')->insert([
            'username' => 'ruhani',
            'nama' => 'Ruhani',
            'level' => '2',
            'tanggal_masuk' => Carbon::create(2019, 8, 6),
            'password' => Hash::make('pegawai123'),
        ]);
        DB::table('user')->insert([
            'username' => 'jumardin',
            'nama' => 'Jumardin',
            'level' => '2',
            'tanggal_masuk' => Carbon::create(2020, 4, 1),
            'password' => Hash::make('pegawai123'),
        ]);
        DB::table('user')->insert([
            'username' => 'isabellanoor',
            'nama' => 'Isabella Noor',
            'level' => '2',
            'tanggal_masuk' => Carbon::create(2019, 8, 6),
            'password' => Hash::make('pegawai123'),
        ]);
        DB::table('user')->insert([
            'username' => 'muhammadguntur',
            'nama' => 'Muhammad Guntur',
            'level' => '2',
            'tanggal_masuk' => Carbon::create(2018, 12, 6),
            'password' => Hash::make('pegawai123'),
        ]);
        DB::table('user')->insert([
            'username' => 'nurfifi',
            'nama' => 'Nur Fifi Arista',
            'level' => '2',
            'tanggal_masuk' => Carbon::create(2021, 3, 1),
            'password' => Hash::make('pegawai123'),
        ]);
        DB::table('user')->insert([
            'username' => 'risnasarippa',
            'nama' => 'Risna Sarippa',
            'level' => '2',
            'tanggal_masuk' => Carbon::create(2022, 3, 23),
            'password' => Hash::make('pegawai123'),
        ]);
        $this->call([
            Kriteria::class,
            SubKriteria::class,
        ]);
    }
}
