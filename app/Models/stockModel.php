<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stockModel extends Model
{
    use HasFactory;
    protected $table='stock';
    protected $primaryKey='product_id';
}
