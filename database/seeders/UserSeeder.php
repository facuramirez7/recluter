<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Recluter',
            'email' => 'recluter@example.com',
            'company_id' => 1,
            'password' => bcrypt('12345678'),
        ])->assignRole('Recluter');

        User::create([
            'name' => 'Candidate',
            'email' => 'candidate@example.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Candidate');
    }
}
