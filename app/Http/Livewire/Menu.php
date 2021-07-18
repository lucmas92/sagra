<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Menu extends Component
{
    public $menus = [];
    public $editingMode = false;

    public $menu_id;
    public $name;
    public $description;
    public $startDate;
    public $endDate;


    protected $listeners = ['removeFromMenu' => '$refresh', 'addToMenu' => '$refresh'];

    /** @var \App\Models\Menu $menu */
    public $compilingMenu = null;
    public $departments = [];
    public $products = [];

    public function render()
    {
        $this->menus = \App\Models\Menu::all();
        return view('livewire.menu');
    }

    public function toggleStatus($id)
    {
        $menu = \App\Models\Menu::findOrFail($id);
        $menu->update(['enabled' => !$menu->enabled]);
    }

    public function abortEdit()
    {
        $this->editingMode = false;
        $this->name = null;
        $this->description = null;
        $this->startDate = null;
        $this->endDate = null;
    }

    public function edit($id)
    {
        $menu = \App\Models\Menu::findOrFail($id);
        $this->menu_id = $menu->id;
        $this->name = $menu->name;
        $this->description = $menu->description;
        $this->startDate = $menu->start_date;
        $this->endDate = $menu->end_date;
        $this->editingMode = true;

    }

    public function delete($id)
    {
        if (\App\Models\Menu::find($id)) {
            \App\Models\Menu::find($id)->delete();
        }
    }


    protected $rules = [
        'name' => 'required|min:6',
        'description' => 'max:255',
        'endDate' => 'after:start_date',
    ];

    public function save()
    {
        $this->validate();

        $menu = ($this->editingMode) ? \App\Models\Menu::findOrFail($this->menu_id) : new \App\Models\Menu();
        $menu->name = $this->name;
        $menu->description = $this->description;
        $menu->start_date = $this->startDate;
        $menu->end_date = $this->endDate;
        $menu->save();
    }

    public function compile($id)
    {
        logger('compile menu ' . $id);
        $this->compilingMenu = \App\Models\Menu::findOrFail($id);
        logger($this->compilingMenu);
        $this->products = Product::all();
        $this->emit('menuCompile'); // Close model to using to jquery
    }

    public function removeFromMenu($id)
    {
        logger('rimozione prodotto ' . $id . ' da menu ' . $this->compilingMenu->id);
        $this->compilingMenu->products()->detach($id);
        $this->compilingMenu->save();
    }

    public function addToMenu($id)
    {
        logger('aggiunta prodotto ' . $id . ' da menu ' . $this->compilingMenu->id);
        $this->compilingMenu->products()->attach($id);
        $this->compilingMenu->save();

    }
}

