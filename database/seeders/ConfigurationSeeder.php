<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Configuration::where('key', 'USER_ATTENDANCE_DISPLAY_LIMIT')->count() === 0) {
            Configuration::create([
                'key' => 'USER_ATTENDANCE_DISPLAY_LIMIT',
                'value' => '7',
            ]);
        }
    }
}
