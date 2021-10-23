@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header form_color"><h2>Modifica Piatto</h2></div>
    {{-- FORM --}}
    <div class="card-body">
      <form action="{{ route('admin.plates.update', $plate->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="name">Modifica il Piatto</label>
          <input type="text" class="form-control" id="name" placeholder="Inserisci il nome del ristorante" name="name"
          value="{{ old('name', $plate->name) }}">
        </div>
        @error('name')
              <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group">
            <label for="description">Descrizione del Piatto</label>
            <textarea class="form-control" id="description" rows="6" placeholder="Inserisci una descrizione" name="description">{{ old('description', $plate->description) }}</textarea>
        </div>
        @error('description')
              <small class="text-danger">{{ $message }}</small>
        @enderror

        <div class="form-group">
          <label for="price">Prezzo</label>
          <input type="number" class="form-control" id="price"  min="0.01" step="0.01" max="999"  placeholder="Inserisci il prezzo" name="price"
          value="{{ old('price', $plate->price) }}">
        </div>
        @error('price')
          <small class="text-danger">{{ $message }}</small>
        @enderror

        {{-- Tipologie di Piatto --}}
        <div class="form-group">
          <label for="type">Tipologia</label>
          <select class="form-control" id="type" name="type">
            @foreach ($types as $item)
              <option value="{{$item->id}}">{{ $item->name }}</option>
            @endforeach
            
          </select>
        </div>
        {{-- Tipologie di Piatto --}}

        {{-- Vegetariano --}}
        <h6>Vegetariano</h6>
        <div class="form-check">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="veg" name="veg" {{ $plate->veg == 1 ? 'checked': '' }}>
                <label class="form-check-label" for="veg">Veg</label>
            </div>
        </div>
        {{-- Vegetariano --}}

        {{-- Disponibile --}}
        <h5>Disponibilità</h5>
        <div class="form-check">
            <div class="form-check">
                <input type="checkbox" {{ $plate->availability == 1 ? 'checked': '' }} class="form-check-input" id="availability" name="availability">
                <label class="form-check-label" for="availability">Disponibile</label>
            </div>
        </div>
        {{-- Disponibile --}}
        
        {{-- File  --}}
        <div class="form-group">
            <label for="img">Inserisci l'immagine</label>
            <div class="mb-3">
              <img id="output" style="width: 150px">
            </div>
            <input type="file" class="form-control-file" id="img" name="img" value="img" onchange="loadFile(event)">
            @error('img')
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        {{-- /File  --}}
        <button type="submit" class="btn btn_color">Modifica</button>
        <a href="{{ route('admin.plates.index') }}" class="btn btn_color my-3">Annulla</a>
    </form>
    </div>
    
  </div>
</div>

<script>
    var loadFile = function(event){
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
      }
</script>
    
@endsection