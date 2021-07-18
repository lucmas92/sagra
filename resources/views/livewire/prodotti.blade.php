<div>
    <form class="fixed-top bg-light py-4 d-none d-lg-block head-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="inputName">Nome</label>
                        <input type="text" class="form-control @error('name') border border-danger @enderror "
                               id="inputName" aria-describedby="nameHelp"
                               placeholder="Inserisci nome Menu" required wire:model="name">
                        <small id="nameHelp" class="form-text text-muted">Inserisci il nome del Prodotto</small>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="inputDescription">Descrizione</label>
                        <input type="text" class="form-control @error('description') border border-danger @enderror "
                               id="inputDescription" aria-describedby="descriptionHelp"
                               placeholder="Inserisci la descrizione" wire:model="description">
                        <small id="descriptionHelp" class="form-text text-muted">Inserisci la descrizione del
                            Prodotto</small>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="inputPrice">Prezzo</label>
                        <input type="text" class="form-control @error('price') border border-danger @enderror "
                               id="inputPrice" aria-describedby="priceHelp"
                               placeholder="Inserisci il prezzo" wire:model="price">
                        <small id="priceHelp" class="form-text text-muted">Inserisci il prezzo del Prodotto</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="inputName">Reparto</label>
                        <select class="custom-select  @error('department') border border-danger @enderror "
                                wire:model="department">
                            <option selected>Open this select menu</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                        <small id="nameHelp" class="form-text text-muted">Inserisci il nome del Prodotto</small>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="inputDescription">Pasto</label>
                        <select class="custom-select  @error('meal') border border-danger @enderror " wire:model="meal">
                            <option selected>Open this select menu</option>
                            @foreach($meals as $meal)
                                <option value="{{$meal->id}}">{{$meal->name}}</option>
                            @endforeach
                        </select>
                        <small id="descriptionHelp" class="form-text text-muted">Inserisci la descrizione del
                            Prodotto</small>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="inputWarehouse">Scorta</label>
                        <input type="text" class="form-control @error('quantity') border border-danger @enderror "
                               id="inputWarehouse" aria-describedby="warehouseHelp"
                               placeholder="Inserisci la scorta" wire:model="quantity">

                        <small id="warehouseHelp" class="form-text text-muted">Inserisci la scorta del Prodotto</small>
                    </div>
                </div>
                <div class="col-12 col-md-3 pt-1">
                    <button type="submit" class="btn mt-4 btn-primary" wire:click="save">
                        {{$editingMode ? 'Aggiorna' : 'Aggiungi'}}
                    </button>
                    @if(isset($editingMode) && $editingMode)
                        <button type="submit" class="btn mt-4 btn-danger" wire:click="abortEdit">
                            Annulla
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </form>

    <div class="px-3 pt-2 pb-3" style="margin-top: 180px;">
        <input type="text" class="form-control" id="inputSearch"
               placeholder="Ricerca Prodotto" wire:model="query">
    </div>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Descrizione</th>
            <th scope="col">Prezzo</th>
            <th scope="col">Pasto</th>
            <th scope="col">Scorta</th>
            <th scope="col">Reparto</th>
            <th scope="col">Attivo</th>
            <th scope="col" class="text-right">Azioni</th>
        </tr>
        </thead>
        <tbody>

        @foreach($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->meal->first()->name ?? 'mealName'}}</td>
                <td>{{$product->warehouse()->first()->quantity ?? 0}}</td>
                <td>{{$product->department->name ?? ''}}</td>
                <td>
                    <button wire:click="toggleStatus({{$product->id}})">{{$product->enabled}}</button>
                </td>
                <td class="text-right">
                    <button wire:click="edit({{$product->id}})">Edit</button>
                    <button wire:click="delete({{$product->id}})">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
