@extends('layouts.app')
    @section('content')
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-6">
                   <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex w-100 justify-content-end gap-2">
                            <a href="{{ route('admin.types.edit', ['type'=>$type]) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.types.destroy', ['type'=>$type]) }}" method="post" onsubmit="return confirm('Sei sicuro di voler eliminare questo project')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Elimina</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $type->name}}</h5>
                        <p class="card-text">Slug: {{ $type->slug}}</p>
                    </div> 
                </div>
            </div>
        </div>
    @endsection