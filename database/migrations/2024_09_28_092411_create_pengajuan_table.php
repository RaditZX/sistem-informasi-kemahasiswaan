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
            $table->string("nim",9);
            $table->unsignedBigInteger('beasiswa_id');
            $table->date('tanggal_pengajuan');
            $table->enum('status', ['diterima', 'ditolak', 'diproses'])->default('diproses');
            $table->timestamps();
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('beasiswa_id')->references('id')->on('beasiswa')->onDelete('cascade');
        });

        Schema::create('pengajuan_dokumen', function(Blueprint $table){
            $table->id("dokumen_id");
            $table->unsignedBigInteger("pengajuan_beasiswa_id");
            $table->string("nama_dokumen");
            $table->text("link_dokumen");
            $table->foreign('pengajuan_beasiswa_id')->references('id')->on('pengajuan_beasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('pengajuan_dokumen');
        Schema::dropIfExists('pengajuan_beasiswa');
    }
};
