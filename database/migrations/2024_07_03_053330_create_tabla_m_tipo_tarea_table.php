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
        Schema::create('tablaMTipoTarea', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idTarea')->constrained('tasks')->onDelete('cascade');
            $table->foreignId('idTipo')->constrained('tipoTarea')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tablaMTipoTarea');
    }
};
