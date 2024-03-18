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
        Schema::create('consumptions_types', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->decimal('cost');            
            $table->enum('type',[
                'Monthly' =>'Monthly',
                'perUnit' => 'Per Unit',
                'perMinute' => 'Per Minute',
                'perLetter' => 'Per Letter'
            ]);
            $table->timestamps();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumptions_types');
    }
};
