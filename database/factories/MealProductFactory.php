<?php

namespace Database\Factories;

use App\Models\Meal;
use App\Models\MealProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class MealProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MealProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'meal_id' => Meal::all()->random()->id,
            'product_id' => Product::all()->random()->id,
        ];
    }
}
