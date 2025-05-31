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
        Schema::create('part_scooter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('part_id')->constrained()->onDelete('cascade');
            $table->foreignId('scooter_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Zorg ervoor dat een onderdeel maar één keer aan een scooter kan worden gekoppeld
            $table->unique(['part_id', 'scooter_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_scooter');
    }
};
