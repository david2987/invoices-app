<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class ConsumptionsType extends Model
{
    use HasFactory;

    protected $fillable = ['description' , 'cost' , 'type'];

    public function Consumption() :HasMany
    {
        return $this->hasMany(Consumption::class);    
    }
}
