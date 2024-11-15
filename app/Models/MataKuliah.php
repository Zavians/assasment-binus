<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'mata_kuliah';

    
    protected $fillable = [
        'name',
        'nama_dosen',
        'jumlah_sks',
        'deskripsi',
    ];

    public function ujian()
    {
        return $this->hasMany(Ujian::class, 'mata_kuliah_id', 'id');
    }

    public function penugasanPic()
    {
        return $this->hasMany(PenugasanPIC::class, 'mata_kuliah_id', 'id');
    }
}
