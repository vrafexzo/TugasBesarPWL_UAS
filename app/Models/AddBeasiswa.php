<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddBeasiswa extends Model
{
    use HasFactory;

    protected $table = 'beasiswa'; // Sesuaikan dengan nama tabel yang sudah dibuat

    protected $fillable = [
        'periode',
        'jenis_beasiswa',
        'nama_beasiswa',
        'asal_beasiswa',
        'tanggal_mulai',
        'tanggal_berakhir',
        'jatuh_tempo',
        'deskripsi',
    ];

    // Tambahkan atribut-atribut atau metode tambahan sesuai kebutuhan
}
