<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'enabled'
    ];

    public function setEnabledAttribute($enabled)
    {
        Menu::where('id', '!=', $this->id)->update(['enabled' => false]);

        $this->attributes['enabled'] = $enabled;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'menu_products');
    }

    public function scopeActive($query)
    {
        return $query->where('enabled','=', true);
    }
}
