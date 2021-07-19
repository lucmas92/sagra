<div>
    <button class="btn btn-block d-lg-none btn-primary" type="button" data-toggle="collapse" data-target="#formCollapse" aria-expanded="false" aria-controls="formCollapse">
        Apri Form @if($editingMode)<span>X</span>@endif
    </button>
    <form  id="formCollapse" class="collapse border-bottom border-2 fixed-top bg-light position-absolute position-lg-relative d-lg-block py-4 head-form">
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
            <th>Nome</th>
            <th class="text-right">Azioni</th>
        </tr>
        </thead>
        <tbody>

        @foreach($departments as $department)
            <tr>
                <td>{{$department->name}}</td>
                <td class="text-right">
                    <button wire:click="edit({{$department->id}})">Edit</button>
                    <button wire:click="delete({{$department->id}})">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
