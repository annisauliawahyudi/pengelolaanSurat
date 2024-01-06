<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'nisa',
                'email' => 'saya@gmail.com',
                'password' => Hash::make('nisa123'),
                'role' => 'staff',
            ],
            [
                'name' => 'wahyu',
                'email' => 'dia@gmail.com',
                'password' => Hash::make('nisa456'),
                'role' => 'guru',
            ],
            
        ];

        user::insert($data);
    }
}
