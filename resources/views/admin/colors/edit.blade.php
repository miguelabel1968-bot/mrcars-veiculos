@extends('layouts.app')

@section('title','Editar Cor')

@section('content')
<h1>Editar Cor</h1>

<form action="{{ route('admin.colors.update', $color) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" name="name" value="{{ old('name', $color->name) }}" class="form-control">
    @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
  </div>

  <button class="btn btn-primary">Atualizar</button>
  <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
