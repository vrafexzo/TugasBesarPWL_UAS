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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nrp', 50)->primary();
            $table->string('nama', 50)->nullable();
            $table->string('alamat', 50)->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('tanggal_lahir', 50)->nullable();
            $table->string('telepon', 50)->nullable();
            $table->string('agama', 50)->nullable();
            $table->string('id_prodi', 5);
            $table->double('IPK')->nullable();
            $table->timestamps();

            $table->foreign('id_prodi')->references('id_prodi')->on('prodi')->onDelete('cascade');
            $table->foreign('nrp')->references('nrp')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_mahasiswa');
    }
};
