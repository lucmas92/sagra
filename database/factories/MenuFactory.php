<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text('100'),
            'start_date' => $this->faker->dateTimeBetween("-1 day", "+5 days"),
            'end_date' => $this->faker->dateTimeBetween("-1 day", "+5 days"),
            'enabled' => $this->faker->boolean(10),
        ];
    }
}
