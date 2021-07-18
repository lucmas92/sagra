<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['description','discount','enabled'];
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('enabled','=', true);
    }
}
