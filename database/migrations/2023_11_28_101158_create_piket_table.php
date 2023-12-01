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
        Schema::create('piket', function (Blueprint $table) {
            $table->id();
            $table->string('hari')->nullable();
            $table->unsignedBigInteger('id_pembimbing')->nullable();
            $table->unsignedBigInteger('id_peserta')->nullable();
            $table->timestamps();

            $table->foreign('id_pembimbing')->references('id')->on('pembimbing')->onDelete('cascade');
            $table->foreign('id_peserta')->references('id')->on('peserta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piket');
    }
};
