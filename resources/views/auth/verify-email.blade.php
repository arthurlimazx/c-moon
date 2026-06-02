<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verificar E-mail — C-Moon</title>
  <link rel="stylesheet" href="{{ asset('css/cmoon.css') }}">
</head>
<body>

<div class="starfield"><canvas id="stars"></canvas></div>

<div class="auth-layout">

  <div class="auth-panel">
    <div class="auth-panel-placeholder"></div>
    <div class="auth-panel-orbit"></div>
    <div class="auth-panel-dot"></div>
    <div class="auth-panel-content">
      <a href="{{ route('dashboard') }}" class="auth-panel-logo">
        <span class="dot"></span>
        C-Moon
      </a>
    </div>
    <div class="auth-panel-content auth-panel-quote">
      <blockquote>
        O espaço começa<br>
        com um simples<br>
        <em>primeiro passo.</em>
      </blockquote>
      <cite>— C-Moon Sistema</cite>
    </div>
  </div>

  <div class="auth-form-side">
    <div class="auth-form-wrap animate-up">

      <div class="auth-form-header">
        <div class="auth-form-eyebrow">Verificação</div>
        <h1>Verifique seu e-mail</h1>
        <p>
          Enviamos um link de verificação para o seu endereço de e-mail.
          Clique no link para ativar sua conta e começar a explorar.
        </p>
      </div>

      @if (session('status') == 'verification-link-sent')
        <div class="auth-status">
          Um novo link de verificação foi enviado para o seu e-mail.
        </div>
      @endif

      <div style="display:flex; flex-direction:column; gap:12px;">
        <form method="POST" action="{{ route('verification.send') }}">
          @csrf
          <button type="submit" class="auth-submit">Reenviar e-mail de verificação</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="auth-submit" style="background:transparent; color:var(--text-muted); border:1px solid var(--border); box-shadow:none;">
            Sair da conta
          </button>
        </form>
      </div>

    </div>
  </div>

</div>

<script src="{{ asset('js/cmoon.js') }}"></script>
</body>
</html>