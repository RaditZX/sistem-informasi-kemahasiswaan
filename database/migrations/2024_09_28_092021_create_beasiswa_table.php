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
        Schema::create('beasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_beasiswa');
            $table->text('deskripsi');
            $table->enum('jenis_waktu_beasiswa',['current','upcoming','last']);
            $table->enum('tipe_beasiswa',['kipk','internal','eksternal']);
            $table->enum('jenis_beasiswa', ['full', 'half']); // enum jenis_beasiswa
            $table->integer('kuota');
            $table->string('sumber');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->timestamps();
        });

        // Table untuk syarat_beasiswa (pivot table)
        Schema::create('syarat_beasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('beasiswa_id');
            $table->string('syarat');
            $table->timestamps();

            $table->foreign('beasiswa_id')->references('id')->on('beasiswa')->onDelete('cascade');
        });

        // Table untuk benefit_beasiswa (pivot table)
        Schema::create('benefit_beasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('beasiswa_id');
            $table->string('benefit');
            $table->text('deskripsi_benefit');
            $table->timestamps();


            $table->foreign('beasiswa_id')->references('id')->on('beasiswa')->onDelete('cascade');
        });

        // Table untuk syarat_dokumen (pivot table)
        Schema::create('syarat_dokumen', function (Blueprint $table) {
            $table->unsignedBigInteger('beasiswa_id');
            $table->string('dokumen');
            $table->text('deskripsi_dokumen');
            $table->timestamps();

            $table->foreign('beasiswa_id')->references('id')->on('beasiswa')->onDelete('cascade');
        });

        Schema::create('poster_beasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('beasiswa_id');
            $table->text('link_poster');
            $table->timestamps();

            $table->foreign('beasiswa_id')->references('id')->on('beasiswa')->onDelete('cascade');
        });

        // Table untuk jenjang_pendidikan (pivot table)
        Schema::create('jenjang_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('beasiswa_id');
            $table->string('jenjang');
            $table->timestamps();

            $table->foreign('beasiswa_id')->references('id')->on('beasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat_dokumen');
        Schema::dropIfExists('benefit_beasiswa');
        Schema::dropIfExists('syarat_beasiswa');
        Schema::dropIfExists('jenjang_pendidikan');
        Schema::dropIfExists('beasiswa');
    }
};
