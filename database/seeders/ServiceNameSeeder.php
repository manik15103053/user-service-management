<?php

namespace Database\Seeders;

use App\Models\ServiceName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceName::insert([
            ['name' => 'Service One'],
            ['name' => 'Service Two'],
            ['name' => 'Service Three'],
            ['name' => 'Service Four'],
            ['name' => 'Service Five'],
            ['name' => 'Service Six'],
        ]);
    }
}
