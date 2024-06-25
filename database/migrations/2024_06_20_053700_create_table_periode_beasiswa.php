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
        Schema::create('periode_beasiswa', function (Blueprint $table) {            
            $table->string('id_periode', 5);
            $table->string('id_beasiswa', 5);
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->text('deskripsi')->nullable();
            $table->string('status', 15);
            $table->timestamps();
            
            $table->primary(['id_periode', 'id_beasiswa']); // Composite primary key

            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('cascade');
            $table->foreign('id_beasiswa')->references('id_beasiswa')->on('beasiswa')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_periode_beasiswa');
    }
};
