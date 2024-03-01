@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center row-gap-5">
            <div class="col-12">
                <h1>Aggiungi una nuova tipologia</h1>
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
                <form action="{{ route('admin.types.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Inserisci il nome della tipologia</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Aggiungi</button>
                </form>
            </div>
        </div>
    </div>
@endsection