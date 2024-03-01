@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row row-gap-4">
            <div class="col-12 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h1>TYPES</h1>
                    </div>
                    <div class="">
                        <a class="btn btn-warning" href="{{ route('admin.types.create') }}">Add Type</a>
                    </div>
                </div>
            </div>
            <table class="table table-dark">
                <thead>
                    <th>Nome</th>
                    <th>Progetti associati</th>
                    <th>Strumenti</th>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <td>{{ $type->name }}</td>
                            <td></td>
                            <td class="d-flex gap-3">
                                <a href="{{ route('admin.types.show', ['type'=>$type->id]) }}" class="btn btn-sm btn-primary">Show</a>
                                <a href="{{ route('admin.types.edit', ['type'=>$type->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.types.destroy', ['type'=>$type]) }}" method="post" onsubmit="return confirm('Sei sicuro di voler eliminare questo project')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Elimina</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection