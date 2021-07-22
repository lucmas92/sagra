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
        $this->meals = Meal::orderBy('position')->get();
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
        'name' => 'required|min:3|unique:meals,name',
    ];

    public function save()
    {
        if ($this->editingMode) {
            $this->rules['name'] = 'required|min:3|unique:meals,name,' . $this->meal_id;
        }
        $this->validate();

        /** @var Meal $meal */
        $meal = ($this->editingMode) ? Meal::findOrFail($this->meal_id) : new Meal();
        $meal->name = $this->name;
        $meal->position = $this->position;
        $saved = $meal->save();
        if ($saved) {
            $this->name = '';
            $this->position = '';
            $this->editingMode = $this->editingMode ? false : $this->editingMode;
        }
    }
}
