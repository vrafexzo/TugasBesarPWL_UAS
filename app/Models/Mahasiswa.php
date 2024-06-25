<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nrp';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nrp',
        'nama',
        'alamat',
        'kota',
        'tanggal_lahir',
        'telepon',
        'agama',
        'id_prodi',
        'IPK',
    ];

    // public function prodi()
    // {
    //     return $this->belongsTo(AddProdi::class, 'id_prodi', 'id_prodi');
    // }

}
