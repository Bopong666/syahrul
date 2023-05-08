<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Pegawai;
use Livewire\Component;
use App\Models\Kriteria;
use Illuminate\Support\Facades\Auth;

class PerhitunganComponent extends Component
{
    public $pegawai, $kriteria, $pembagi, $normalisasi, $normalisasiterbobot, $aplus;
    public $amin, $jarakdplus, $jarakdmin, $dplus, $dmin,  $hasil, $hasilranking;
    public $subkriteria;


    public function mount()
    {
        // MENGAMBIL DATA pegawai JIKA DIA ADMIN, JIKA USER MAKA 
        // PERLU NORMALISASI MENYESUAIKAN DENGAN PILIHAN USER

        $this->pegawai = User::has('subkriteria')->where('level', '2')->get();

        $this->kriteria = Kriteria::all();

        // MENCARI PEMBAGI      

        for ($i = 0; $i < count($this->kriteria); $i++) {
            $this->pembagi[$i] = 0;
            for ($j = 0; $j < count($this->pegawai); $j++) {
                $this->pembagi[$i] = $this->pembagi[$i] + pow($this->pegawai[$j]['subkriteria'][$i]['bobot_sub_kriteria'], 2);
            }
            $this->pembagi[$i] = sqrt($this->pembagi[$i]);
        }

        // foreach ($this->pembagi as $key => $pembagi) {
        //     if ($pembagi == 0) {
        //         $this->pembagi[$key] = 1;
        //     }
        // }
        // NORMALISASI

        for ($i = 0; $i < count($this->kriteria); $i++) {
            for ($j = 0; $j < count($this->pegawai); $j++) {
                $this->normalisasi[$j][$i] = $this->pegawai[$j]['subkriteria'][$i]['bobot_sub_kriteria'] / $this->pembagi[$i];
            }
        }

        // MENORMALISASIKAN DENGAN NILAI BOBOT
        for ($i = 0; $i < count($this->kriteria); $i++) {
            for ($j = 0; $j < count($this->pegawai); $j++) {
                $this->normalisasiterbobot[$j][$i] = $this->normalisasi[$j][$i] * $this->kriteria[$i]['bobot'];
            }
        }

        // MENCARI NILAI A+ DAN A-
        for ($i = 0; $i < count($this->kriteria); $i++) {
            for ($j = 0; $j < count($this->normalisasiterbobot); $j++) {
                if ($j == 0) {
                    $this->aplus[$i] = $this->normalisasiterbobot[$j][$i];
                }
                if ($this->kriteria[$i]['tipe'] == 'benefit') {
                    if ($this->aplus[$i] < $this->normalisasiterbobot[$j][$i]) {
                        $this->aplus[$i] = $this->normalisasiterbobot[$j][$i];
                    }
                } else {
                    if ($this->aplus[$i] > $this->normalisasiterbobot[$j][$i]) {
                        $this->aplus[$i] = $this->normalisasiterbobot[$j][$i];
                    }
                }
            }
            for ($j = 0; $j < count($this->normalisasiterbobot); $j++) {
                if ($j == 0) {
                    $this->amin[$i] = $this->normalisasiterbobot[$j][$i];
                }
                if ($this->kriteria[$i]['tipe'] == 'benefit') {
                    if ($this->amin[$i] > $this->normalisasiterbobot[$j][$i]) {
                        $this->amin[$i] = $this->normalisasiterbobot[$j][$i];
                    }
                } else {
                    if ($this->amin[$i] < $this->normalisasiterbobot[$j][$i]) {
                        $this->amin[$i] = $this->normalisasiterbobot[$j][$i];
                    }
                }
            }
        }

        // // MENCARI JARAK DARI A+ DAN A-
        for ($i = 0; $i < count($this->kriteria); $i++) {

            for ($j = 0; $j < count($this->normalisasiterbobot); $j++) {
                if ($i == 5 && $j == 0) {
                }
                $this->jarakdplus[$j][$i] = pow($this->aplus[$i] - $this->normalisasiterbobot[$j][$i], 2);
            }

            for ($j = 0; $j < count($this->normalisasiterbobot); $j++) {
                $this->jarakdmin[$j][$i] = pow($this->normalisasiterbobot[$j][$i] - $this->amin[$i], 2);
            }
        }

        // MENENTUKAN NILAI D+ DAN D-
        for ($j = 0; $j < count($this->pegawai); $j++) {
            $this->dplus[$j] = 0;
            $this->dmin[$j] = 0;

            for ($i = 0; $i < count($this->kriteria); $i++) {
                $this->dplus[$j] = $this->dplus[$j] + $this->jarakdplus[$j][$i];
            }
            for ($i = 0; $i < count($this->kriteria); $i++) {
                $this->dmin[$j] = $this->dmin[$j] + $this->jarakdmin[$j][$i];
            }
            $this->dplus[$j] = sqrt($this->dplus[$j]);
            $this->dmin[$j]  = sqrt($this->dmin[$j]);
        }

        // MENGHITUNG NILAI PREFERENSI
        foreach ($this->pegawai as $j => $pegawai) {
            $this->hasil[$j] = [
                'nama_pegawai' => $pegawai['nama'],
                'hasil' => $this->dmin[$j] / ($this->dmin[$j] + $this->dplus[$j]),
            ];
        }

        $this->hasilranking = $this->hasil;

        // MELAKUKAN PENGURUTAN        
        array_multisort(array_column($this->hasilranking, 'hasil'), SORT_DESC, $this->hasilranking);
    }
    public function render()
    {
        return view('livewire.perhitungan-component')->extends('layouts.app')->section('content');
    }
}
