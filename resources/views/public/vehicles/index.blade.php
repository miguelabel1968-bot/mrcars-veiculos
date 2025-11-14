@extends('layouts.app')

@section('title','Veículos à venda')

@section('content')
<h1 class="mb-4">Veículos</h1>

<div class="row">
  @forelse($vehicles as $v)
    <div class="col-md-4 mb-4">
      <div class="card card-vehicle h-100" style="border-radius:12px; overflow:hidden;">
        <img src="{{ $v->main_photo_url ?? asset('images/placeholder-car.png') }}" class="card-img-top" style="height:260px; object-fit:cover; background:#f0f0f0;" alt="Foto do veículo">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title mb-1" style="font-weight:700">{{ $v->brand->name ?? '' }} {{ $v->carModel->name ?? '' }}</h5>
          <div class="text-muted small mb-2">{{ $v->year }} • {{ number_format($v->mileage ?? 0,0,',','.') }} km</div>
          <div class="mb-3" style="font-weight:800; color:#1A1A1A; font-size:1.15rem">R$ {{ number_format($v->price ?? 0,2,',','.') }}</div>
          <a href="{{ route('public.vehicles.show', $v) }}" class="btn btn-primary mt-auto">Ver detalhes</a>
        </div>
      </div>
    </div>
  @empty
    <div class="col-12">
      <div class="alert alert-info">Nenhum veículo cadastrado.</div>
    </div>
  @endforelse
</div>

<div class="d-flex justify-content-center">
  {{ $vehicles->links() }}
</div>
@endsection
