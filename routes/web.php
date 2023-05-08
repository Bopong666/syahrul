<?php

use Illuminate\Http\Request;
use App\Http\Livewire\UserComponent;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\AdminComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PegawaiComponent;
use App\Http\Livewire\KriteriaComponent;
use App\Http\Livewire\PerhitunganComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    if (Auth::attempt(['username' => $request['username'], 'password' => $request['password']])) {
        $request->session()->regenerate();

        return redirect()->intended('/');
    }
    return back()->with(
        'loginError',
        'Username atau Password salah',
    );
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/kriteria', KriteriaComponent::class)->name('kriteria');
    Route::get('/perhitungan', PerhitunganComponent::class)->name('perhitungan');
    Route::get('/pegawai', PegawaiComponent::class)->name('pegawai');
    Route::get('/pengguna', UserComponent::class)->name('pengguna');
    Route::get('/profil', AdminComponent::class)->name('profil');
});
