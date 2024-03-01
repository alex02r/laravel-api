@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
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
                    <form action="{{ route('admin.project.update', ['project'=>$project]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="my-3">
                            <label for="img" class="form-label">Modifica l'immagine: </label>
                            <input type="file" name="img" id="img">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Modifica il Titolo:</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $project['name'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Modifica La descrizione:</label>
                            <textarea name="description" id="description" class="form-control">{{ old('description') ?? $project['description'] }}</textarea>
                        </div>
                        <div class="mb-3">
                            Tecnologie: 
                            @foreach ($technologies as $tech)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="checks[]" id="check-{{ $tech->id }}" value="{{ $tech->id }}" @checked(in_array($tech->id, old('checks', [])) || in_array($tech->id, $project->technologies->keyby('id')->keys()->toArray()))>
                                    <label class="form-check-label" for="check-{{ $tech->id }}">{{ $tech->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex gap-4 mb-3">
                            <div class="">
                                <label for="start_date">Modifica data inizio</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') ?? $project['start_date'] }}">
                            </div>
                            <div class="">
                                <label for="end_date">Modifica data fine</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') ?? $project['end_date'] }}">
                            </div>
                            <div class="">
                                <label for="type_id" >Modifica il tipo:</label>
                                <select name="type_id" id="type_id" class="form-select">
                                    @foreach ($types as $type)
                                        <option value="{{$type->id}}" @selected( $type->id == old('type_id', $project->type_id ? $project->type_id : ''))>{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Salva</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection