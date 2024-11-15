<?php

namespace Database\Seeders;

use App\Models\PIC;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PICSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PIC::create([
            'id' => \Illuminate\Support\Str::uuid(),
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '081234567890',
        ]);

        PIC::create([
            'id' => \Illuminate\Support\Str::uuid(),
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'phone' => '089876543210',
        ]);

        PIC::create([
            'id' => \Illuminate\Support\Str::uuid(),
            'name' => 'Charlie Brown',
            'email' => 'charlie.brown@example.com',
            'phone' => '087654321098',
        ]);
    }
}
