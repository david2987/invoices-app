<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Consumption extends Model
{
    use HasFactory;

    protected $fillable = [
        'item','unit','price','period','subtotal',"invoice_id","service_id"
    ];

    public function Invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function Service() :HasMany
    {
        return $this->hasMany(Service::class);
    }



}

