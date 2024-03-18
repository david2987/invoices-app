<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consumption;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Invoice extends Model
{
    use HasFactory;

    protected $fillable= [
        'number','description','price','date','total'
    ];

    public function Consumption() :HasMany
    {
        return $this->hasMany(Consumption::class);
    }

    public function Client() : BelongsTo
    {
        return $this->belongsTo(Client::class);
    }


}
