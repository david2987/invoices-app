<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use  App\Models\Service;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','surname','email','phone','address','city','state'
    ];
 
    public function Invoice() : HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
