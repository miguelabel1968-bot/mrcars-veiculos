<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Venda de Veículos')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    :root{
      --red:#E51937;
      --dark:#131313;
      --gray-dark:#1A1A1A;
      --gray-light:#AAA4A4;
      --white:#FFFFFF;
    }
    html,body{height:100%;}
    body{
      background-color:#111111 !important;
      color:var(--white);
      min-height:100vh;
      font-family:system-ui, -apple-system, "Segoe UI", Roboto, Arial;
    }
    .container{max-width:1350px;}
    .page-title{font-size:2.8rem;font-weight:700;margin-bottom:30px;color:white;}
    .btn-primary{
      background-color:var(--red) !important;
      border:none !important;
      color:var(--white) !important;
      font-weight:600;
      border-radius:10px;
      padding:.60rem 1.2rem;
      transition:.25s;
    }
    .btn-primary:hover{
      background-color:#c0142d !important;
      transform:translateY(-2px);
      box-shadow:0 6px 15px rgba(229,25,55,0.35);
    }
    .btn-secondary{
      background-color:var(--gray-dark) !important;
      border:none !important;
      color:var(--white) !important;
      font-weight:500;
      border-radius:10px;
      padding:.60rem 1.2rem;
      transition:.25s;
    }
    .btn-secondary:hover{
      background-color:#000 !important;
      transform:translateY(-2px);
    }
    .btn-danger{
      background-color:var(--red) !important;
      border:none !important;
      color:#fff !important;
      border-radius:10px;
      font-weight:600;
    }
    .btn-danger:hover{background-color:#b31228 !important;}
    .btn-outline-dark{
      border:2px solid var(--white) !important;
      color:var(--white) !important;
      font-weight:600;
      border-radius:10px;
    }
    .btn-outline-dark:hover{
      background-color:var(--white) !important;
      color:#111111 !important;
    }
    .card-vehicle{
      border:none !important;
      background:#fff;
      border-radius:12px;
      overflow:hidden;
      box-shadow:0 12px 28px rgba(0,0,0,0.35);
      transition:.25s;
    }
    .card-vehicle:hover{
      transform:translateY(-4px);
      box-shadow:0 18px 40px rgba(0,0,0,0.5);
    }
    </style>
</head>

<body>

    @include('partials.nav')

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
