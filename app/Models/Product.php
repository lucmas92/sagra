<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'enabled'];

    public function meal()
    {
        return $this->belongsToMany(Meal::class, 'meal_products');
    }

    /**
     * @return HasMany
     */
    public function warehouse(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }

    public function menus(){
        return $this->belongsToMany(Menu::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
