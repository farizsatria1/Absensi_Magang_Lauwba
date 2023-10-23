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
            $table->date('tgl_mulai')->default(now());;
            $table->unsignedBigInteger('id_pembimbing')->nullable();
            $table->string('username');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_pembimbing')->references('id')->on('pembimbing');
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
