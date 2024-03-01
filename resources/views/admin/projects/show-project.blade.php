@extends('layouts.app')
    @section('content')
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="d-flex w-100 justify-content-end gap-2">
                                <a href="{{ route('admin.project.edit', ['project'=>$project]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.project.destroy', ['project'=>$project]) }}" method="post" onsubmit="return confirm('Sei sicuro di voler eliminare questo project')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Elimina</button>
                                </form>
                            </div>
                        </div>
                        <img class="card-img-start-fluid p-3 w-25" src="{{ $project->img !== null ? asset('storage/'. $project->img) : 'https://cdn-icons-png.flaticon.com/512/3767/3767084.png' }}" alt="folder">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->name}}</h5>
                            <p class="card-text">Slug: {{ $project->slug}}</p>
                            <p class="card-text">{{ $project->description}}</p>
                            <p class="card-text">Tipologia Associata: {{ $project->type ? $project->type->name : 'Nessun tipo'}}</p>
                            <p class="card-text">Tecnologie: 
                                    @forelse ($project->technologies as $tech)
                                        <span class="badge rounded-pill text-bg-{{ $tech->class_color}}"> {{ $tech->name }}</span>
                                    @empty
                                        Nessuna tecnologia associata
                                    @endforelse
                            </p>
                            <div class="text-secondary">Data Creazione: {{ $project->start_date }}</div>
                            <div class="text-secondary">Data Fine: {{ $project->end_date }}</div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    @endsection