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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pekerjaan')->nullable();
            $table->unsignedBigInteger('trainer_pembimbing')->nullable();
            $table->unsignedBigInteger('trainer_peserta')->nullable();
            $table->text('catatan');
            $table->string('foto_dokumentasi');
            $table->enum('peserta_approve',['0','1'])->default('0');
            $table->enum('status',['0','1','2'])->default('0');
            $table->timestamps();

            $table->foreign('id_pekerjaan')->references('id')->on('pekerjaan')->onDelete('cascade');
            $table->foreign('trainer_pembimbing')->references('id')->on('pembimbing')->onDelete('cascade');
            $table->foreign('trainer_peserta')->references('id')->on('peserta')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
