@extends('layouts.app')

@section('title','Cores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1>Cores</h1>
  <a href="{{ route('admin.colors.create') }}" class="btn btn-primary">Nova cor</a>
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
    @forelse($colors as $c)
      <tr>
        <td>{{ $c->name }}</td>
        <td class="text-end">
          <a href="{{ route('admin.colors.edit', $c) }}" class="btn btn-sm btn-secondary">Editar</a>
          <form action="{{ route('admin.colors.destroy', $c) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Excluir?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Excluir</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="2">Nenhuma cor cadastrada.</td></tr>
    @endforelse
  </tbody>
</table>

{{ $colors->links() }}
@endsection
