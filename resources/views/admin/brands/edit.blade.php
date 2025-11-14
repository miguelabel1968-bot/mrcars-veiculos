@extends('layouts.app')

@section('title','Editar Marca')

@section('content')
<h1>Editar Marca</h1>

<form action="{{ route('admin.brands.update', $brand) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" name="name" value="{{ old('name', $brand->name) }}" class="form-control">
    @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
  </div>
  <button class="btn btn-primary">Atualizar</button>
  <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
