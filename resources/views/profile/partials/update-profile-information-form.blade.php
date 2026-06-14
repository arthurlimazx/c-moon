<div class="form-card">
  <div class="form-card-body">
    <div class="section-label" style="margin-bottom:6px;">Informações pessoais</div>
    <p style="font-size:13px; color:var(--text-muted); margin-bottom:24px;">
      Atualize seu nome e endereço de e-mail.
    </p>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">@csrf</form>

    <form method="POST" action="{{ route('profile.update') }}">
      @csrf @method('PATCH')
      <div class="form-grid">

        <div class="form-group">
          <label class="form-label" for="name">Nome</label>
          <input type="text" id="name" name="name"
            class="form-control {{ $errors->userDefined->has('name') ? 'is-invalid' : '' }}"
            value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
          @if($errors->userDefined->has('name'))
            <span class="form-error">✕ {{ $errors->userDefined->first('name') }}</span>
          @endif
        </div>

        <div class="form-group">
          <label class="form-label" for="email">E-mail</label>
          <input type="email" id="email" name="email"
            class="form-control {{ $errors->userDefined->has('email') ? 'is-invalid' : '' }}"
            value="{{ old('email', $user->email) }}" required autocomplete="username">
          @if($errors->userDefined->has('email'))
            <span class="form-error">✕ {{ $errors->userDefined->first('email') }}</span>
          @endif

          @if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="alert alert-danger" style="margin-top:10px;">
              ✕ Seu e-mail não foi verificado.
              <button form="send-verification" style="background:none;border:none;color:var(--accent);cursor:pointer;font-size:inherit;padding:0;margin-left:4px;">
                Reenviar verificação →
              </button>
            </div>
            @if(session('status') === 'verification-link-sent')
              <div class="alert alert-success" style="margin-top:6px;">
                ✓ Link enviado para o seu e-mail.
              </div>
            @endif
          @endif
        </div>

      </div>

      <div style="display:flex; align-items:center; gap:14px; margin-top:8px;">
        <button type="submit" class="btn btn-primary">Salvar alterações</button>
        @if(session('status') === 'profile-updated')
          <span style="font-size:13px; color:var(--accent-3); animation: fadeIn .4s ease both;">✓ Salvo com sucesso</span>
        @endif
      </div>
    </form>
  </div>
</div>