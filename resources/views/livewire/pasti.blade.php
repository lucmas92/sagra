<div x-data={show:false}>
    <button x-on:click.prevent="show=!show" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4"
            type="button">
        <span x-show="show">Chiudi</span><span x-show="!show">Apri</span> Form @if($editingMode)<i
                class="fas fa-exclamation-circle"></i>@endif
    </button>
    <form x-show="show" class="head-form" wire:submit.prevent="save">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-1/2 px-3 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputName">
                    Nome
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       id="inputName" type="text" wire:model="name" placeholder="Inserisci il nome">
                <p class="text-gray-600 text-xs italic">Inserisci il nome del Pasto</p>
                @error('name')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror

            </div>
            <div class="w-1/2 px-3 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputPosition">
                    Posizione
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       id="inputPosition" type="text" wire:model="position" placeholder="Inserisci la posizione">
                <p class="text-gray-600 text-xs italic">Inserisci la posizione del Pasto</p>
                @error('position')
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
            <th class="2-auto">Nome</th>
            <th class="2-auto">Posizione</th>
            <th class="2-auto text-right"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

        @foreach($meals as $meal)
            <tr>
                <td class="py-4 px-2">{{$meal->name}}</td>
                <td class="py-4 px-2">{{$meal->position}}</td>
                <td class="py-4 px-2 text-right">
                    <button class="mx-1" wire:click="edit({{$meal->id}})" x-on:click.prevent="show=true">
                        <i class="far fa-edit"></i>
                    </button>
                    <button class="mx-1" wire:click="delete({{$meal->id}})">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
