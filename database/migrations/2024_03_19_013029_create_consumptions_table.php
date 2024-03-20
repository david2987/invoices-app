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
        Schema::create('consumptions', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('item');
            $table->string('description');            
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('service_id');
            $table->integer('unit',12);          
            $table->decimal('price',12,2);
            $table->decimal('subtotal',12,2);
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumptions');
    }
};
