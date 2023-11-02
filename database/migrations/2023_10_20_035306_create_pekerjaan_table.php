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
        Schema::create('pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peserta');
            $table->string('judul');
            $table->timestamps();

            $table->foreign('id_peserta')->references('id')->on('peserta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pekerjaan');
    }
};
