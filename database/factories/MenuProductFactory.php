<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\MenuProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'menu_id' => Menu::first()->id,
            'product_id' => Product::all()->random()->id,
        ];
    }
}
