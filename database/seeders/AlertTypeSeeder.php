<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AlertType; 

class AlertTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['SOS', 'Alarm', 'Missed_calls'];

        foreach ($types as $type) {
            AlertType::create(['name' => $type]);
        }
    }
}
