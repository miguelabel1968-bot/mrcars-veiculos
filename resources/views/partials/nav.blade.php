<nav class="navbar navbar-expand-lg" style="background:#131313;">
  <div class="container">
    <a class="navbar-brand text-white" href="{{ route('public.vehicles.index') }}" style="font-weight:700">MCARS</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false">
      <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto align-items-center">

        @auth
          @if(auth()->user()->is_admin ?? false)
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ url('admin/vehicles') }}">Admin</a>
            </li>
          @endif

          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
              @csrf
              <button class="btn btn-outline-dark btn-sm ms-2">Sair</button>
            </form>
          </li>
        @endauth

        {{-- Nada aparece quando NÃO está logado --}}
        
      </ul>
    </div>
  </div>
</nav>
