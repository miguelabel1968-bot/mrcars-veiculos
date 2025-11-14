@extends('layouts.app')

@section('title','Marcas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1>Marcas</h1>
  <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Nova marca</a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped">
  <thead>
    <tr>
      <th>Nome</th>
      <th class="text-end">Ações</th>
    </tr>
  </thead>
  <tbody>
    @forelse($brands as $brand)
      <tr>
        <td>{{ $brand->name }}</td>
        <td class="text-end">
          <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-secondary">Editar</a>
          <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Excluir?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Excluir</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="2">Nenhuma marca cadastrada.</td></tr>
    @endforelse
  </tbody>
</table>

{{ $brands->links() }}
@endsection
