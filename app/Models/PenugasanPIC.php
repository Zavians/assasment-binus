<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanPIC extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'penugasan_pic_mata_kuliah';

    // Tentukan kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'pic_user_id', 
        'mata_kuliah_id', 
        'deadline', 
        'status'
    ];


    public function picUser()
    {
        return $this->belongsTo(PIC::class, 'pic_user_id', 'id');
    }

    /**
     * Mendefinisikan relasi dengan model MataKuliah.
     */
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id', 'id');
    }


}
