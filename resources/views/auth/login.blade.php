<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entrar — C-Moon</title>
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
      <a href="{{ route('welcome') }}" class="auth-panel-logo">
        <span class="dot"></span>
        C-Moon
      </a>
    </div>

    <div class="auth-panel-content auth-panel-quote">

      <blockquote>
        A Terra é o berço da humanidade,<br>
        mas <em>não se pode viver</em><br>
        no berço para sempre.
      </blockquote>
      <cite>— Konstantin Tsiolkovsky</cite>

      <div class="auth-panel-tags">
        <span class="auth-panel-tag"><span>🚀</span> Missões</span>
        <span class="auth-panel-tag"><span>🧑‍🚀</span> Astronautas</span>
        <span class="auth-panel-tag"><span>🪐</span> Corpos Celestes</span>
      </div>
    </div>
  </div>

  <div class="auth-form-side">
    <div class="auth-form-wrap animate-up">

      <div class="auth-form-header">
        <div class="auth-form-eyebrow">Acesso ao sistema</div>
        <h1>Bem-vindo de volta</h1>
        <p>Entre com suas credenciais para acessar o painel de controle.</p>
      </div>

      @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
          <label class="form-label" for="email">E-mail</label>
          <div class="auth-input-wrap">
            <svg class="auth-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
              <polyline points="22,6 12,13 2,6"/>
            </svg>
            <input type="email" id="email" name="email"
              class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
              value="{{ old('email') }}"
              placeholder="seu@email.com"
              autocomplete="email" autofocus required>
          </div>
          @error('email') <span class="form-error">✕ {{ $message }}</span> @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Senha</label>
          <div class="auth-input-wrap">
            <svg class="auth-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            <input type="password" id="password" name="password"
              class="form-control has-toggle {{ $errors->has('password') ? 'is-invalid' : '' }}"
              placeholder="••••••••"
              autocomplete="current-password" required>
            <button type="button" class="auth-toggle-btn" data-target="password">
              <svg class="icon-eye" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
              <svg class="icon-eye-off" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" style="display:none;">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                <line x1="1" y1="1" x2="23" y2="23"/>
              </svg>
            </button>
          </div>
          @error('password') <span class="form-error">✕ {{ $message }}</span> @enderror
        </div>

        <div class="auth-remember">
          <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            Lembrar acesso
          </label>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="auth-link-dim">Esqueceu a senha?</a>
          @endif
        </div>

        <button type="submit" class="auth-submit">Entrar no sistema</button>
      </form>

      @if (Route::has('register'))
        <div class="auth-form-footer">
          Não tem conta? <a href="{{ route('register') }}">Criar conta</a>
        </div>
      @endif

    </div>
  </div>

</div>

<script src="{{ asset('js/cmoon.js') }}"></script>
</body>
</html>