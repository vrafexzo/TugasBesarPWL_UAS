<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeasiswaDetail extends Model
{
    use HasFactory;

    
    protected $table = 'beasiswa_detail';
    protected $primaryKey = ['nrp', 'id_periode', 'id_beasiswa'];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'nrp',
        'id_beasiswa',
        'id_periode',
        'IPK',
        'poin_portfolio',
        'status_1',
        'status_2'
    ];

    protected function setKeysForSaveQuery($query)
    {
        foreach ($this->getKeyName() as $key) {
            $query->where($key, '=', $this->getAttribute($key));
        }
        return $query;
    }

}
