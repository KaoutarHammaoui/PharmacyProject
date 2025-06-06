<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquivalentProduct extends Pivot
{
    protected $table = 'equivalents';

    protected $fillable = [
        'product_id',
        'equivalent_id',
    ];
}