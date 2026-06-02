<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Senha — C-Moon</title>
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
        Cada falha é um passo<br>
        em direção ao <em>próximo lançamento.</em>
      </blockquote>
      <cite>— Equipe C-Moon</cite>
    </div>
  </div>
 
  <div class="auth-form-side">
    <div class="auth-form-wrap animate-up">
 
      <div class="auth-form-header">
        <div class="auth-form-eyebrow">Recuperação de acesso</div>
        <h1>Esqueceu a senha?</h1>
        <p>Sem problema. Informe seu e-mail e enviaremos um link para redefinir sua senha.</p>
      </div>
 
      @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
      @endif
 
      <form method="POST" action="{{ route('password.email') }}">
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
 
        <button type="submit" class="auth-submit">Enviar link de recuperação</button>
      </form>
 
      <div class="auth-form-footer">
        Lembrou a senha? <a href="{{ route('login') }}">Voltar ao login</a>
      </div>
 
    </div>
  </div>
 
</div>
 
<script src="{{ asset('js/cmoon.js') }}"></script>
</body>
</html>