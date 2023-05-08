<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubKriteria extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 1,
            'nama_sub_kriteria' => 'Sangat Kurang',
            'bobot_sub_kriteria' => 1,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 1,
            'nama_sub_kriteria' => 'Kurang',
            'bobot_sub_kriteria' => 2,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 1,
            'nama_sub_kriteria' => 'Cukup',
            'bobot_sub_kriteria' => 3,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 1,
            'nama_sub_kriteria' => 'Baik',
            'bobot_sub_kriteria' => 4,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 1,
            'nama_sub_kriteria' => 'Sangat Baik',
            'bobot_sub_kriteria' => 5,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 2,
            'nama_sub_kriteria' => 'Sangat Kurang',
            'bobot_sub_kriteria' => 1,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 2,
            'nama_sub_kriteria' => 'Kurang',
            'bobot_sub_kriteria' => 2,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 2,
            'nama_sub_kriteria' => 'Cukup',
            'bobot_sub_kriteria' => 3,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 2,
            'nama_sub_kriteria' => 'Baik',
            'bobot_sub_kriteria' => 4,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 2,
            'nama_sub_kriteria' => 'Sangat Baik',
            'bobot_sub_kriteria' => 5,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 3,
            'nama_sub_kriteria' => 'Sangat Kurang',
            'bobot_sub_kriteria' => 1,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 3,
            'nama_sub_kriteria' => 'Kurang',
            'bobot_sub_kriteria' => 2,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 3,
            'nama_sub_kriteria' => 'Cukup',
            'bobot_sub_kriteria' => 3,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 3,
            'nama_sub_kriteria' => 'Baik',
            'bobot_sub_kriteria' => 4,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 3,
            'nama_sub_kriteria' => 'Sangat Baik',
            'bobot_sub_kriteria' => 5,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 4,
            'nama_sub_kriteria' => 'Sangat Kurang',
            'bobot_sub_kriteria' => 1,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 4,
            'nama_sub_kriteria' => 'Kurang',
            'bobot_sub_kriteria' => 2,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 4,
            'nama_sub_kriteria' => 'Cukup',
            'bobot_sub_kriteria' => 3,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 4,
            'nama_sub_kriteria' => 'Baik',
            'bobot_sub_kriteria' => 4,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 4,
            'nama_sub_kriteria' => 'Sangat Baik',
            'bobot_sub_kriteria' => 5,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 5,
            'nama_sub_kriteria' => 'Sangat Kurang',
            'bobot_sub_kriteria' => 1,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 5,
            'nama_sub_kriteria' => 'Kurang',
            'bobot_sub_kriteria' => 2,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 5,
            'nama_sub_kriteria' => 'Cukup',
            'bobot_sub_kriteria' => 3,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 5,
            'nama_sub_kriteria' => 'Baik',
            'bobot_sub_kriteria' => 4,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 5,
            'nama_sub_kriteria' => 'Sangat Baik',
            'bobot_sub_kriteria' => 5,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 6,
            'nama_sub_kriteria' => 'Sangat Kurang',
            'bobot_sub_kriteria' => 1,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 6,
            'nama_sub_kriteria' => 'Kurang',
            'bobot_sub_kriteria' => 2,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 6,
            'nama_sub_kriteria' => 'Cukup',
            'bobot_sub_kriteria' => 3,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 6,
            'nama_sub_kriteria' => 'Baik',
            'bobot_sub_kriteria' => 4,
        ]);

        DB::table('sub_kriteria')->insert([
            'kriteria_id' => 6,
            'nama_sub_kriteria' => 'Sangat Baik',
            'bobot_sub_kriteria' => 5,
        ]);
    }
}
