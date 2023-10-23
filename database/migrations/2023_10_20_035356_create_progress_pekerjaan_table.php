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
        Schema::create('progress_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pekerjaan');
            $table->unsignedBigInteger('id_progress');
            $table->timestamps();

            $table->foreign('id_pekerjaan')->references('id')->on('pekerjaan');
            $table->foreign('id_progress')->references('id')->on('progress_magang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_pekerjaan');
    }
};
