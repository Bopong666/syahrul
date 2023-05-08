<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminComponent extends Component
{
    public $username, $nama, $password, $password_confirmation, $current_password;

    public $gantiForm = false;
    public function mount()
    {
        $this->username = Auth::user()->username;
        $this->nama = Auth::user()->nama;
    }

    public function render()
    {
        return view('livewire.admin-component')->extends('layouts.app')->section('content');
    }

    public function gantiFormIni()
    {
        $this->gantiForm = !$this->gantiForm;
    }
    public function store()
    {

        $data = $this->validate([
            'username' => 'required|string|max:30|unique:user,username,' . Auth::user()->id,
            'nama' => 'required|regex:/^[a-zA-Z\s]*$/',
            'current_password' => 'required|current_password:web',
            'password' => 'confirmed',
        ], [
            'nama.regex' => 'Tidak boleh ada angka',
            'username.unique' => 'Username sudah terdaftar',
            'current_password.current_password' => 'Password salah',
            'password.confirmed' => 'Password tidak sama',
            '*.required' => 'Harap di isi untuk melakukan perubahan',
        ]);
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        User::find(Auth::user()->id)->update($data);
        $this->reset(['password', 'current_password', 'password_confirmation']);
        return redirect(request()->header('Referer'))->with('message', 'User updated successfully.');
    }

    public function edit()
    {
        $this->gantiForm = !$this->gantiForm;
    }
}
