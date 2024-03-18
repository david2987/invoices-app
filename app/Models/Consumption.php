<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Consumption extends Model
{
    use HasFactory;

    protected $fillable = [
        'item','description','unit','price'
    ];

    public function Invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function ConsumptionType() :BelongsTo
    {
        return $this->belongsTo(ConsumptionsType::class);    
    }
}

