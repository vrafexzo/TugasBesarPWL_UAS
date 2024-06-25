<?php

use Illuminate\Support\Facades\DB;
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
        
        DB::statement("
            CREATE VIEW view_periode_beasiswa AS
            SELECT
                pb.id_periode AS id_periode,
                pb.id_beasiswa AS id_beasiswa,
                p.nama_periode AS nama_periode,
                b.jenis_beasiswa AS jenis_beasiswa,
                pb.tanggal_mulai AS tanggal_mulai,
                pb.tanggal_berakhir AS tanggal_berakhir,
                pb.deskripsi AS deskripsi,
                pb.status AS status
            FROM
                periode_beasiswa pb
            JOIN
                periode p ON pb.id_periode = p.id_periode
            JOIN
                beasiswa b ON pb.id_beasiswa = b.id_beasiswa;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_beasiswa_periode");
    }
};
