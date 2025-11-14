@extends('layouts.app')

@section('title','Novo Modelo')

@section('content')
<h1>Criar Modelo</h1>

<form action="{{ route('admin.car-models.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label">Marca</label>
    <select name="brand_id" class="form-control">
      <option value="">-- selecione --</option>
      @foreach($brands as $b)
        <option value="{{ $b->id }}" {{ old('brand_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
      @endforeach
    </select>
    @error('brand_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Nome do modelo</label>
    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
    @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
  </div>

  <button class="btn btn-primary">Salvar</button>
  <a href="{{ route('admin.car-models.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
