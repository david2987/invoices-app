<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consumption;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Invoice extends Model
{
    use HasFactory;

    protected $fillable= [
        'number' , 'client','price','date','total','paymentOptions' , 'state'
    ];

    public function Consumption() :HasMany
    {
        return $this->hasMany(Consumption::class);
    }



}
