<?php

namespace App\Http\Livewire;

use App\Models\Discount;
use App\Models\Meal;
use App\Models\Product;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class NuovaRicevuta extends Component
{
    public $meals = [];
    public $products;

    /** @var Receipt $receipt */
    public $receipt = null;
    public $receipt_products = [];
    public $receipt_name = '';
    public $receipt_note = '';
    public $receipt_discount = null;
    public $receipt_total = 0;
    public $discounts = [];
    public $query = '';
    public $meal = null;

    public function render()
    {
        // verifico se ci sono menu attivi
        // da utilizzare per la nuova ricevuta
        if (!\App\Models\Menu::active()->exists()) {
            Log::error('Nessun Menu Attivo!');
        }

        // recupero il menu attivo
        $activeMenu = \App\Models\Menu::active()->first();

        // inizializzo la ricevuta
        if (!isset($this->receipt)) {

            if (($id = Session::get('receipt_id')) && Receipt::find($id)) {
                $this->receipt = Receipt::find($id);
                $this->receipt_name = $this->receipt->name;
                $this->receipt_note = $this->receipt->note;
            } else {
                Session::forget('receipt_id');
                $this->receipt = new Receipt();
                $this->receipt->name = $this->receipt_name;
                $this->receipt->note = $this->receipt_note;
            }
        }

        $total = 0;
        $discount = 0;

        // calcolo lo sconto della ricevuta
        if (isset($this->receipt_discount) && $this->receipt_discount != '') {
            $discount = Discount::find($this->receipt_discount)->discount;
        }

        // calcolo il totale della ricevuta
        foreach ($this->receipt->products as $product) {
            $total += $product->price * $product->pivot->quantity;
        }
        if ($discount > 0) {
            $total = $total - ($total * $discount / 100);
        }

        $this->receipt->total = $total;
        $this->receipt->discount = $discount;
        $this->receipt->data = Carbon::now();
        $this->receipt->save();

        // recupero l'elenco degli sconti disponibili
        $this->discounts = Discount::active()->get();

        /** @var Builder $products */
        $products = $activeMenu ? $activeMenu->products() : [];

        if (strlen($this->query) >= 3) {
            $products = $products
                ->where('name', 'like', '%' . $this->query . '%')
                ->orWhere('description', 'like', '%' . $this->query . '%');
        }
        if (!is_null($this->meal)) {
            $products = $products->whereHas('meal', function ($query) {
                $query->where('meals.id', $this->meal);
            });
        }

        $this->products = $activeMenu ? $products->get() : [];

        if (isset($activeMenu)) {

            $this->meals = Meal::whereHas('products', function ($query) use ($activeMenu) {
                $pp = $activeMenu->products->pluck('id')->toArray();
                $query->whereIn('product_id', $pp);
            })->get();
        }

        return view('livewire.nuova-ricevuta');
    }

    public function add($id)
    {
        $product = Product::find($id);
        if ($this->receipt->products()->find($product)) {
            $oldQta = $this->receipt->products()->find($product)->pivot->quantity;
            if ($oldQta == $product->warehouse()->first()->quantity) {
                return;
            }
            $this->receipt->products()->updateExistingPivot($id,
                [
                    'quantity' => $oldQta + 1,
                    'price' => $product->price,
                    'discount' => $this->receipt->discount
                ]);
        } else {
            $this->receipt->products()->attach($id,
                [
                    'quantity' => 1,
                    'price' => $product->price,
                    'discount' => $this->receipt->discount
                ]);
        }

    }

    public function remove($id, $quantity = 1)
    {
        if ($this->receipt->products()->find($id)) {
            $oldQta = $this->receipt->products()->find($id)->pivot->quantity;
            if ($oldQta - $quantity > 0) {
                $this->receipt->products()->updateExistingPivot($id, ['quantity' => $oldQta - 1]);
            } else {
                $this->receipt->products()->detach($id);

            }
        }
    }

    protected $rules = [
        'receipt_name' => 'required|min:3|max:255',
        'receipt_note' => 'max:255',
    ];

    public function save()
    {
        if ($this->receipt->products()->count() == 0) {
            return;
        }

        $this->validate();
        $this->receipt->name = $this->receipt_name;
        $this->receipt->note = $this->receipt_note;
        if (isset($this->receipt_discount)) {
            $discount = Discount::find($this->receipt_discount)->discount;
            $this->receipt->discount = $discount;
        }
        $this->receipt->save();

        if (isset($this->receipt_discount)) {
            $this->receipt->products()->each(function ($p) use ($discount) {
                $p->pivot->update(['discount' => $discount]);
            });
        }

        $this->receipt_discount = null;
        $this->receipt_name = '';
        $this->receipt_note = '';
        $this->receipt_products = [];
        $this->receipt = null;
        Session::forget('receipt_id');
    }
}
