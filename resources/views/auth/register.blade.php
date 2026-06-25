<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Criar Conta — C-Moon</title>
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
        O universo não é apenas mais estranho<br>
        do que supomos — é mais estranho<br>
        <em>do que podemos supor.</em>
      </blockquote>
      <cite>— J.B.S. Haldane</cite>

      <div class="auth-panel-tags">
        <span class="auth-panel-tag"><span>🌌</span> Exploração</span>
        <span class="auth-panel-tag"><span>📡</span> Monitoramento</span>
        <span class="auth-panel-tag"><span>🛰️</span> Operações</span>
      </div>
    </div>
  </div>

  <div class="auth-form-side">
    <div class="auth-form-wrap animate-up">

      <div class="auth-form-header">
        <div class="auth-form-eyebrow">Nova conta</div>
        <h1>Criar sua conta</h1>
        <p>Junte-se ao sistema de exploração e controle espacial.</p>
      </div>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
          <label class="form-label" for="name">Nome completo</label>
          <div class="auth-input-wrap">
            <svg class="auth-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
            <input type="text" id="name" name="name"
              class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
              value="{{ old('name') }}"
              placeholder="Ex: Neil Armstrong"
              autocomplete="name" autofocus required>
          </div>
          @error('name') <span class="form-error">✕ {{ $message }}</span> @enderror
        </div>

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
              autocomplete="email" required>
          </div>
          @error('email') <span class="form-error">✕ {{ $message }}</span> @enderror
        </div>

        <div class="auth-form-row">
          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label" for="password">Senha</label>
            <div class="auth-input-wrap">
              <svg class="auth-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
              <input type="password" id="password" name="password"
                class="form-control has-toggle {{ $errors->has('password') ? 'is-invalid' : '' }}"
                placeholder="Mín. 8 caracteres"
                autocomplete="new-password" required>
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

          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label" for="password_confirmation">Confirmar</label>
            <div class="auth-input-wrap">
              <svg class="auth-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
              </svg>
              <input type="password" id="password_confirmation" name="password_confirmation"
                class="form-control has-toggle"
                placeholder="Repita a senha"
                autocomplete="new-password" required>
              <button type="button" class="auth-toggle-btn" data-target="password_confirmation">
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
          </div>
        </div>

        <div class="auth-strength" id="authStrength" style="margin-top:12px; margin-bottom:20px;">
          <div class="auth-strength-bars">
            <div class="auth-strength-bar"></div>
            <div class="auth-strength-bar"></div>
            <div class="auth-strength-bar"></div>
            <div class="auth-strength-bar"></div>
          </div>
          <span class="auth-strength-label">—</span>
        </div>

        <button type="submit" class="auth-submit">Criar conta</button>
      </form>

      <div class="auth-form-footer">
        Já tem conta? <a href="{{ route('login') }}">Entrar</a>
      </div>

    </div>
  </div>

</div>

<script src="{{ asset('js/cmoon.js') }}"></script>
</body>
</html>