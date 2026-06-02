<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name', 'C-Moon')) — C-Moon</title>

  {{-- Fonts: Bebas Neue (títulos) + Outfit (corpo) --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  {{-- C-Moon design system --}}
  <link rel="stylesheet" href="{{ asset('css/cmoon.css') }}">
</head>
<body>

  @include('layouts.navigation')

  <main style="position: relative; z-index: 1; padding-top: 64px;">
    <div class="container" style="padding-top: 0; padding-bottom: 64px;">

      @if(session('success'))
        <div class="alert alert-success" data-auto-dismiss style="margin-top: 24px;">
          ✓ {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger" data-auto-dismiss style="margin-top: 24px;">
          ✕ {{ session('error') }}
        </div>
      @endif

      @yield('content')
    </div>
  </main>

  <script src="{{ asset('js/cmoon.js') }}"></script>
  @stack('scripts')

</body>
</html>