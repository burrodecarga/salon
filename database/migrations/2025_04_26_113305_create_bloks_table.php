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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->text('option_0');
            $table->text('option_1');
            $table->text('option_2')->default('');
            $table->text('option_3')->default('');
            $table->text('option_4')->default('');
            $table->unsignedBigInteger('question_id')->nullable();
            $table->unsignedBigInteger('examen_id')->nullable();
            // $table->foreign('examen_id')->references('id')->on('examens')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocks');
    }
};
