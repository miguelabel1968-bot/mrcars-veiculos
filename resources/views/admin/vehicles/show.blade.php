@extends('layouts.app')

@section('title','Detalhes do Veículo')

@section('content')
<a href="{{ route('admin.vehicles.index') }}" class="btn btn-link">&larr; Voltar</a>

<h2>{{ $vehicle->brand->name ?? '' }} {{ $vehicle->carModel->name ?? '' }}</h2>

<div class="row">
  <div class="col-md-6">
    <img src="{{ $vehicle->main_photo_url }}" class="img-fluid mb-3" alt="Principal">
    <div class="d-flex gap-2">
      @foreach($vehicle->photos as $photo)
        <img src="{{ $photo->url }}" style="height:80px;object-fit:cover;">
      @endforeach
    </div>
  </div>

  <div class="col-md-6">
    <ul class="list-group mb-3">
      <li class="list-group-item"><strong>Ano:</strong> {{ $vehicle->year }}</li>
      <li class="list-group-item"><strong>Quilometragem:</strong> {{ number_format($vehicle->mileage,0,',','.') }} km</li>
      <li class="list-group-item"><strong>Cor:</strong> {{ $vehicle->color->name ?? '' }}</li>
      <li class="list-group-item"><strong>Preço:</strong> R$ {{ number_format($vehicle->price,2,',','.') }}</li>
    </ul>

    <h5>Descrição</h5>
    <p>{{ $vehicle->description }}</p>
  </div>
</div>
@endsection
