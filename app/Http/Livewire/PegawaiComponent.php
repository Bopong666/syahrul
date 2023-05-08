<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Pegawai;
use Livewire\Component;
use App\Models\Kriteria;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PegawaiComponent extends Component
{
    use WithPagination;
    public $pengguna;
    public $kriteria;
    public $idTerpilih;
    public $gantiForm = false;
    public $isEdit = false;
    public $options = 'Edit';
    protected $paginationTheme = 'bootstrap';
    public $search = "";

    public function mount()
    {
        if (Auth::user()->level == '2') {
            abort(404);
        }
        $this->kriteria = Kriteria::with('subkriteria')->get();
        $this->pengguna['nama'] = '';
        $this->pengguna['tanggal_masuk'] = '';
    }

    public function render()
    {
        return view('livewire.pegawai-component', ['lists' =>  User::where('level', '2')->where(function ($query) {
            $query->orWhere('nama', 'LIKE', '%' . $this->search . '%');
        })->paginate(10)])->extends('layouts.app')->section('content');
    }

    public function resetInput()
    {
        $this->reset(['pengguna', 'idTerpilih', 'gantiForm', 'isEdit']);
        $this->pengguna['nama'] = '';
        $this->pengguna['tanggal_masuk'] = '';
    }

    public function store()
    {

        $this->validate(
            [
                'pengguna.subkriteria.*' => 'required',
            ],
            [
                'pengguna.subkriteria.*.required' => 'Harap di pilih',
            ],
        );
        ksort($this->pengguna['subkriteria']);
        $data = User::find($this->idTerpilih);

        DB::table('sub_kriteria_user')->where('user_id', $this->idTerpilih)->delete();

        $data->subkriteria()->sync($this->pengguna['subkriteria']);

        session()->flash('message', 'Pegawai berhasil dinilai');
        $this->resetInput();
        $this->dispatchBrowserEvent('modal-store');
    }

    public function edit($id)
    {
        $this->resetInput();

        $this->idTerpilih = $id;

        $data = User::with('subkriteria')->find($id);
        $this->pengguna['nama'] = $data->nama;
        $this->pengguna['tanggal_masuk'] = $data->tanggal_masuk;
        // dd($this->pengguna['nama']);

        foreach ($data['subkriteria'] as $key => $item) {
            $this->pengguna['subkriteria'][$key] = $item->id;
        }

        // dd($this->kriteria, $this->pengguna['subkriteria']);
        $this->options = 'Edit';

        $this->dispatchBrowserEvent('modal-edit');
    }
}
