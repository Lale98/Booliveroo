@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
    {{-- FORM --}}
    <div class="card-header form_color"><h2>Crea un nuovo ristorante</h2></div>

    <div class="card-body">
        <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
              <label for="name">Nome del Ristorante</label>
              <input type="text" class="form-control" id="name" placeholder="Inserisci il nome del ristorante" name="name">
            </div>
            @error('name')
                  <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label for="piva">Inserisci la partita Iva </label>
                <input type="text" class="form-control" id="piva" placeholder="Inserisci la partita Iva" name="piva">
            </div>
            @error('piva')
                  <small class="text-danger">{{ $message }}</small>
            @enderror
    
            <div class="form-group">
                <label for="address">Inserisci la via</label>
                <input type="text" class="form-control" id="address" placeholder="Inserisci la via del ristorante" name="address">
            </div>
            @error('address')
                  <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label for="phone_number">Inserisci il numero di telefono</label>
                <input type="text" class="form-control" id="phone_number" placeholder="Inserisci il numero di telefono del ristorante" name="phone_number">
            </div>
            @error('phone_number')
                  <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label for="description">Descrizione del locale</label>
                <textarea class="form-control" id="description" rows="6" placeholder="Inserisci una descrizione" name="description"></textarea>
            </div>
            @error('description')
                  <small class="text-danger">{{ $message }}</small>
            @enderror
    
            {{-- Categorie --}}
            <h5>Scegli la categoria del ristorante</h5>
            <div class="form-check">
                @foreach ($categories as $category)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="category-{{ $category->id }}" value="{{ $category->id }}" name="category[]"
                    {{ in_array($category->id, old('category', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                </div>
                @endforeach
            </div>
            {{-- Categorie --}}
            
            {{-- File  --}}
            <div class="form-group">
                <label for="cover">Inserisci l'immagine</label>
                <div class="mb-3">
                  <img id="output" style="width: 150px">
                </div>
                <input type="file" class="form-control-file" id="cover" name="cover" value="cover" onchange="loadFile(event)">
                @error('cover')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              {{-- /File  --}}
            <button type="submit" class="btn btn_color">Crea</button>
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