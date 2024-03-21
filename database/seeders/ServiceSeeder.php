<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert(
            [
                'description' => 'Storage service',
                'price' => 0.03,
                'type' => 'perUnit'
            ]);

            DB::table('services')->insert(
            [
                'description' => 'Proxy service',
                'price' => 0.03,
                'type' => 'perMinute'
            ]);
            DB::table('services')->insert(
            [
                'description' => 'Speech translation service',
                'price' => 0.00003,
                'type' => 'perLetter'
            ]);
            DB::table('services')->insert(
            [
                'description' => 'BackOffice service',
                'price' => 7,
                'type' => 'Monthly'
            ]);        
    }
}
