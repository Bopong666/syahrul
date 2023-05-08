<?php

namespace App\Http\Livewire;

use App\Models\Pegawai;
use Livewire\Component;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class KriteriaComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nama, $bobot, $tipe, $subkriteria;
    public $idTerpilih, $idHapus;
    public $options = 'Tambah';


    public function mount()
    {
        $this->subkriteria = [
            [
                'nama_sub_kriteria' => '',
                'bobot_sub_kriteria' => '',
            ],
            [
                'nama_sub_kriteria' => '',
                'bobot_sub_kriteria' => '',
            ],
            [
                'nama_sub_kriteria' => '',
                'bobot_sub_kriteria' => '',
            ],
        ];
    }
    public function render()
    {

        return view('livewire.kriteria-component', ['lists' =>  Kriteria::paginate(10)])->extends('layouts.app')->section('content');
    }

    public function tambah()
    {
        $this->resetInput();
        $this->subkriteria = [
            [
                'nama_sub_kriteria' => '',
                'bobot_sub_kriteria' => '',
            ],
            [
                'nama_sub_kriteria' => '',
                'bobot_sub_kriteria' => '',
            ],
            [
                'nama_sub_kriteria' => '',
                'bobot_sub_kriteria' => '',
            ],
        ];
    }

    public function tambahSubKriteria()
    {
        array_push(
            $this->subkriteria,
            [
                'nama_sub_kriteria' => '',
                'bobot_sub_kriteria' => '',
            ],
        );
    }

    public function hapusSubKriteria($id)
    {
        array_splice($this->subkriteria, $id, 1);
    }
    public function resetInput()
    {
        $this->reset(['nama', 'bobot', 'tipe', 'idTerpilih', 'idHapus', 'options']);
    }

    public function store()
    {


        if ($this->idTerpilih) {
            $data = $this->validate(
                [
                    'nama' => 'required|string',
                    'bobot' => 'required|numeric',
                    'tipe' => 'required',
                ],
                [
                    '*.required' => 'Harap mengisi kolom ini',
                    'bobot.numeric' => 'Harap mengisi angka',
                    'kode.unique' => 'Kode Kriteria sudah ada',
                ],
            );
        } else {
            $data = $this->validate(
                [
                    'nama' => 'required|string',
                    'bobot' => 'required|numeric',
                    'tipe' => 'required',
                ],
                [
                    '*.required' => 'Harap mengisi kolom ini',
                    'bobot.numeric' => 'Harap mengisi angka',
                    'kode.unique' => 'Kode Kriteria sudah ada',
                ],
            );
        }

        $this->validate(
            [
                'subkriteria.*.nama_sub_kriteria' => 'required|string',
                'subkriteria.*.bobot_sub_kriteria' => 'required|numeric|distinct',
            ],
            [
                'subkriteria.*.*.required' => 'Harap mengisi kolom ini',
                'subkriteria.*.bobot_sub_kriteria.numeric' => 'Harap mengisi angka',
                'subkriteria.*.bobot_sub_kriteria.distinct' => 'Bobot sub kriteria tidak boleh sama',
            ]
        );

        $data['bobot'] = $data['bobot'] / 100;

        if ($this->idTerpilih) {
            $data = Kriteria::updateOrCreate(['id' => $this->idTerpilih], $data);
        } else {
            $data = Kriteria::create($data);
        }
        $idSudahAda = [];
        if ($this->idTerpilih) {
            foreach ($this->subkriteria as $key => $item) {
                $item['kriteria_id'] = $data->id;
                if (isset($item['id']) && $item['id'] != null) {
                    $idSudahAda[] = $item['id'];
                }
            }
            SubKriteria::where('kriteria_id', $data->id)->whereNotIn('id', $idSudahAda)->delete();
            foreach ($this->subkriteria as $key => $item) {
                $item['kriteria_id'] = $data->id;
                if (isset($item['id']) && $item['id'] != null) {
                    SubKriteria::updateOrCreate(['id' => $item['id']], $item);
                } else {
                    SubKriteria::create($item);
                }
            }
        } else {
            foreach ($this->subkriteria as $key => $item) {
                $item['kriteria_id'] = $data->id;
                if ($key == 0) {
                    $dataSubKriteriaPertama = SubKriteria::create($item);
                } else {
                    SubKriteria::create($item);
                }
            }

            $dataPegawai = Pegawai::all();


            foreach ($dataPegawai as $key => $item) {
                $datamasuk['pegawai_id'] = $item->id;
                $datamasuk['sub_kriteria_id'] = $dataSubKriteriaPertama->id;
                DB::table('pegawai_sub_kriteria')->insert($datamasuk);
            }
        }

        session()->flash('message', $this->idTerpilih ? 'Data berhasil dirubah' : 'Data berhasil ditambah');
        $this->resetInput();
        $this->dispatchBrowserEvent('modal-store');
    }

    public function edit($id)
    {
        $this->resetInput();
        $this->idTerpilih = $id;
        $data = Kriteria::find($id);
        $this->nama = $data->nama;
        $this->bobot = $data->bobot * 100;
        $this->tipe = $data->tipe;
        foreach ($data->subkriteria as $key => $item) {
            $this->subkriteria[$key] = [
                'id' => $item->id,
                'nama_sub_kriteria' => $item->nama_sub_kriteria,
                'bobot_sub_kriteria' => $item->bobot_sub_kriteria,
            ];
        }
        $this->options = 'Edit';

        $this->dispatchBrowserEvent('modal-edit');
    }

    public function hapusKonfirmasi($id)
    {
        $this->idHapus = $id;
        $this->dispatchBrowserEvent('modal-deleteConfirm');
    }

    public function hapus($id)
    {
        $dataKriteria = Kriteria::find($id)->delete();
        session()->flash('message', 'Data berhasil dihapus');
        $this->dispatchBrowserEvent('modal-delete');
    }
}
