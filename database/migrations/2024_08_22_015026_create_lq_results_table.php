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
        Schema::create('lq_results', function (Blueprint $table) {
            $table->id();
            $table->string('sektor');
            $table->decimal('lq_2019', 10, 4)->nullable();
            $table->decimal('lq_2020', 10, 4)->nullable();
            $table->decimal('lq_2021', 10, 4)->nullable();
            $table->decimal('lq_2022', 10, 4)->nullable();
            $table->decimal('lq_2023', 10, 4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lq_results');
    }
};
