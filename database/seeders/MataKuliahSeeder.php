<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan data dummy mata kuliah
        DB::table('mata_kuliah')->insert([
            [
                'id' => \Illuminate\Support\Str::uuid(),  // UUID untuk id
                'name' => 'Pemrograman Web',
                'nama_dosen' => 'Dr. John Doe',
                'jumlah_sks' => 3,
                'deskripsi' => 'Mata kuliah ini mengajarkan tentang dasar-dasar pemrograman web menggunakan PHP dan Laravel.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'name' => 'Basis Data',
                'nama_dosen' => 'Prof. Jane Smith',
                'jumlah_sks' => 4,
                'deskripsi' => 'Mata kuliah yang membahas tentang konsep dasar basis data, desain database, dan SQL.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'name' => 'Algoritma dan Struktur Data',
                'nama_dosen' => 'Dr. Michael Lee',
                'jumlah_sks' => 3,
                'deskripsi' => 'Mata kuliah ini membahas algoritma dasar dan struktur data yang digunakan dalam pengembangan perangkat lunak.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'name' => 'Jaringan Komputer',
                'nama_dosen' => 'Dr. Sarah Miller',
                'jumlah_sks' => 3,
                'deskripsi' => 'Mata kuliah ini memberikan pemahaman tentang prinsip-prinsip dasar jaringan komputer.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
