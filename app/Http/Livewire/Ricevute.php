<?php

namespace App\Http\Livewire;

use App\Models\Receipt;
use Livewire\Component;

class Ricevute extends Component
{
    public $receipts = [];
    public $editingMode = false;
    public $query = '';
    public $query2 = '';


    public function render()
    {
        $receipts = Receipt::orderBy('data', 'desc');
        if (strlen($this->query) > 0) {
            $receipts = $receipts->where('id', 'like', '%' . $this->query . '%');
        }
        if (strlen($this->query2) > 0) {
            $receipts = $receipts->where('data', 'like', '%' . $this->query2 . '%');
        }
        $this->receipts = $receipts->get();
        return view('livewire.ricevute');
    }

    public function delete($id)
    {
        if (Receipt::find($id)) {
            Receipt::find($id)->delete();
        }
    }
}
