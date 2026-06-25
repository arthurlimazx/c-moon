<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 — Página não encontrada — C-Moon</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/cmoon.css') }}">
  <style>

    .error-page {
      position: relative;
      z-index: 1;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 24px;
      overflow: hidden;
    }

    .error-page::before {
      content: '';
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 600px;
      height: 600px;
      background: radial-gradient(
        ellipse at center,
        rgba(200, 169, 110, 0.06) 0%,
        rgba(124, 159, 255, 0.04) 40%,
        transparent 70%
      );
      pointer-events: none;
      z-index: 0;
    }

    .error-wrap {
      position: relative;
      z-index: 1;
      text-align: center;
      max-width: 540px;
      animation: fadeUp .6s ease both;
    }

    .error-planet {
      position: relative;
      width: 140px;
      height: 140px;
      margin: 0 auto 40px;
    }

    .error-planet-body {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background: radial-gradient(
        ellipse at 35% 32%,
        rgba(200, 169, 110, 0.30) 0%,
        rgba(28, 34, 56, 0.95) 55%,
        rgba(6, 8, 15, 1) 100%
      );
      box-shadow:
        0 0 0 1px rgba(200, 169, 110, 0.12),
        0 0 40px rgba(200, 169, 110, 0.08),
        inset -18px -14px 36px rgba(0, 0, 0, 0.7);
      position: relative;
      z-index: 2;
    }

    .error-planet-ring {
      position: absolute;
      inset: -22px;
      border: 1px solid rgba(200, 169, 110, 0.15);
      border-radius: 50%;
      animation: orbit-spin 18s linear infinite;
    }

    .error-planet-ring::after {
      content: '';
      position: absolute;
      top: -4px;
      left: 50%;
      transform: translateX(-50%);
      width: 7px;
      height: 7px;
      background: var(--accent);
      border-radius: 50%;
      box-shadow: 0 0 10px var(--accent), 0 0 24px rgba(200, 169, 110, 0.5);
    }

    .error-planet-ring-outer {
      position: absolute;
      inset: -44px;
      border: 1px solid rgba(124, 159, 255, 0.07);
      border-radius: 50%;
      animation: orbit-spin 32s linear reverse infinite;
    }

    .error-code {
      font-family: 'Bebas Neue', sans-serif;
      font-size: clamp(80px, 15vw, 120px);
      line-height: 1;
      letter-spacing: 0.06em;
      color: transparent;
      background: linear-gradient(
        135deg,
        rgba(200, 169, 110, 0.9) 0%,
        rgba(232, 200, 138, 0.6) 40%,
        rgba(124, 159, 255, 0.5) 100%
      );
      -webkit-background-clip: text;
      background-clip: text;
      margin-bottom: 8px;
      filter: drop-shadow(0 0 32px rgba(200, 169, 110, 0.2));
    }

    .error-eyebrow {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: .16em;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .error-eyebrow span {
      width: 24px;
      height: 1px;
      background: var(--accent);
      opacity: 0.5;
      display: block;
    }

    .error-title {
      font-family: 'Bebas Neue', sans-serif;
      font-size: clamp(24px, 4vw, 32px);
      letter-spacing: 0.03em;
      color: var(--text);
      margin-bottom: 14px;
    }

    .error-desc {
      font-size: 15px;
      color: var(--text-muted);
      line-height: 1.7;
      margin-bottom: 40px;
    }

    .error-actions {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      flex-wrap: wrap;
    }

    .error-divider {
      width: 1px;
      height: 48px;
      background: linear-gradient(to bottom, transparent, var(--border), transparent);
      margin: 32px auto;
    }

    .error-links {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      flex-wrap: wrap;
    }

    .error-links-label {
      font-size: 12px;
      color: var(--text-dim);
      letter-spacing: .05em;
      margin-right: 4px;
    }

    .error-link-pill {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 5px 12px;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 20px;
      font-size: 12px;
      color: var(--text-muted);
      transition: all .2s;
    }

    .error-link-pill:hover {
      border-color: var(--border-active);
      color: var(--text);
      background: var(--surface-2);
      transform: translateY(-1px);
    }

    .error-logo {
      position: fixed;
      top: 24px;
      left: 40px;
      font-family: 'Bebas Neue', sans-serif;
      font-size: 20px;
      letter-spacing: -0.02em;
      color: var(--text);
      display: flex;
      align-items: center;
      gap: 8px;
      z-index: 10;
      opacity: 0.7;
      transition: opacity .2s;
    }

    .error-logo:hover { opacity: 1; }

    .error-logo .dot {
      width: 7px; height: 7px;
      background: var(--accent);
      border-radius: 50%;
      animation: pulse 2.5s ease infinite;
    }
  </style>
</head>
<body>

<div class="starfield"><canvas id="stars"></canvas></div>

<a href="{{ url('/') }}" class="error-logo">
  <span class="dot"></span>
  C-Moon
</a>

<div class="error-page">
  <div class="error-wrap">

    <!-- Planeta animado -->
    <div class="error-planet">
      <div class="error-planet-ring-outer"></div>
      <div class="error-planet-ring"></div>
      <div class="error-planet-body"></div>
    </div>

    <!-- Código de erro -->
    <div class="error-code">404</div>

    <div class="error-eyebrow">
      <span></span>
      Página não encontrada
      <span></span>
    </div>

    <h1 class="error-title">Você derivou para o espaço profundo</h1>

    <p class="error-desc">
      A rota que você tentou acessar não existe ou foi movida.<br>
      Verifique o endereço ou retorne à base.
    </p>

    <div class="error-actions">
      <a href="{{ url('/') }}" class="btn btn-primary">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
          <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        Voltar para a página inicial
      </a>
      <a href="javascript:history.back()" class="btn btn-ghost">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="15 18 9 12 15 6"/>
        </svg>
        Página anterior
      </a>
    </div>

    <div class="error-divider"></div>

    <!-- Links rápidos -->
    <div class="error-links">
      <span class="error-links-label">Ir para</span>

      @if (Route::has('missions.index'))
        <a href="{{ route('missions.index') }}" class="error-link-pill">🚀 Missões</a>
      @endif

      @if (Route::has('astronauts.index'))
        <a href="{{ route('astronauts.index') }}" class="error-link-pill">🧑‍🚀 Astronautas</a>
      @endif

      @if (Route::has('celestial-bodies.index'))
        <a href="{{ route('celestial-bodies.index') }}" class="error-link-pill">🪐 Corpos Celestes</a>
      @endif
    </div>

  </div>
</div>

<script src="{{ asset('js/cmoon.js') }}"></script>
</body>
</html>