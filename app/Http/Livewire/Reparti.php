<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;

class Reparti extends Component
{
    public $departments = [];
    public $name;
    public $department_id;

    public $editingMode = false;


    public function render()
    {
        $this->departments = Department::all();
        return view('livewire.reparti');
    }

    public function abortEdit()
    {
        $this->editingMode = false;
        $this->name = null;
    }

    public function delete($id)
    {
        if (Department::find($id)) {
            Department::find($id)->delete();
        }
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $this->name = $department->name;
        $this->department_id = $department->id;

        $this->editingMode = true;
    }

    protected $rules = [
        'name' => 'required|min:3|unique:departments',
    ];

    public function save()
    {
        if ($this->editingMode) {
            $this->rules = [
                'name' => 'required|min:3|unique:departments,name,' . $this->department_id,
            ];
        }
        $this->validate();

        /** @var Department $department */
        $department = ($this->editingMode) ? Department::findOrFail($this->department_id) : new Department();
        $department->name = $this->name;
        $saved = $department->save();
        if ($saved) {
            $this->name = '';
            $this->editingMode = $this->editingMode ? false : $this->editingMode;
        }
    }
}
