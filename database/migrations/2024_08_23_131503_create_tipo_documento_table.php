<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_documento', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
        // Insert initial data
        DB::table('tipo_documento')->insert([
            ['nombre' => 'DNI', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cédula de Extranjería', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Pasaporte', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_documento');
    }
};
