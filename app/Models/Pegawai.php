<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $guarded = '';
    protected $with = ['subkriteria'];
    public $timestamps = false;


    public function subkriteria()
    {
        return $this->belongsToMany(SubKriteria::class);
    }
}
