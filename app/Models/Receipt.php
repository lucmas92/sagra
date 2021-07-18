<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;


    public function products()
    {
        return $this->belongsToMany(Product::class, 'receipt_products')
            ->withPivot('quantity', 'price', 'discount');
    }
}
