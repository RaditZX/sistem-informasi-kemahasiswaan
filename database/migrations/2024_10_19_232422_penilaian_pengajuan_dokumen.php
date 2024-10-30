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
        Schema::create('penilaian_dokumen', function (Blueprint $table) {
            $table->string('nip',18);
            $table->unsignedBigInteger('dokumen_id');
            $table->text("komentar");
            $table->enum("status",["diterima","ditolak","direvisi"]);
            $table->timestamps();

            $table->foreign('dokumen_id')->references('dokumen_id')->on('pengajuan_dokumen')->onDelete('cascade');
            $table->foreign('nip')->references('nip')->on('reviewer')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_dokumen');
    }
};
