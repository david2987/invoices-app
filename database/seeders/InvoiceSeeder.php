<?php

namespace Database\Seeders;

use Faker\Core\Number;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i < 20 ; $i++) { 
            DB::table('invoices')->insert([
                'number' => rand(1,100),            
                'client' => Str::random(10),
                'date' => now(),
                'total' => rand(1,15000000)
            ]);
        }
        
    }
}

