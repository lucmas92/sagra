<div>
    <div class="row px-3 pt-2 pb-3">
        <div class="col">
            <input type="text" class="form-control" id="inputSearch" autofocus
                   placeholder="Ricerca Ricevuta" wire:model="query">

        </div>
        <div class="col">
            <input type="text" class="form-control" id="inputSearch" autofocus
                   placeholder="Data Ricevuta" wire:model="query2">

        </div>
        <div class="col">
            <a class="btn btn-block btn-primary" href="{{route('new_receipts')}}">NUOVA RICEVUTA</a>
        </div>
    </div>
    <table class="table" style="margin-top: 10px;">
        <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Data</th>
            <th scope="col">Ora</th>
            <th scope="col">Nome</th>
            <th scope="col">Totale</th>
            <th scope="col">Sconti</th>
            <th scope="col" class="text-right">Azioni</th>
        </tr>
        </thead>
        <tbody>

        @foreach($receipts as $receipt)
            <tr>
                <td>{{$receipt->id}}</td>
                <td>{{\Carbon\Carbon::make($receipt->data)->format('Y-m-d')}}</td>
                <td>{{\Carbon\Carbon::make($receipt->data)->format('H:i:s')}}</td>
                <td>{{$receipt->name}}</td>
                <td>{{$receipt->total}}</td>
                <td>{{$receipt->discount}}</td>
                <td class="text-right">
                    <button wire:click="view({{$receipt->id}})">View</button>
                    <button wire:click="print({{$receipt->id}})">Print</button>
                    <button wire:click="delete({{$receipt->id}})">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
