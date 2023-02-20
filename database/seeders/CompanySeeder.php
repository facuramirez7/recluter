<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'Grupo Tecnolog',
            'description' => 'Maquinaria pesada',
            'photo' => '1676866184.png',
            'active' => 1,
        ]);
    }
}
