<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserComponent extends Component
{

    use WithPagination;
    public $pengguna;
    public $idTerpilih, $idHapus;
    public $options = 'Tambah';
    protected $paginationTheme = 'bootstrap';
    public $search = "";


    public function mount()
    {
        if (Auth::user()->level != '0') {
            abort(404);
        }
    }
    public function render()
    {
        // return view('livewire.pegawai-component', ['lists' => Pegawai::paginate(10)])->extends('layouts.app')->section('content');
        return view('livewire.user-component', ['lists' =>  User::where('level', '!=', '0')->where(function ($query) {
            $query->orWhere('nama', 'LIKE', '%' . $this->search . '%');
        })->paginate(10)])->extends('layouts.app')->section('content');
    }



    public function tambah()
    {
        $this->pengguna['username'] = '';
        $this->pengguna['nama'] = '';
        $this->pengguna['level'] = '';
        $this->pengguna['tanggal_masuk'] = '';
        $this->pengguna['password'] = '';

        $this->options = 'Tambah';
    }
    public function resetInput()
    {
        $this->reset(['pengguna', 'idTerpilih', 'idHapus']);
    }

    public function store()
    {

        if ($this->idTerpilih) {
            $dataPengguna = $this->validate([
                'pengguna.username' => 'required|string|unique:user,username,' . $this->idTerpilih,
                'pengguna.nama' => 'required|regex:/^[a-zA-Z\s]*$/',
                'pengguna.level' => 'required',
                'pengguna.tanggal_masuk' => 'required|date',
            ], [
                'pengguna.*.required' => 'Harap di isi',
                'pengguna.*.regex' => 'Tidak boleh ada angka',
                'pengguna.username.unique' => 'Username ini sudah di pakai',
            ]);
            if ($this->pengguna['password'] != '') {
                $dataPengguna['pengguna']['password'] = Hash::make($this->pengguna['password']);
            }
        } else {
            $dataPengguna = $this->validate([
                'pengguna.username' => 'required|string|unique:user,username',
                'pengguna.nama' => 'required|regex:/^[a-zA-Z\s]*$/',
                'pengguna.level' => 'required',
                'pengguna.tanggal_masuk' => 'required|date',
                'pengguna.password' => 'required',
            ], [
                'pengguna.*.required' => 'Harap di isi',
                'pengguna.*.regex' => 'Tidak boleh ada angka',
                'pengguna.username.unique' => 'Username ini sudah di pakai',
            ]);
            $dataPengguna['pengguna']['password'] = Hash::make($dataPengguna['pengguna']['password']);
        }
        $data = User::updateOrCreate(['id' => $this->idTerpilih], $dataPengguna['pengguna']);


        session()->flash('message', $this->idTerpilih ? 'Data berhasil dirubah' : 'Data berhasil ditambah');
        $this->resetInput();
        $this->dispatchBrowserEvent('modal-store');
    }

    public function edit($id)
    {
        $this->resetInput();

        $this->idTerpilih = $id;

        $data = User::find($id);
        $this->pengguna['username'] = $data->username;
        $this->pengguna['nama'] = $data->nama;
        $this->pengguna['level'] = $data->level;
        $this->pengguna['tanggal_masuk'] = $data->tanggal_masuk;
        $this->pengguna['password'] = '';
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
        User::find($id)->delete();
        $this->dispatchBrowserEvent('modal-delete');
        session()->flash('message', 'Data berhasil di hapus');
    }
}
