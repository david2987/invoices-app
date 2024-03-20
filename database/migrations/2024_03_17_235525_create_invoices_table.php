<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique();
            $table->string('client');                     
            $table->date('date');
            $table->decimal('total',18,6);
            $table->enum('paymentOptions', [
                "cash" => "cash", "check" => "check" , "creditCard" => "credit card" , "debitCard" => "debit card"
            ])->nullable(true);               
            $table->enum('state',[
                'pending' => 'pending',
                'paid' => 'paid'
            ]);
            $table->timestamps();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
