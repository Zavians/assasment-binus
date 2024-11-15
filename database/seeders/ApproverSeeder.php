<?php

namespace Database\Seeders;

use App\Models\Approver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class ApproverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Approver::create([
            'id' => Str::uuid(),
            'status' => 'Pending',
        ]);
        
        
    }
}
