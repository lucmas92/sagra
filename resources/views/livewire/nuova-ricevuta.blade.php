<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full lg:w-2/3 px-2 mt-3">
        <div class="w-full px-2 mt-3">
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
        <div class="grid grid-cols-4 mt-3 gap-1">
            @foreach($meals as $meal)
                <div class="w-auto border cursor-pointer p-3 hover:bg-gray-400 hover:text-white" wire:click="$set('meal', {{$meal->id}})">
                    {{$meal->name}}
                </div>
            @endforeach
        </div>

        <table class="table-fixed mt-3 w-full border" style="overflow-x: scroll">
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($products as $product)
                <tr>
                    <td class="px-2 py-4">{{$product->name}}</td>
                    <td class="px-2 py-4 text-right">
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-blue-300 rounded-full">
                            # {{$product->warehouse()->first()->quantity ?? 0}}
                        </span>
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-blue-300 rounded-full">
                            € {{$product->price}}
                        </span>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3"
                                wire:click="add({{$product->id}})">
                            <i class="fas fa-plus"></i>
                        </button>
                        {{$receipt->products()->find($product->id)->pivot->quantity?? 0}}
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3"
                                wire:click="remove({{$product->id}})">
                            <i class="fas fa-minus"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="w-full lg:w-1/3 px-2 mt-3">
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-3 gap-1">
                <div>#{{$receipt->id}}</div>
                <h2 class="text-right text-xl">Totale:</h2>
                <div class="text-center text-xl">{{$this->receipt->total}} €</div>
            </div>
            <button class="border py-1 px-3">
                Registra
            </button>
            <div class="w-full px-2 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputName">
                    Nome
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       id="inputName" type="text" wire:model="receipt_name" placeholder="Inserisci il nome">
                <p class="text-gray-600 text-xs italic">Inserisci il nome del Cliente</p>
                @error('receipt_name')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="w-full px-2 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputDiscount">
                    Sconto
                </label>

                <select wire:model="receipt_discount" id="inputDiscount"
                        class="bg-gray-200 text-gray-700 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full mb-1">
                    <option value="null">Seleziona lo sconto</option>

                    @foreach($discounts as $discount)
                        <option value="{{$discount->id}}">
                            {{$discount->discount}}% - {{$discount->description}}</option>
                    @endforeach
                </select>

                <p class="text-gray-600 text-xs italic">Inserisci lo Sconto</p>
                @error('discount')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="w-full px-2 mt-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="inputNote">
                    Note
                </label>

                <textarea id="inputNote" wire:model="receipt_note" class="resize-none w-full border"></textarea>

                <p class="text-gray-600 text-xs italic">Inserisci la nota</p>
                @error('note')
                <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="flex px-2 flex-wrap flex-col">
                <div>Elenco Prodotti:</div>
                @foreach($receipt->products as $receipt_product)
                    <div class="grid grid-cols-4">
                        <div>

                            <button wire:click="remove({{$receipt_product->id}}, {{$receipt_product->pivot->quantity}})">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                        <div>
                            {{$receipt_product->pivot->quantity ?? 1}}
                        </div>
                        <div>
                            {{$receipt_product->name}}
                        </div>
                        <div class="text-right">
                            {{$receipt_product->price * $receipt_product->pivot->quantity }} €
                        </div>
                    </div>
                @endforeach
            </div>

        </form>
    </div>
</div>