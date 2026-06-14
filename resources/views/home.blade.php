<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>C-Moon — Exploração Espacial</title>
  <link rel="stylesheet" href="{{ asset('css/cmoon.css') }}">
</head>
<body>

<div class="starfield">
  <canvas id="stars"></canvas>
</div>

{{-- ── NAVBAR ── --}}
<nav class="navbar">
  <a href="{{ route('home') }}" class="navbar-brand">
    <span class="dot"></span>
    C-Moon
  </a>

  <ul class="navbar-links">
    @auth
      <li><a href="{{ route('astronautas.index') }}">Astronautas</a></li>
      <li><a href="{{ route('corpos.index') }}">Corpos Celestes</a></li>
      <li><a href="{{ route('missoes.index') }}">Missões</a></li>
    @endauth
  </ul>

  <div class="navbar-actions">
    @auth
      <a href="{{ route('astronautas.index') }}" class="btn btn-ghost btn-sm">Dashboard</a>

      {{-- Dropdown de perfil --}}
      <div class="navbar-user" id="userMenu">
        <button class="navbar-user-btn" onclick="toggleUserDropdown()">
          <span class="navbar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
          {{ explode(' ', Auth::user()->name)[0] }}
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M3 4.5l3 3 3-3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
        </button>

        <div class="navbar-dropdown" id="userDropdown">
          <div class="navbar-dropdown-header">
            <div class="navbar-dropdown-name">{{ Auth::user()->name }}</div>
            <div class="navbar-dropdown-email">{{ Auth::user()->email }}</div>
          </div>

          <a href="{{ route('profile.edit') }}" class="navbar-dropdown-item">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M8 8a3 3 0 100-6 3 3 0 000 6z"/>
              <path d="M2 14s.5-4 6-4 6 4 6 4" stroke-linecap="round"/>
            </svg>
            Meu perfil
          </a>

          <a href="{{ route('astronautas.index') }}" class="navbar-dropdown-item">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
              <rect x="1" y="3" width="14" height="10" rx="1.5"/>
              <path d="M5 7h6M5 10h4" stroke-linecap="round"/>
            </svg>
            Dashboard
          </a>

          <div class="navbar-dropdown-divider"></div>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="navbar-dropdown-item danger">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M10 3h3a1 1 0 011 1v8a1 1 0 01-1 1h-3" stroke-linecap="round"/>
                <path d="M7 11l3-3-3-3M10 8H2" stroke-linecap="round"/>
              </svg>
              Sair
            </button>
          </form>
        </div>
      </div>
    @else
      <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Entrar</a>
      @if (Route::has('register'))
        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Criar conta</a>
      @endif
    @endauth
  </div>
</nav>

{{-- ── HERO ── --}}
<section class="hero" 
  <div class="container">
    <div class="hero-inner">
      <div class="hero-eyebrow animate-up">
        <span class="line"></span>
        Exploração além dos limites
      </div>
      <h1 class="animate-up-delay-1">
        Missões que
        <em class="gradient">moldam o futuro</em>
        do cosmos.
      </h1>
      <p class="hero-desc animate-up-delay-2">
        Plataforma centralizada para gestão de astronautas, missões espaciais
        e corpos celestes. Dados precisos, decisões mais rápidas, exploração mais segura.
      </p>
      <div class="hero-cta animate-up-delay-3">
        @auth
          <a href="{{ route('missoes.index') }}" class="btn btn-primary btn-lg">Ver missões</a>
          <a href="{{ route('astronautas.index') }}" class="btn btn-secondary btn-lg">Dashboard</a>
        @else
          <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Acessar sistema</a>
          <a href="#sobre" class="btn btn-ghost btn-lg">Saiba mais</a>
        @endauth
      </div>
    </div>
  </div>

  {{-- Decoração orbital --}}
  <div class="orbit-decoration" id="orbitDeco">
    <div class="ring-1"></div>
    <div class="ring-2"></div>
    <div class="ring-3"></div>
    <div class="orbit-planet"></div>
    <div class="orbit-dot-wrap"></div>
  </div>

  <div class="hero-scroll">
    <span>Explorar</span>
    <span class="arrow">↓</span>
  </div>
</section>

{{-- ── STATS / DASHBOARD PREVIEW ── --}}
<section class="dash-preview" id="sobre">
  <div class="container">
    <div class="section-header">
      <div class="eyebrow">
        <span></span>
        Visão geral do sistema
        <span></span>
      </div>
      <h2>Dados em tempo real da sua operação.</h2>
    </div>

    <div class="dash-grid">
      <div class="dash-card">
        <div class="dash-card-icon">🚀</div>
        <h4>Missões registradas</h4>
        <div class="dash-card-value">{{ \App\Models\Missao::count() }}</div>
        <div class="dash-card-sub">Desde o início do programa</div>
        <div class="dash-card-trend">↑ Em andamento</div>
      </div>

      <div class="dash-card">
        <div class="dash-card-icon blue">🧑‍🚀</div>
        <h4>Astronautas ativos</h4>
        <div class="dash-card-value">{{ \App\Models\Astronauta::where('status','ativo')->count() }}</div>
        <div class="dash-card-sub">Prontos para missão</div>
        <div class="dash-card-trend">↑ Operacional</div>
      </div>

      <div class="dash-card">
        <div class="dash-card-icon green">🪐</div>
        <h4>Corpos celestes</h4>
        <div class="dash-card-value">{{ \App\Models\Corpo::count() }}</div>
        <div class="dash-card-sub">Catalogados no sistema</div>
        <div class="dash-card-trend">↑ Atualizado</div>
      </div>
    </div>
  </div>
</section>

{{-- ── FEATURES ── --}}
<section class="features">
  <div class="container">
    <div class="section-header">
      <div class="eyebrow">
        <span></span>
        O que é o C-Moon
        <span></span>
      </div>
      <h2>Controle total da operação espacial.</h2>
    </div>

    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">🧑‍🚀</div>
        <h3>Astronautas</h3>
        <p>Gerencie o perfil completo de cada astronauta — especialidades, status operacional, número de missões e vinculações.</p>
        @auth
          <a href="{{ route('astronautas.index') }}" class="feature-link">Ver astronautas →</a>
        @endauth
      </div>

      <div class="feature-card">
        <div class="feature-icon">🪐</div>
        <h3>Corpos Celestes</h3>
        <p>Cadastre planetas, luas, asteroides, cometas e estrelas com dados técnicos detalhados e acessíveis em tempo real.</p>
        @auth
          <a href="{{ route('corpos.index') }}" class="feature-link">Ver corpos celestes →</a>
        @endauth
      </div>

      <div class="feature-card">
        <div class="feature-icon">🚀</div>
        <h3>Missões</h3>
        <p>Planeje e acompanhe missões do lançamento ao retorno, associando tripulações e destinos com rastreamento de status.</p>
        @auth
          <a href="{{ route('missoes.index') }}" class="feature-link">Ver missões →</a>
        @endauth
      </div>
    </div>
  </div>
</section>

<footer class="container">
  <div class="footer">
    <span class="footer-brand">C-Moon</span>
    <span>Sistema de Exploração Espacial &mdash; {{ date('Y') }}</span>
  </div>
</footer>

<script src="{{ asset('js/cmoon.js') }}"></script>
</body>
</html>