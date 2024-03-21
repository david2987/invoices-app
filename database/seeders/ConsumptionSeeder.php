<?php

namespace Database\Seeders;

use App\Models\Consumption;
use App\Models\Invoice;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Testing\Fakes\Fake;
use Illuminate\Support\Facades\DB;

class ConsumptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // Obtener todos los IDs de la tabla foránea
        $invoices = Invoice::all();
        $foreignIdsService = Service::all()->pluck('id');

        // ejecuta cada factura
        foreach ($invoices as $invoice) {    
            $this->blockInsert($invoice,$faker, $foreignIdsService);
        }

    }

    private function  blockInsert($invoice,$faker, $foreignIdsService)
    {
        // crea los items randoms
        $items  = $faker->numberBetween(1, 10);
        // Crear un bucle para generar usuarios
        for ($i = 1; $i < $items; $i++) {

            // Obtener un ID aleatorio de la tabla Servicio
            $randomIdService = $foreignIdsService->random();

            // obtiene los valores             
            $unit =  $faker->numberBetween(1, 10);
            $priceArr = DB::table('services')->where('id', $randomIdService)->get('price');
            $price = $priceArr[0]->price;

            $period = $faker->numberBetween(0, 60);

            if ($period > 0) {
                $subtotal = $unit * $price * $period;
            } else {
                $subtotal = $unit * $price;
            }

            // Crear un nuevo usuario
            Consumption::create([
                'item' => $i,
                'unit' => $unit,
                'price' => $price,
                'subtotal' => $subtotal,
                'period' => $period,
                'invoice_id' => $invoice['id'],
                'service_id' => $randomIdService
            ]);
        }
    }
}
