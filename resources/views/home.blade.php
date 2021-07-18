@extends('layouts.app')

@section('page-css')
    <style>
        .row {
            margin: 1rem 0 1rem 0;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-4 text-center">
                                <div class="border w-100 p-4">
                                    <h5>Incassi Totali</h5>
                                    <h3>€ {{\App\Models\Receipt::query()->sum('total')}}</h3>
                                    <ul class="list-group">
                                        @foreach($totalForDepartment as $index => $total)
                                            <li class="list-group-item">#{{$index+1}}. {{$total->name}}
                                                - {{$total->total}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8 px-0">
                                <div class="row px-0">
                                    <div class="col text-center">
                                        <div class="border w-100 p-4">
                                            <h5>Incassi Ieri</h5>
                                            <h3>
                                                € {{\App\Models\Receipt::query()->whereDate('data',\Carbon\Carbon::yesterday()->format('Y-m-d'))->sum('total')}}</h3>
                                        </div>
                                    </div>
                                    <div class="col text-center">
                                        <div class="border w-100 p-4">
                                            <h5>Incassi Oggi</h5>
                                            <h3>
                                                € {{\App\Models\Receipt::query()->whereDate('data',\Carbon\Carbon::today()->format('Y-m-d'))->sum('total')}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center mb-3">
                                <div class="border w-100 p-4">
                                    <h3>{{\App\Models\Product::count()}}</h3>
                                    Prodotti Registrati
                                </div>
                            </div>
                            <div class="col text-center mb-3">
                                <div class="border w-100 p-4">
                                    <h3>{{\App\Models\Product::where('enabled',true)->count()}}</h3>
                                    Prodotti Attivi
                                </div>
                            </div>
                            <div class="col text-center mb-3">
                                <div class="border w-100 p-4">
                                    <h3>{{\App\Models\Discount::where('enabled',true)->count()}}</h3>
                                    Sconti Attivi
                                </div>
                            </div>
                            <div class="col text-center mb-3">
                                <div class="border w-100 p-4">
                                    <h3>{{\App\Models\Department::count()}}</h3>
                                    Reparti Registrati
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
