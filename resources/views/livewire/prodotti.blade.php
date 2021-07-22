<div x-data={show:false}>
    <button x-on:click.prevent="show=!show" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4"
            type="button">
        <span x-show="show">Chiudi</span><span x-show="!show">Apri</span> Form @if($editingMode)<i
                class="fas fa-exclamation-circle"></i>@endif
    </button>

    <form x-show="show" class="head-form" wire:submit.prevent="save">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputName">
                    Nome
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       id="inputName" type="text" wire:model="name" placeholder="Inserisci il nome">
                <p class="text-gray-600 text-xs italic">Inserisci il nome del Prodotto</p>
                @error('name')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="md:w-1/4 w-1/2 px-3 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputQuantity">
                    Scorta
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       id="inputQuantity" type="text" wire:model="quantity" placeholder="Inserisci la scorta">
                <p class="text-gray-600 text-xs italic">Inserisci la scorta del Prodotto</p>
                @error('quantity')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="md:w-1/4 w-1/2 px-3 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputPrice">
                    Prezzo
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       id="inputPrice" type="text" wire:model="price" placeholder="Inserisci il prezzo">
                <p class="text-gray-600 text-xs italic">Inserisci il prezzo del Prodotto</p>
                @error('price')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="w-full px-3 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                       for="inputDescription">
                    Descrizione
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       id="inputDescription" type="text" wire:model="description"
                       placeholder="Inserisci il descrizione">
                <p class="text-gray-600 text-xs italic">Inserisci la descrizione del Prodotto</p>
                @error('description')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="w-1/2 px-3 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputDepartment">
                    Reparto
                </label>

                <select wire:model="department" id="inputDepartment"
                        class="bg-gray-200 text-gray-700 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full mb-1">
                    <option value="null">Seleziona il dipartimento</option>

                    @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>

                <p class="text-gray-600 text-xs italic">Inserisci il reparto del Prodotto</p>
                @error('department')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="w-1/2 px-3 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputMeal">
                    Pasto
                </label>

                <select wire:model="meal" id="inputMeal"
                        class="bg-gray-200 text-gray-700 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full mb-1">
                    <option value="null">Seleziona il pasto</option>

                    @foreach($meals as $meal)
                        <option value="{{$meal->id}}">{{$meal->name}}</option>
                    @endforeach
                </select>

                <p class="text-gray-600 text-xs italic">Inserisci il pasto del Prodotto</p>
                @error('meal')
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

    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-1/2 px-3 mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputSearch">
                Ricerca Prodotto
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                   id="inputSearch" type="text" wire:model="query" placeholder="Ricerca Prodotto">
            <p class="text-gray-600 text-xs italic">Inserisci la query di ricerca</p>
            @error('query')
            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <table class="table-fixed mt-3 w-full" style="overflow-x: scroll">
        <thead class="thead-dark">
        <tr>
            <th class="w-auto">Nome</th>
            <th class="w-auto">Descrizione</th>
            <th class="w-auto">Prezzo</th>
            <th class="w-auto">Pasto</th>
            <th class="w-auto">Scorta</th>
            <th class="w-auto">Reparto</th>
            <th class="w-1/12 text-center">Attivo</th>
            <th class="w-auto text-right"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

        @foreach($products as $product)
            <tr>
                <td class="py-4 px-2">{{$product->name}}</td>
                <td class="py-4 px-2">{{$product->description}}</td>
                <td class="py-4 px-2">{{$product->price}}</td>
                <td class="py-4 px-2">{{$product->meal->first()->name ?? 'mealName'}}</td>
                <td class="py-4 px-2">{{$product->warehouse()->first()->quantity ?? 0}}</td>
                <td class="py-4 px-2">{{$product->department->name ?? ''}}</td>
                <td class="py-4 px-2 text-center">
                    <button class="px-3 py-2" wire:click="toggleStatus({{$product->id}})">
                        @if($product->enabled)
                            <i class="far fa-check-circle text-success"></i>
                        @else
                            <i class="far fa-times-circle text-danger"></i>
                        @endif
                    </button>
                </td>
                <td class="py-4 px-2 text-right">
                    <button class="mx-1" wire:click="edit({{$product->id}})" x-on:click.prevent="show=true">
                        <i class="far fa-edit"></i>
                    </button>
                    <button class="mx-1" wire:click="delete({{$product->id}})">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
