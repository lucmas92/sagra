<div>
    <button class="btn btn-block d-lg-none btn-primary" type="button" data-toggle="collapse" data-target="#formCollapse" aria-expanded="false" aria-controls="formCollapse">
        Apri Form @if($editingMode)<span>X</span>@endif
    </button>
    <form id="formCollapse" class="collapse border-bottom border-2 fixed-top bg-light py-4 d-lg-block head-form">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-5">
                    <div class="form-group">
                        <label for="inputName">Nome</label>
                        <input type="text" class="form-control @error('name') border border-danger @enderror"
                               id="inputName" aria-describedby="nameHelp" minlength="3"
                               placeholder="Inserisci il nome" required wire:model="name">
                        <small id="nameHelp" class="form-text text-muted">Inserisci il nome del Pasto</small>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group">
                        <label for="inputPosition">Posizione</label>
                        <input type="text" class="form-control @error('position') border border-danger @enderror"
                               id="inputPosition" aria-describedby="positionHelp"
                               placeholder="Inserisci la posizione" wire:model="position">
                        <small id="positionHelp" class="form-text text-muted">
                            Inserisci la posizione del Pasto
                        </small>
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
            <th scope="col">Nome</th>
            <th scope="col">Posizione</th>
            <th scope="col" class="text-right">Azioni</th>
        </tr>
        </thead>
        <tbody>

        @foreach($meals as $meal)
            <tr>
                <td>{{$meal->name}}</td>
                <td>{{$meal->position}}</td>
                <td class="text-right">
                    <button wire:click="edit({{$meal->id}})">Edit</button>
                    <button wire:click="delete({{$meal->id}})">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
