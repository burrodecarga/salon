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
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('parcial');
            $table->text('description')->nullable();
            $table->text('type')->default('multiple');
            $table->string('level')->nullable();
            $table->unsignedBigInteger('asignatura_id')->nullable();
            $table->unsignedBigInteger('modulo_id')->nullable();
            $table->string('asignatura')->nullable();
            $table->string('modulo')->nullable();
            $table->string('lesson')->nullable();
            $table->unsignedBigInteger('lesson_id');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};
