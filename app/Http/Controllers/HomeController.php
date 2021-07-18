<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\ReceiptProduct;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $totalForDepartment = DB::table('receipt_products as rp')
            ->select(DB::raw('d.name,  sum(rp.price * rp.quantity - (rp.price * rp.quantity  * rp.discount / 100)) as total'))
            ->join('products as p', 'p.id', '=', 'rp.product_id')
            ->join('departments as d', 'd.id', '=', 'p.department_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->groupBy('d.id', 'd.name')->get();

        logger($totalForDepartment);


        return view('home', ['totalForDepartment' => $totalForDepartment]);
    }

    public function menu()
    {
        return view('menu');
    }

    public function products()
    {
        return view('products');
    }

    public function meals()
    {
        return view('meals');
    }

    public function departments()
    {
        return view('departments');
    }

    public function discounts()
    {
        return view('discounts');
    }

    public function receipts()
    {
        return view('receipts');
    }

    public function new_receipts()
    {
        if (!\Illuminate\Support\Facades\Session::has('receipt_id')) {
            $maxid = Receipt::query()->max('id');
            session()->put('receipt_id', $maxid);
        }
        return view('new_receipts');
    }
}
