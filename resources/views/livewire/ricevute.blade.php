<div>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-1/2 px-3 mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputSearch">
                Ricerca Ricevuta
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                   id="inputSearch" type="text" wire:model="query" placeholder="Ricerca Ricevuta">
            <p class="text-gray-600 text-xs italic">Inserisci la query di ricerca</p>
            @error('query')
            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="w-1/2 px-3 mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputSearch2">
                Data Ricevuta
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                   id="inputSearch2" type="text" wire:model="query2" placeholder="Data Ricevuta">
            <p class="text-gray-600 text-xs italic">Inserisci la data della ricevuta</p>
            @error('query')
            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="px-2 w-full mt-3">
            <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4" href="{{route('new_receipts')}}">
                NUOVA RICEVUTA
            </a>
        </div>
    </div>

    <table class="table-fixed mt-3 w-full" style="overflow-x: scroll">
        <thead class="thead-dark">
        <tr>
            <th class="w-auto">ID</th>
            <th class="w-auto">Data</th>
            <th class="w-auto">Ora</th>
            <th class="w-auto">Nome</th>
            <th class="w-auto">Totale</th>
            <th class="w-auto">Sconti</th>
            <th class="w-auto"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($receipts as $receipt)
            <tr>
                <td class="py-4 px-2">{{$receipt->id}}</td>
                <td class="py-4 px-2">{{\Carbon\Carbon::make($receipt->data)->format('Y-m-d')}}</td>
                <td class="py-4 px-2">{{\Carbon\Carbon::make($receipt->data)->format('H:i:s')}}</td>
                <td class="py-4 px-2">{{$receipt->name}}</td>
                <td class="py-4 px-2">{{$receipt->total}}</td>
                <td class="py-4 px-2">{{$receipt->discount}}</td>
                <td class="text-right">
                    <button class="mx-1" wire:click="view({{$receipt->id}})">
                        <i class="far fa-eye"></i>
                    </button>
                    <button class="mx-1" wire:click="print({{$receipt->id}})">
                        <i class="fas fa-print"></i>
                    </button>
                    <button class="mx-1" wire:click="delete({{$receipt->id}})">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
