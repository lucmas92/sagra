<?php

namespace App\Http\Livewire;

use App\Models\Discount;
use Livewire\Component;

class Sconti extends Component
{

    public $discounts = [];
    public $description;
    public $value;
    public $discount_id;

    public $editingMode = false;


    public function render()
    {
        $this->discounts = Discount::all();
        return view('livewire.sconti');
    }

    public function abortEdit()
    {
        $this->editingMode = false;
        $this->description = '';
        $this->value = '';
    }

    public function delete($id)
    {
        if (Discount::find($id)) {
            Discount::find($id)->delete();
        }
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        $this->description = $discount->description;
        $this->value = $discount->discount;
        $this->discount_id = $discount->id;

        $this->editingMode = true;
    }

    protected $rules = [
        'description' => 'required|min:3|unique:discounts,description',
        'value' => 'required|numeric|min:1|max:99',
    ];

    public function save()
    {
        if ($this->editingMode) {
            $this->rules = [
                'name' => 'required|min:3|unique:discounts,description,' . $this->discount_id,
            ];
        }
        $this->validate();

        /** @var Discount $discount */
        $discount = ($this->editingMode) ? Discount::findOrFail($this->discount_id) : new Discount();
        $discount->description = $this->description;
        $discount->discount = $this->value;
        $discount->enabled = ($this->editingMode) ? $this->enabled : false;
        $saved = $discount->save();
        if ($saved) {
            $this->description = '';
            $this->value = '';
            $this->editingMode = $this->editingMode ? false : $this->editingMode;
        }
    }

    public function toggleStatus($id)
    {
        $discount = \App\Models\Discount::findOrFail($id);
        $discount->update(['enabled' => !$discount->enabled]);
    }
}
