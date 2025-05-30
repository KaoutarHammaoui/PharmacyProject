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
        'total',
        'created_at'
    ];
    
    // Specify table name (optional - Laravel will use 'sales_models' by default)
    protected $table = 'sales';
    
    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Add the sales calculation methods we discussed earlier
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