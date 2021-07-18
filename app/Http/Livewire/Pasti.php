<?php

namespace App\Http\Livewire;

use App\Models\Meal;
use App\Models\Product;
use Livewire\Component;

class Pasti extends Component
{
    public $meals = [];
    public $name;
    public $position;
    public $meal_id;

    public $editingMode = false;


    public function render()
    {
        $this->meals = Meal::all();
        return view('livewire.pasti');
    }

    public function abortEdit()
    {
        $this->editingMode = false;
        $this->name = null;
        $this->position = null;
    }

    public function delete($id)
    {
        if (Meal::find($id)) {
            Meal::find($id)->delete();
        }
    }

    public function edit($id)
    {
        $meal = Meal::findOrFail($id);
        $this->name = $meal->name;
        $this->position = $meal->position;
        $this->meal_id = $meal->id;

        $this->editingMode = true;
    }

    protected $rules = [
        'name' => 'required|min:3',
    ];

    public function save()
    {
        $this->validate();

        /** @var Meal $meal */
        $meal = ($this->editingMode) ? Meal::findOrFail($this->meal_id) : new Meal();
        $meal->name = $this->name;
        $meal->position = $this->position;
        $meal->save();
    }
}
