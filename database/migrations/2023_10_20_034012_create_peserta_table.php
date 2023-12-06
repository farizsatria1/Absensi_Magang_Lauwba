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
        Schema::create('peserta', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('asal');
            $table->string('tgl_mulai');
            $table->string('nama_pgl');
            $table->unsignedBigInteger('id_pembimbing')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('ttd');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();

            //Cascade untuk menghapus semua data yang saling terhubung
            $table->foreign('id_pembimbing')->references('id')->on('pembimbing')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
