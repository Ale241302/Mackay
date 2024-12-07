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
        Schema::table('users', function (Blueprint $table) {
            $table->string('apellido')->nullable();
            $table->string('tipo_documento')->nullable();
            $table->string('numero_documento')->nullable();
            $table->string('numero_telefonico')->nullable();
            $table->string('tipo_usuario')->nullable();
            $table->string('estado')->default('Activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['apellido', 'tipo_documento', 'numero_documento', 'numero_telefonico', 'tipo_usuario', 'estado']);
        });
    }
};
