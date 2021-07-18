<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Discount;
use App\Models\Meal;
use App\Models\MealProduct;
use App\Models\Menu;
use App\Models\MenuProduct;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Meal::create(
            [
                'name' => 'Bevande',
                'position' => 1
            ]
        );
        Meal::create(
            [
                'name' => 'Primi Piatti',
                'position' => 2
            ]
        );
        Meal::create(
            [
                'name' => 'Secondi Piatti',
                'position' => 3
            ]
        );

        User::query()->forceDelete();
        User::create([
            'name' => 'luca',
            'email' => 'admin@sagra.it',
            'password' => Hash::make('sagra')
        ]);

        Discount::create([
            'description' => 'Volontari',
            'discount' => '50',
        ]);
        Discount::create([
            'description' => 'Omaggio',
            'discount' => '100',
        ]);
        Department::create([
            'name' => 'Bar',
        ]);

        Department::create([
            'name' => 'Cucina',
        ]);


        Department::create([
            'name' => 'Griglia',
        ]);


        /** @var Menu $m */
        $m = Menu::create([
            'name' => 'Menù Principale',
            'description' => 'Menu principale della festa',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->add('2 days'),
            'enabled' => true,
        ]);

        /** @var Product $p */
        $p = Product::create([
            'name' => 'Trippe',
            'description' => 'Trippe della tradizione',
            'price' => '5',
            'department_id' => Department::where('name', 'Cucina')->first()->id,
            'enabled' => true,
        ]);
        $p->meal()->attach(Meal::where('name', 'Primi Piatti')->first()->id);
        $m->products()->save($p);

        $p = Product::create([
            'name' => 'Salsicce x2',
            'description' => 'Salsicce x2',
            'price' => '4.5',
            'department_id' => Department::where('name', 'Griglia')->first()->id,
            'enabled' => true,
        ]);
        $p->meal()->attach(Meal::where('name', 'Secondi Piatti')->first()->id);
        $m->products()->save($p);


        $p = Product::create([
            'name' => 'Acqua gassata 0.5L',
            'description' => 'Acqua gassata 0.5L',
            'price' => '1',
            'department_id' => Department::where('name', 'Bar')->first()->id,
            'enabled' => true,
        ]);
        $p->meal()->attach(Meal::where('name', 'Bevande')->first()->id);
        $m->products()->save($p);


        Warehouse::factory(40)->create();
    }
}
