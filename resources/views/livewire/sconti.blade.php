<div>
    <button class="btn btn-block d-lg-none btn-primary" type="button" data-toggle="collapse" data-target="#formCollapse" aria-expanded="false" aria-controls="formCollapse">
        Apri Form @if($editingMode)<span>X</span>@endif
    </button>
    <form id="formCollapse" class="collapse border-bottom border-2 fixed-top bg-light position-absolute position-lg-relative d-lg-block py-4 head-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="inputDescription">Nome</label>
                        <input type="text" class="form-control @error('name') border border-danger @enderror"
                               id="inputDescription" aria-describedby="descriptionHelp" minlength="3"
                               placeholder="Inserisci la descrizione" required wire:model="description">
                        <small id="descriptionHelp" class="form-text text-muted">Inserisci la descrizione dello Sconto</small>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="inputDiscount">Percentuale</label>
                        <input type="number" class="form-control @error('name') border border-danger @enderror"
                               id="inputDiscount" aria-describedby="discountHelp" min="3"
                               placeholder="Inserisci la percentuale" required wire:model="value">
                        <small id="discountHelp" class="form-text text-muted">Inserisci la percentuale di Sconto</small>
                    </div>
                </div>
                <div class="col-12 col-md-4 pt-2">
                    <button type="submit" class="btn btn-primary mt-4" wire:click="save">
                        {{$editingMode ? 'Aggiorna' : 'Aggiungi'}}
                    </button>
                    @if(isset($editingMode) && $editingMode)
                        <button type="submit" class="btn btn-danger mt-4" wire:click="abortEdit">
                            Annulla
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </form>

    <table class="table custom-table2 table-responsive-xs" style="overflow-x: scroll">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Descrizione</th>
            <th scope="col">Sconto</th>
            <th scope="col">Stato</th>
            <th scope="col" class="text-right">Azioni</th>
        </tr>
        </thead>
        <tbody>

        @foreach($discounts as $discount)
            <tr>
                <td>{{$discount->description}}</td>
                <td>{{$discount->discount}}</td>
                <td>
                    <button class=" px-3 py-2 border-0 bg-transparent h3"
                            wire:click="toggleStatus({{$discount->id}})">
                        @if($discount->enabled)
                            <i class="far fa-check-circle text-success"></i>
                        @else
                            <i class="far fa-times-circle text-danger"></i>
                        @endif
                    </button>
                </td>
                <td class="text-right">
                    <button wire:click="edit({{$discount->id}})">Edit</button>
                    <button wire:click="delete({{$discount->id}})">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
