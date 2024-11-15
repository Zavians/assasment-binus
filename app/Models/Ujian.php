<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'ujian';

    
    protected $fillable = [
        'mata_kuliah_id',
        'durasi_ujian',
        'tanggal_ujian',
    ];

  
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id', 'id');
    }
}
