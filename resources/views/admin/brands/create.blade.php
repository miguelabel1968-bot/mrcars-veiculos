@extends('layouts.app')

@section('title','Nova Marca')

@section('content')
<h1>Criar Marca</h1>

<form action="{{ route('admin.brands.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
    @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
  </div>
  <button class="btn btn-primary">Salvar</button>
  <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
