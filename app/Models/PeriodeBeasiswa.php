<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PeriodeBeasiswa extends Model
{
    use HasFactory;
    protected $table = 'periode_beasiswa';

    protected $primaryKey = ['id_periode', 'id_beasiswa'];
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_periode',
        'id_beasiswa',
        'tanggal_mulai',
        'tanggal_berakhir',
        'deskripsi',
        'status'
    ];
    
    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }

    public function beasiswa(): BelongsTo
    {
        return $this->belongsTo(Beasiswa::class);
    }

    
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }


    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        return $this->original[$keyName] ?? $this->getAttribute($keyName);
    }

}
