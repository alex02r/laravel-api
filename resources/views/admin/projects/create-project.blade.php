@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Creazione di un progetto</h1>
            </div>
            <div class="col-8">
                <div class="shadow rounded p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.project.store') }}" method="post" enctype="multipart/form-data">
                        @csrf{{-- 
                        <div class="d-flex align-items-center justify-content-center">
                            <img class="w-25" src="https://cdn-icons-png.flaticon.com/512/3767/3767084.png" alt="folde img">
                        </div> --}}
                        <div class="my-3">
                            <label for="img" class="form-label">Inserisci un immagine: </label>
                            <input type="file" name="img" id="img">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Inserisci il Titolo:</label>
                            <input type="text" class="form-control" name="name" id="name" >
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Inserisci La descrizione:</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            Tecnologie: 
                            @foreach ($technologies as $tech)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="checks[]" id="check-{{ $tech->id }}" value="{{ $tech->id }}">
                                    <label class="form-check-label" for="check-{{ $tech->id }}">{{ $tech->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex gap-4 mb-3">
                            <div class="">
                                <label for="start_date">Inserisci data inizio</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" >
                            </div>
                            <div class="">
                                <label for="end_date">Inserisci data fine</label>
                                <input type="date" class="form-control" name="end_date" id="end_date">
                            </div>
                            <div class="">
                                <label for="type_id" >Seleziona il tipo:</label>
                                <select name="type_id" id="type_id" class="form-select">
                                    <option value="">Nessun tipo</option>
                                    @foreach ($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Crea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection