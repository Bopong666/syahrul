<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';
    protected $guarded = '';
    protected $with = ['subkriteria'];
    public $timestamps = false;
    public $primaryKey = 'id';
    public $incrementing = true;

    public function subkriteria()
    {
        return $this->hasMany(SubKriteria::class);
    }
}
