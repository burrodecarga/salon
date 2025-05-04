<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prototipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('examen_id')->nullable();
            $table->unsignedBigInteger('asignatura_id')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->unsignedBigInteger('option_id')->nullable();
            $table->unsignedBigInteger('true')->nullable();
            $table->unsignedBigInteger('selected')->default(0);
            $table->text('answer');
            $table->text('question');
            $table->text('option_0');
            $table->text('option_1');
            $table->text('option_2')->nullable();
            $table->text('option_3')->nullable();
            $table->text('option_4')->nullable();
            $table->integer('option_0_value')->default(0);
            $table->integer('option_1_value')->default(0);
            $table->integer('option_2_value')->default(0);
            $table->integer('option_3_value')->default(0);
            $table->integer('option_4_value')->default(0);
            $table->foreign('examen_id')->references('id')->on('examens')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prototipos');
    }
};
