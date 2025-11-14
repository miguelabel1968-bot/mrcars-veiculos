@extends('layouts.app')

@section('title','Cadastrar Veículo')

@section('content')
<h1>Cadastrar Veículo</h1>

<form action="{{ route('admin.vehicles.store') }}" method="POST">
  @csrf

  <div class="row">
    <div class="col-md-4 mb-3">
      <label class="form-label">Marca</label>
      <select id="brand_id" name="brand_id" class="form-control">
        <option value="">-- selecione --</option>
        @foreach($brands as $b)
          <option value="{{ $b->id }}" {{ old('brand_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
        @endforeach
      </select>
      @error('brand_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
      <label class="form-label">Modelo</label>
      <select id="car_model_id" name="car_model_id" class="form-control" disabled>
        <option value="">-- selecione --</option>
      </select>
      @error('car_model_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
      <label class="form-label">Cor</label>
      <select id="color_id" name="color_id" class="form-control">
        <option value="">-- selecione --</option>
        @foreach($colors as $c)
          <option value="{{ $c->id }}" {{ old('color_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
        @endforeach
      </select>
      @error('color_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 mb-3">
      <label class="form-label">Ano</label>
      <input type="number" name="year" value="{{ old('year') }}" class="form-control">
      @error('year') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 mb-3">
      <label class="form-label">Quilometragem</label>
      <input type="number" name="mileage" value="{{ old('mileage') }}" class="form-control">
      @error('mileage') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 mb-3">
      <label class="form-label">Preço</label>
      <input type="text" name="price" value="{{ old('price') }}" class="form-control">
      @error('price') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 mb-3">
      <label class="form-label">Foto principal (URL)</label>
      <input type="url" name="main_photo_url" value="{{ old('main_photo_url') }}" class="form-control">
      @error('main_photo_url') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-12 mb-3">
      <label class="form-label">Descrição</label>
      <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
      @error('description') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-12 mb-3">
      <label class="form-label">Fotos (URLs) — mínimo 3</label>
      <div class="row">
        <div class="col-md-4 mb-2"><input type="url" name="photos[]" class="form-control" placeholder="Foto 1" value="{{ old('photos.0') }}"></div>
        <div class="col-md-4 mb-2"><input type="url" name="photos[]" class="form-control" placeholder="Foto 2" value="{{ old('photos.1') }}"></div>
        <div class="col-md-4 mb-2"><input type="url" name="photos[]" class="form-control" placeholder="Foto 3" value="{{ old('photos.2') }}"></div>
      </div>
      @error('photos') <div class="text-danger mt-1">{{ $message }}</div> @enderror
      @error('photos.*') <div class="text-danger mt-1">{{ $message }}</div> @enderror
    </div>
  </div>

  <div class="mt-4 d-flex flex-column flex-sm-row gap-2 align-items-start">
    <div class="d-flex gap-2">
      <button class="btn btn-primary btn-lg" type="submit">Salvar</button>
      <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-dark btn-lg">Cancelar</a>
    </div>
  </div>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const brandSelect = document.getElementById('brand_id');
  const modelSelect = document.getElementById('car_model_id');

  function clearModels() {
    modelSelect.innerHTML = '<option value="">-- selecione --</option>';
    modelSelect.disabled = true;
  }

  function fillModels(models) {
    modelSelect.innerHTML = '<option value="">-- selecione --</option>';
    models.forEach(m => {
      const opt = document.createElement('option');
      opt.value = m.id;
      opt.textContent = m.name;
      modelSelect.appendChild(opt);
    });
    modelSelect.disabled = false;
  }

  brandSelect.addEventListener('change', function () {
    const brandId = this.value;
    if (!brandId) {
      clearModels();
      return;
    }
    fetch('/admin/brands/' + brandId + '/car-models')
      .then(resp => { if (!resp.ok) throw new Error('Network response was not ok'); return resp.json(); })
      .then(data => fillModels(data))
      .catch(() => { clearModels(); alert('Não foi possível carregar os modelos.'); });
  });
});
</script>
@endpush
