<div class="px-2">
    <div class="row">
        <div class="col-12 col-lg-8">
            <input type="text" class="form-control" id="inputSearch"
                   placeholder="Ricerca Prodotto" wire:model="query">
            <div class="row">
                @foreach($meals as $meal)
                    <div class="col">
                        <div class="w-100 mr-2 my-2 p-2 border" wire:click="$set('meal', {{$meal->id}})">
                            {{$meal->name}}
                        </div>
                    </div>
                @endforeach
            </div>
            <table class="table table-borderless">
                @foreach($products as $product)
                    <tr class="bg-white border">
                        <td>{{$product->name}}</td>
                        <td class="text-right">
                            <span
                                class="badge badge-primary p-2"># {{$product->warehouse()->first()->quantity ?? 0}}</span>
                            <span class="badge badge-primary p-2">€ {{$product->price}}</span>

                            <button class="btn-success" wire:click="add({{$product->id}})">+</button>
                            <button class="btn-danger" wire:click="remove({{$product->id}})">-</button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-12 col-lg-4">
            <form>
                <div class="form-group">
                    <h2>#{{$receipt->id}} Totale: <span
                            class="float-right font-weight-bold">{{$this->receipt->total}} €</span></h2>
                    <button class="btn btn-outline-dark" wire:click="save">Registra</button>
                </div>
                <div class="form-group">
                    <label for="inputName">Nome</label>
                    <input type="text" class="form-control @error('name') border border-danger @enderror"
                           id="inputName" aria-describedby="nameHelp" minlength="3"
                           placeholder="Inserisci il nome" required wire:model="receipt_name">
                    <small id="nameHelp" class="form-text text-muted">Inserisci il nome del Pasto</small>
                </div>
                <div class="form-group">
                    <label for="inputName">Sconto</label>
                    <select class="custom-select  @error('discount') border border-danger @enderror "
                            wire:model="receipt_discount">
                        <option selected value="">Open this select menu</option>
                        @foreach($discounts as $discount)
                            <option value="{{$discount->id}}">{{$discount->discount}}%
                                - {{$discount->description}}</option>
                        @endforeach
                    </select>
                    <small id="nameHelp" class="form-text text-muted">Inserisci lo Sconto</small>
                </div>
                <div class="form-group">
                    <label for="inputNote">Note</label>
                    <textarea class="form-control" id="inputNote" aria-describedby="noteHelp" rows="3"></textarea>
                    <small id="noteHelp" class="form-text text-muted">Inserisci lo Sconto</small>
                </div>
                <h3>Elenco Prodotti:</h3>
                @foreach($receipt->products as $receipt_product)
                    <div class="row">
                        <div class="col">
                            <button type="button" wire:click="remove({{$receipt_product->id}}, {{$receipt_product->pivot->quantity}})">delete</button>
                        </div>
                        <div class="col">
                            {{$receipt_product->pivot->quantity ?? 1}}
                        </div>
                        <div class="col">
                            {{$receipt_product->name}}
                        </div>
                        <div class="col text-right">
                            {{$receipt_product->price * $receipt_product->pivot->quantity }} €
                        </div>
                    </div>
                @endforeach
            </form>

        </div>
    </div>
</div>
