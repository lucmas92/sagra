<div x-data={show:false}>
    <button x-on:click.prevent="show=!show" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4"
            type="button">
        <span x-show="show">Chiudi</span><span x-show="!show">Apri</span> Form @if($editingMode)<i
                class="fas fa-exclamation-circle"></i>@endif
    </button>
    <form x-show="show" class="head-form" wire:submit.prevent="save">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-1/2 px-3 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputDescription">
                    Descrizione
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       id="inputDescription" type="text" wire:model="description" placeholder="Inserisci il nome">
                <p class="text-gray-600 text-xs italic">Inserisci la descrizione dello Sconto</p>
                @error('description')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="w-1/2 px-3 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputName">
                    Percentuale
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       id="inputName" type="text" wire:model="value" placeholder="Inserisci la percentuale">
                <p class="text-gray-600 text-xs italic">Inserisci la percentuale di Sconto</p>
                @error('value')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="px-2">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mt-4">
                    {{$editingMode ? 'Aggiorna' : 'Aggiungi'}}
                </button>
                @if(isset($editingMode) && $editingMode)
                    <button type="reset" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mt-4"
                            wire:click="abortEdit" x-on:click.prevent="show=false">
                        Annulla
                    </button>
                @endif
            </div>
        </div>
    </form>

    <table class="table-fixed mt-3 w-full" style="overflow-x: scroll">
        <thead class="thead-dark">
        <tr>
            <th class="w-auto">Descrizione</th>
            <th class="w-1/8 text-center">Sconto</th>
            <th class="w-1/8 text-center">Stato</th>
            <th class="w-auto text-right"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

        @foreach($discounts as $discount)
            <tr>
                <td class="py-4 px-2">{{$discount->description}}</td>
                <td class="py-4 px-2 text-center">{{$discount->discount}}</td>
                <td class="py-4 px-2 text-center">
                    <button class=" px-3 py-2 border-0 bg-transparent h3"
                            wire:click="toggleStatus({{$discount->id}})">
                        @if($discount->enabled)
                            <i class="far fa-check-circle text-success"></i>
                        @else
                            <i class="far fa-times-circle text-danger"></i>
                        @endif
                    </button>
                </td>
                <td class="py-4 px-2 text-right">
                    <button class="mx-1" wire:click="edit({{$discount->id}})" x-on:click.prevent="show=true">
                        <i class="far fa-edit"></i>
                    </button>
                    <button class="mx-1" wire:click="delete({{$discount->id}})">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
