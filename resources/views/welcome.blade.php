@extends('layouts.app')

@section('title', 'Início')

@section('content')

<div class="home-page">

{{-- ══ HERO ══ --}}
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-grid"></div>
 

  <div class="hero-inner wrap" style="max-width:100%; padding:0;">
    <div class="hero-left">
      <div class="hero-eyebrow">
        <span class="hero-eyebrow-line"></span>
        Exploração espacial
      </div>
      <h1 class="hero-title">
        MISSÕES
        <span class="hero-title-accent">QUE MOLDAM</span>
        O COSMOS.
      </h1>
      <p class="hero-sub">
        Plataforma centralizada para gestão de astronautas,
        missões espaciais e corpos celestes. Dados precisos,
        decisões mais rápidas.
      </p>
      <div class="hero-cta">
        @auth
          <a href="{{ route('missoes.index') }}" class="btn-gold">Ver missões</a>
          <a href="{{ route('astronautas.index') }}" class="btn-ghost-slim">Dashboard →</a>
        @else
          <a href="{{ route('login') }}" class="btn-gold">Acessar sistema</a>
          <a href="#sobre" class="btn-ghost-slim">Saiba mais →</a>
        @endauth
      </div>
    </div>

    <div class="hero-right">
      
      <div class="hero-float-text">
        Dados precisos para<br>decisões mais rápidas<br>e exploração mais segura.
      </div>
    </div>
  </div>

</section>

{{-- ══ ABOUT ══ --}}
<section class="about" id="sobre">
  <div class="wrap" style="max-width:100%; padding:0;">
    <div class="about-inner">
      <div class="about-left reveal">
        <div class="about-micro">AT</div>
        <h2 class="about-title">C&#8209;MOON,</h2>
        <p class="about-body">
          Acreditamos que a exploração espacial vai além de dados —
          é sobre decisões mais rápidas, missões mais seguras e
          o avanço contínuo da humanidade além da atmosfera terrestre.
          Cada registro é uma peça fundamental da história da ciência.
        </p>
      </div>
      <div class="about-right">
        <div class="stat-cell reveal reveal-delay-1">
          <div class="stat-label">missões registradas desde o início do programa</div>
          <div class="stat-val">{{ \App\Models\Missao::count() }}</div>
        </div>
        <div class="stat-cell reveal reveal-delay-2">
          <div class="stat-label">astronautas ativos e prontos para operação</div>
          <div class="stat-val">{{ \App\Models\Astronauta::where('status','ativo')->count() }}</div>
        </div>
        <div class="stat-cell reveal reveal-delay-3">
          <div class="stat-label">corpos celestes catalogados no sistema</div>
          <div class="stat-val">{{ \App\Models\Corpo::count() }}</div>
        </div>
        <div class="stat-cell dark reveal reveal-delay-4">
          <p class="stat-dark-text">
            O universo não espera — nem sua operação deveria.
          </p>
          @auth
            <a href="{{ route('missoes.index') }}" class="stat-dark-link">Ver missões →</a>
          @else
            <a href="{{ route('login') }}" class="stat-dark-link">Entrar no sistema →</a>
          @endauth
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ══ SERVIÇOS ══ --}}
<section class="services" id="servicos">
  <div class="wrap" style="max-width:100%; padding:0;">
    <div class="services-header">
      <div class="services-header-left reveal">
        <div class="section-eyebrow">O que oferecemos</div>
        <h2 class="section-title">MÓDULOS<br>DO SISTEMA</h2>
      </div>
      <div class="services-header-right reveal reveal-delay-2">
        <p class="services-header-desc">
          Três módulos integrados para gestão completa da operação espacial.
          Cada um projetado para oferecer precisão, velocidade e controle total.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- ══ DESTAQUES ALTERNADOS ══ --}}
<section class="highlight">

  {{-- linha 1: visual | texto --}}
  <div class="highlight-row">
    <div class="highlight-visual">
      <div class="highlight-planet-scene">
        <div class="hl-planet">
         
        </div>
      </div>
      <div class="hl-label">Gestão de Astronautas</div>
    </div>
    <div class="highlight-text reveal">
      <div class="highlight-tag">Módulo 01</div>
      <h3 class="highlight-title">EQUIPE DE<br>VOO COMPLETA</h3>
      <p class="highlight-body">
        Gerencie cada tripulante com profundidade — especialidades, histórico de missões,
        status operacional e vinculações. Tudo em um só lugar, acessível em segundos.
      </p>
      @auth
        <a href="{{ route('astronautas.index') }}" class="highlight-link">Ver astronautas →</a>
      @else
        <a href="{{ route('login') }}" class="highlight-link">Acessar sistema →</a>
      @endauth
    </div>
  </div>

  {{-- linha 2: texto | visual --}}
  <div class="highlight-row reverse">
    <div class="highlight-visual">
      <div class="highlight-planet-scene">
        <div class="hl-planet">
         
        </div>
      </div>
      <div class="hl-label">Cartografia Espacial</div>
    </div>
    <div class="highlight-text reveal">
      <div class="highlight-tag">Módulo 02</div>
      <h3 class="highlight-title">CARTOGRAFIA<br>DO COSMOS</h3>
      <p class="highlight-body">
        Catalogue o universo com precisão científica. Planetas, luas, asteroides,
        cometas e estrelas — cada objeto catalogado com dados técnicos completos.
      </p>
      @auth
        <a href="{{ route('corpos.index') }}" class="highlight-link">Ver corpos celestes →</a>
      @else
        <a href="{{ route('login') }}" class="highlight-link">Acessar sistema →</a>
      @endauth
    </div>
  </div>

</section>




{{-- ══ FOOTER ══ --}}
<footer class="footer">
  <div class="wrap">
    <div class="footer-hero reveal">
      <h2 class="footer-cta-title">
        ALÉM DA<br><span>ATMOSFERA.</span>
      </h2>
      @auth
        <a href="{{ route('astronautas.index') }}" class="btn-gold">Acessar dashboard</a>
      @else
        <a href="{{ route('login') }}" class="btn-gold">Entrar no sistema</a>
      @endauth
    </div>
    <div class="footer-bottom">
      <span class="footer-brand">
        <span class="footer-brand-dot"></span>
        C-MOON
      </span>
      <div class="footer-links">
        @auth
          <a href="{{ route('astronautas.index') }}">Astronautas</a>
          <a href="{{ route('corpos.index') }}">Corpos Celestes</a>
          <a href="{{ route('missoes.index') }}">Missões</a>
          <a href="{{ route('profile.edit') }}">Perfil</a>
        @else
          <a href="{{ route('login') }}">Entrar</a>
          @if(Route::has('register'))<a href="{{ route('register') }}">Criar conta</a>@endif
        @endauth
      </div>
      <span class="footer-copy">Sistema de Exploração Espacial — {{ date('Y') }}</span>
    </div>
  </div>
</footer>

</div>{{-- /home-page --}}

@endsection