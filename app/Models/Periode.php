<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'periode';
    protected $primaryKey = 'id_periode';
    public $incrementing = false;
    
    protected $fillable = [
        'id_periode',
        'nama_periode'
    ];

    public function PeriodeBeasiswa(): HasMany
    {
        return $this->hasMany(PeriodeBeasiswa::class, 'periode_beasiswa', 'id_periode', 'id_beasiswa');
    }

}

