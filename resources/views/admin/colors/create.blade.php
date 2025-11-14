@extends('layouts.app')

@section('title','Nova Cor')

@section('content')
<h1>Criar Cor</h1>

<form action="{{ route('admin.colors.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
    @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
  </div>

  <button class="btn btn-primary">Salvar</button>
  <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
