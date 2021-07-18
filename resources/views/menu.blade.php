@extends('layouts.app')

@section('content')
    <livewire:menu></livewire:menu>

@endsection

@section('page-script')

    <script type="text/javascript">
        window.livewire.on('menuCompile', () => {
            $('#menuCompileModal').modal('show');
        });
    </script>
@endsection
