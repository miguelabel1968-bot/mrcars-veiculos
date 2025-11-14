@extends('layouts.app')

@section('title','Editar Modelo')

@section('content')
<h1>Editar Modelo</h1>

<form action="{{ route('admin.car-models.update', $model) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label class="form-label">Marca</label>
    <select name="brand_id" class="form-control">
      @foreach($brands as $b)
        <option value="{{ $b->id }}" {{ (old('brand_id', $model->brand_id) == $b->id) ? 'selected' : '' }}>{{ $b->name }}</option>
      @endforeach
    </select>
    @error('brand_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Nome do modelo</label>
    <input type="text" name="name" value="{{ old('name', $model->name) }}" class="form-control">
    @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
  </div>

  <button class="btn btn-primary">Atualizar</button>
  <a href="{{ route('admin.car-models.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
