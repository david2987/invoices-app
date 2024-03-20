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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->decimal('price',18,6);          
            $table->enum('type', [
                'Monthly'=> 'Monthly',
                'perUnit' => 'perUnit',
                'perMinute' => 'perMinute',
                'perLetter' => 'perLetter'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
