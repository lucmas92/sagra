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
                <p class="text-gray-600 text-xs italic">Inserisci il nome del Menu</p>
                @error('name')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror

            </div>
            <div class="w-1/2 px-3 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputName">
                    Descrizione
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       id="inputName" type="text" wire:model="description" placeholder="Inserisci la descrizione">
                <p class="text-gray-600 text-xs italic">Inserisci la descrizione del Menu</p>
            </div>
            <div class="md:w-1/2 w-full px-3 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputStartDate">
                    Data Inizio
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       id="inputStartDate" type="text" wire:model="startDate" placeholder="Inserisci la data inizio">
                <p class="text-gray-600 text-xs italic">Inserisci la data di inizio validità del Menu</p>
                @error('startDate')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="md:w-1/2 w-full px-3 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputEndDate">
                    Data Fine
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       id="inputEndDate" type="text" wire:model="endDate" placeholder="Inserisci la data fine fine">
                <p class="text-gray-600 text-xs italic">Inserisci la data di fine validità del Menu</p>
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
            <th class="w-1/6">Nome</th>
            <th class="w-1/6">Descrizione</th>
            <th class="w-1/6">Inizio Validità</th>
            <th class="w-1/6">Fine Validità</th>
            <th class="w-1/12 text-center">Attivo</th>
            <th class="w-1/6 text-right"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

        @foreach($menus as $menu)
            <tr wire:key="{{ $menu->id }}">
                <td class="py-4 px-2">{{$menu->name}}</td>
                <td class="py-4 px-2">{{$menu->description}}</td>
                <td class="py-4 px-2">{{$menu->start_date}}</td>
                <td class="py-4 px-2">{{$menu->end_date}}</td>
                <td class="text-center py-4 px-2">
                    <button class="px-3 py-2"
                            wire:click="toggleStatus({{$menu->id}})">
                        @if($menu->enabled)
                            <i class="far fa-check-circle text-success"></i>
                        @else
                            <i class="far fa-times-circle text-danger"></i>
                        @endif
                    </button>
                </td>
                <td class="text-right py-4 px-2">
                    <button class="mx-1" wire:click="compile({{$menu->id}})">
                        <i class="fas fa-external-link-alt"></i>
                    </button>
                    <button class="mx-1" wire:click="edit({{$menu->id}})" x-on:click.prevent="show=true">
                        <i class="far fa-edit"></i>
                    </button>
                    <button class="mx-1" wire:click="delete({{$menu->id}})">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if($showModal)

        <div style="z-index: 999" class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
            <div class="modal-container bg-white w-11/12 md:max-w-xl min-w-xl mx-auto rounded shadow-lg z-50 overflow-y-auto">

                <!-- Add margin if you want to see some of the overlay behind the modal-->
                <div class="modal-content py-4 text-left px-6">
                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">
                            Aggiungi prodotti al menu {{$compilingMenu->products()->count()}}
                        </p>
                        <div class="modal-close cursor-pointer z-50" wire:click="$set('showModal',false)">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                 height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>

                    <table class="table-fixed w-full">
                        <thead class="thead-dark">
                        <tr>
                            <th class="w-1/3">Nome</th>
                            <th class="w-1/6">In Menu</th>
                            <th class="w-1/3">Pasto</th>
                            <th class="w-1/6"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="py-4 px-2">{{$product->name}}</td>
                                <td class="py-4 px-2">{{$compilingMenu->products->contains($product)}}</td>
                                <td class="py-4 px-2">{{$product->meal->first()->name ?? 'mealName'}}</td>
                                <td class="py-4 px-2 text-center">
                                    @if($compilingMenu->products->contains($product))
                                        <button wire:click="removeFromMenu({{$product->id}}) text-danger">
                                            <i class="fas fa-minus-circle"></i>
                                        </button>
                                    @else
                                        <button wire:click="addToMenu({{$product->id}}) text-success">
                                            <i class="fas fa-plus-circle"></i>
                                        </button>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                    <!--Footer-->
                    <div class="flex justify-end pt-2">
                        <button wire:click="$set('showModal',false)"
                                class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">
                            Action
                        </button>
                        <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">
                            Close
                        </button>
                    </div>

                </div>
            </div>
        </div>

    @endisset
</div>
