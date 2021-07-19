<div>
    <button class="btn btn-block d-lg-none btn-primary" type="button" data-toggle="collapse" data-target="#formCollapse" aria-expanded="false" aria-controls="formCollapse">
        Apri Form @if($editingMode)<span>X</span>@endif
    </button>
    <form id="formCollapse" class="collapse border-bottom border-2 fixed-top bg-light py-4 position-absolute position-lg-relative d-lg-block head-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="inputName">Nome</label>
                        <input type="text" class="form-control @error('name') border border-danger @enderror"
                               id="inputName" aria-describedby="nameHelp"
                               placeholder="Inserisci nome Menu" required wire:model="name">
                        <small id="nameHelp" class="form-text text-muted">Inserisci il nome del Menu</small>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="form-group">
                        <label for="inputDescription">Descrizione</label>
                        <input type="text" class="form-control @error('description') border border-danger @enderror"
                               id="inputDescription" aria-describedby="descriptionHelp"
                               placeholder="Inserisci la descrizione" wire:model="description">
                        <small id="descriptionHelp" class="form-text text-muted">Inserisci la descrizione del
                            Menu</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="inputStartDate">Data Inizio</label>
                        <input type="text" class="form-control @error('startDate') border border-danger @enderror"
                               id="inputStartDate" aria-describedby="startDateHelp"
                               placeholder="Inserisci data inizio" wire:model="startDate">
                        <small id="startDateHelp" class="form-text text-muted">Inserisci data inizio validità</small>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="inputEndDate">Data Fine</label>
                        <input type="text" class="form-control @error('endDate') border border-danger @enderror"
                               id="inputEndDate" aria-describedby="endDateHelp"
                               placeholder="Inserisci la data fine" wire:model="endDate">
                        <small id="endDateHelp" class="form-text text-muted">Inserisci data fine validità</small>
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

    <table class="table custom-table table-responsive-xs" style="overflow-x: scroll">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Descrizione</th>
            <th scope="col">Inizio Validità</th>
            <th scope="col">Fine Validità</th>
            <th scope="col">Attivo</th>
            <th scope="col" class="text-right">Azioni</th>
        </tr>
        </thead>
        <tbody>

        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->name}}</td>
                <td>{{$menu->description}}</td>
                <td>{{$menu->start_date}}</td>
                <td>{{$menu->end_date}}</td>
                <td>
                    <button class=" px-3 py-2 border-0 bg-transparent h3"
                            wire:click="toggleStatus({{$menu->id}})">
                        @if($menu->enabled)
                            <i class="far fa-check-circle text-success"></i>
                        @else
                            <i class="far fa-times-circle text-danger"></i>
                        @endif
                    </button>
                </td>
                <td class="text-right">
                    <button wire:click="compile({{$menu->id}})">Assign</button>
                    <button wire:click="edit({{$menu->id}})">Edit</button>
                    <button wire:click="delete({{$menu->id}})">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@isset($compilingMenu)
    <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="menuCompileModal" tabindex="-1" role="dialog"
             aria-labelledby="menuCompileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="menuCompileModalLabel">Aggiungi prodotti al
                            menu {{$compilingMenu->products()->count()}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th>Nome</th>
                                <th>In Menu</th>
                                <th>Pasto</th>
                                <th>Azioni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$compilingMenu->products->contains($product)}}</td>
                                    <td>{{$product->meal->first()->name ?? 'mealName'}}</td>
                                    <td>
                                        @if($compilingMenu->products->contains($product))
                                            <button wire:click="removeFromMenu({{$product->id}})">Rimuovi</button>
                                        @else
                                            <button wire:click="addToMenu({{$product->id}})">Aggiugni</button>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary close-btn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
