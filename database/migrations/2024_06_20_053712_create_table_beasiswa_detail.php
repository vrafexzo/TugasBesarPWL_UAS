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
        Schema::create('beasiswa_detail', function (Blueprint $table) {
            $table->string('nrp', 50);
            $table->string('id_beasiswa', 5);
            $table->string('id_periode', 5);
            $table->double('IPK');
            $table->double('poin_portfolio')->nullable();
            $table->integer('status_1');
            $table->integer('status_2');
            $table->timestamps();

            $table->index('nrp');
            $table->index('id_beasiswa');
            $table->index('id_periode');
            $table->foreign('nrp')->references('nrp')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('id_beasiswa')->references('id_beasiswa')->on('beasiswa')->onDelete('cascade');
            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_beasiswa_detail');
    }
};
