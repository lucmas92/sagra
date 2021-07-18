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
        $this->name = null;
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
        'description' => 'required|min:3',
        'value' => 'required|numeric|min:1',
    ];

    public function save()
    {
        $this->validate();

        /** @var Discount $discount */
        $discount = ($this->editingMode) ? Discount::findOrFail($this->discount_id) : new Discount();
        $discount->description = $this->description;
        $discount->discount = $this->value;
        $discount->enabled = ($this->editingMode) ? $this->enabled : false;
        $discount->save();
    }

    public function toggleStatus($id)
    {
        $discount = \App\Models\Discount::findOrFail($id);
        $discount->update(['enabled' => !$discount->enabled]);
    }
}
