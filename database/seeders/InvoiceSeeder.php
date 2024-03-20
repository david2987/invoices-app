<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrPay = array("cash","check","creditCard","debitCard");
        $arrState = array('pending','paid');
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('invoices')->insert([
                'number' => $faker->unique()->numberBetween(1,500000),
                'client' => $faker->name(),
                'date' =>   $faker->date(),
                'total' => rand(0.000001, 100000),
                'paymentOptions' => 'cash',
                "state" => 'pending'
            ]);
        }
    }
}
