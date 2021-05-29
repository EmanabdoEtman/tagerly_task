<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'products';
    protected $guarded = array();

    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    } 
}
