@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center row-gap-5">
            <div class="col-12">
                <h1>Modifica la tipologia</h1>
            </div>
            <div class="col-4 bg-light shadow rounded p-3">
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <form action="{{ route('admin.types.update', ['type'=>$type]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Modifica il nome della tipologia</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $type->name}}">
                    </div>
                    <button type="submit" class="btn btn-sm btn-warning">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection