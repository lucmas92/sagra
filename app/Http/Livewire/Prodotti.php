<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Meal;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Prodotti extends Component
{
    public $products = [];
    public $editingMode = false;

    public $product_id;
    public $name;
    public $description;
    public $price;
    public $quantity;
    public $department;
    public $meal;

    public $departments = [];
    public $meals = [];


    public $query = "";


    public function render()
    {
        $products = Product::with('warehouse');
        $this->products = strlen($this->query) >= 3
            ? $products->where('name', 'like', '%' . $this->query . '%')
                ->orWhere('description', 'like', '%' . $this->query . '%')->get()
            : $products->get();

        $this->departments = Department::all();
        $this->meals = Meal::all();

        return view('livewire.prodotti');
    }

    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['enabled' => !$product->enabled]);
    }

    public function abortEdit()
    {
        $this->editingMode = false;
        $this->name = null;
        $this->description = null;
        $this->price = null;
        $this->quantity = null;
        $this->meal = null;
        $this->department = null;
    }

    public function delete($id)
    {
        if (Product::find($id)) {
            Product::find($id)->delete();
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->quantity = $product->warehouse()->first()->quantity ?? 0;
        $this->meal = $product->meal()->first()->id;
        $this->department = $product->department->id ?? 0;
        $this->editingMode = true;

    }

    protected $rules = [
        'name' => 'required|min:3|unique:products,name',
        'description' => 'max:255',
        'price' => 'required|numeric|min:0.10|max:99',
        'department' => 'required',
        'meal' => 'required',
        'quantity' => 'required|numeric|min:1'
    ];

    public function save()
    {
        if ($this->editingMode) {
            $this->rules['name'] = 'required|min:3|unique:products,name,' . $this->product_id;
        }

        $this->validate();

        /** @var Product $product */
        $product = ($this->editingMode) ? Product::findOrFail($this->product_id) : new Product();
        $product->name = $this->name;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->department_id = $this->department;
        $product->enabled = ($this->editingMode) ? $product->enabled : false;
        $saved = $product->save();

        if ($saved) {


            $product->meal()->detach();
            $product->meal()->attach($this->meal);
            Warehouse::updateOrCreate(
                ['product_id' => $product->id],
                [
                    'product_id' => $product->id,
                    'quantity' => $this->quantity ?? 1,
                    'min_quantity' => 1,
                ]);

            $this->name = '';
            $this->description = '';
            $this->price = '';
            $this->department = null;
            $this->meal = null;
            $this->quantity = '';
            $this->editingMode = $this->editingMode ? false : $this->editingMode;
        }
    }
}
