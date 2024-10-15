@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <h2>Aggiungi un nuovo progetto</h2>
        </div>
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.projects.store') }}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="title" class="control-label">Nome Progetto</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" >
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="control-label">Descrizione</label>
                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Inserisci una descrizione (opzionale)">{{ old('description') }}</textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="image" class="control-label">Immagine</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                    <label class="control-label" for="type">Seleziona il tipo di progetto</label>
                        <select class="form-control" name="type_id" required>
                            <option value="">-- Seleziona un tipo --</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @selected($type->id == old('type_id'))>{{ $type->name }}</option>
                            @endforeach
                        </select>

                        @error('type_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3">
                        <label for="date" class="control-label">Data</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" >
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Salva Progetto</button>
                    </div>
                </div>
            </form>   
        </div>
    </div>
</div>


@endsection