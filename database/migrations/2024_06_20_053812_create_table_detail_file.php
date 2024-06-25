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
        Schema::create('detail_file', function (Blueprint $table) {
            $table->string('id_mahasiswa', 5);
            $table->string('id_periode', 5);
            $table->string('id_beasiswa', 5);
            $table->string('id_jenis_doc', 5);
            $table->string('path', 50);
            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('beasiswa_detail')->onDelete('cascade');
            $table->foreign('id_beasiswa')->references('id_beasiswa')->on('beasiswa_detail')->onDelete('cascade');
            $table->foreign('id_periode')->references('id_periode')->on('beasiswa_detail')->onDelete('cascade');
            $table->foreign('id_jenis_doc')->references('id_jenis_doc')->on('jenis_doc')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_detail_file');
    }
};
