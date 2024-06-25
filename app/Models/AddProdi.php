<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddProdi extends Model
{
    use HasFactory;
    protected $table = 'prodi';

    protected $primaryKey = 'id_prodi';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_prodi',
        'nama_prodi',
        'id_fakultas'
    ];
}
