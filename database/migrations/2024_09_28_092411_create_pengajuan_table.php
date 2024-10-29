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
        Schema::create('pengajuan_beasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengguna_id');
            $table->unsignedBigInteger('beasiswa_id');
            $table->date('tanggal_pengajuan');
            $table->enum('status', ['diterima', 'ditolak', 'diproses'])->default('diproses');
            $table->timestamps();

            $table->foreign('pengguna_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('beasiswa_id')->references('id')->on('beasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_beasiswa');
    }
};
