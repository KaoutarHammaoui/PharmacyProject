<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesModel extends Model
{
    use HasFactory;
    
    // Specify which fields can be mass assigned
    protected $fillable = [
        'user_id',
        'user_name', 
        'product_id',       // Change to product_id
        'quantity_sold',    
        'total',
        'created_at'
    ];
    
    // Specify table name
    protected $table = 'sales';
    
    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    // Add the sales calculation methods
    public static function dailySales($date = null)
    {
        $date = $date ?? now()->toDateString();
        return self::whereDate('created_at', $date)->sum('total');
    }
    
    public static function monthlySales($month = null, $year = null)
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;
        
        return self::whereMonth('created_at', $month)
                   ->whereYear('created_at', $year)
                   ->sum('total');
    }
}