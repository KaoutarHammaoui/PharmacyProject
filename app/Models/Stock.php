<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantite',
        'date_expiration'
    ];

    protected $casts = [
        'date_expiration' => 'date'
    ];

    // Relationship with product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}