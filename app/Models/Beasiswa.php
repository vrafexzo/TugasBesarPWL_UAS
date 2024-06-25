<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Beasiswa extends Model
{
    use HasFactory;

    protected $table = 'beasiswa';

    protected $primaryKey = 'id_beasiswa';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_beasiswa',
        'jenis_beasiswa'
    ];

    public function PeriodeBeasiswa(): HasMany
    {
        return $this->hasMany(PeriodeBeasiswa::class, PeriodeBeasiswa::class, 'periode_beasiswa', 'id_beasiswa', 'id_periode');
    }

}
