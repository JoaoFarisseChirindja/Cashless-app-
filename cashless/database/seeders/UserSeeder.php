<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Chefe',
                'phone' => '+258 800 000 000',
                'email' => 'chefe@email.com',
                'password' => bcrypt('123456789'),
                'role' => 'admin',
            ],
            [
                'name' => 'Gerente',
                'phone' => '+258 800 000 000',
                'email' => 'gerente@email.com',
                'password' => bcrypt('123456789'),
                'role' => 'manager',
            ],
            [
                'name' => 'Promotor',
                'phone' => '+258 800 000 000',
                'email' => 'promotor@email.com',
                'password' => bcrypt('123456789'),
                'role' => 'promoter',
            ],
            [
                'name' => 'Funcionário',
                'phone' => '+258 800 000 000',
                'email' => 'leba@email.com',
                'password' => bcrypt('123456789'),
                'role' => 'staff',
            ],
            [
                'name' => 'Fulano',
                'phone' => '+258 800 000 000',
                'email' => 'fulano@email.com',
                'password' => bcrypt('123456789'),
                'role' => 'customer',
            ],
        ]);
    }
}
