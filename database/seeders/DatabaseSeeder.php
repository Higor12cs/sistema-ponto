<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::create([
        //     'name' => 'Administrador',
        //     'username' => 'adm',
        //     'password' => bcrypt('adm'),
        //     'is_admin' => true,
        //     'password_on_login' => false,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // \App\Models\User::create([
        //     'name' => 'User',
        //     'username' => 'user',
        //     'password' => bcrypt('user'),
        //     'is_admin' => false,
        //     'password_on_login' => false,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // \App\Models\User::factory(10)->create();
        // \App\Models\Employee::factory(50)->create();

        $this->call(ConfigurationSeeder::class);
    }
}
