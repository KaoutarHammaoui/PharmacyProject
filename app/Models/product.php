<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'codeBar', 
        'withRecepie',
        'threshold',
        'description'
    ];

    protected $casts = [
        'withRecepie' => 'boolean'
    ];

    // Relationship with stocks
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    // Relationship with sales
    public function sales()
    {
        return $this->hasMany(salesModel::class);
    }

    // Get total available quantity from all stock entries
    public function getTotalQuantityAttribute()
    {
        return $this->stocks()->sum('quantite');
    }
    // app/Models/Product.php

public function equivalents()
{
    return $this->belongsToMany(Product::class, 'equivalent_products', 'product_id', 'equivalent_id');
}

}