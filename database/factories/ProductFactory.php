<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text(20),
            'price' => $this->faker->randomFloat(2, 0.1, 50),
            'department_id' => Department::all()->random()->id,
            'enabled' => $this->faker->boolean(80)
        ];
    }
}
