@extends('layouts.dashboard')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">{{ $project->title }}</h1>
            </div>

            <div class="col-12 ">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary mb-4">Torna alla lista progetti</a>
                <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="btn btn-warning mb-4">Modifica Progetto</a>
            </div>

            <!-- Dettagli del Progetto -->
            <div class="col-12 mt-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Dettagli del progetto</h5>
                        <ul class="list-unstyled">
                            <li><strong>Slug:</strong> {{ $project->slug }}</li>
                            <li><strong>Description:</strong> {{ $project->description ?? 'Nessuna descrizione disponibile' }}</li>
                            <li><strong>Date:</strong> {{ $project->date }}</li>
                            <li><strong>Type:</strong> {{ $project->type ? $project->type->name : 'Nessun tipo assegnato' }}</li>
                        </ul>
                        <div class="mt-4">
                            <h5>Immagine del Progetto</h5>
                            <img src="{{ $project->image ? asset('storage/' . $project->image) : 'https://via.placeholder.com/600x400' }}" class="img-fluid rounded">
                        </div>
                        <form action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-project">Elimina Progetto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.projects.partials.modal_delete')
@endsection