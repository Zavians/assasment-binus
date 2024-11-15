<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PIC extends Model
{
    use HasFactory, HasUuids;

    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'pic_user';

    // Menentukan kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
    ];

    public function penugasanMataKuliah()
    {
        return $this->hasMany(PenugasanPIC::class, 'pic_user_id', 'id');
    }
}
