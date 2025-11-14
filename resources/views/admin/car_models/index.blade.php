@extends('layouts.app')

@section('title','Modelos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1>Modelos</h1>
  <a href="{{ route('admin.car-models.create') }}" class="btn btn-primary">Novo modelo</a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped">
  <thead>
    <tr>
      <th>Modelo</th>
      <th>Marca</th>
      <th class="text-end">Ações</th>
    </tr>
  </thead>
  <tbody>
    @forelse($models as $m)
      <tr>
        <td>{{ $m->name }}</td>
        <td>{{ $m->brand->name ?? '' }}</td>
        <td class="text-end">
          <a href="{{ route('admin.car-models.edit', $m) }}" class="btn btn-sm btn-secondary">Editar</a>
          <form action="{{ route('admin.car-models.destroy', $m) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Excluir?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Excluir</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="3">Nenhum modelo cadastrado.</td></tr>
    @endforelse
  </tbody>
</table>

{{ $models->links() }}
@endsection
