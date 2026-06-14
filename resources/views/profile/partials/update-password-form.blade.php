<div class="form-card">
  <div class="form-card-body">
    <div class="section-label" style="margin-bottom:6px;">Alterar senha</div>
    <p style="font-size:13px; color:var(--text-muted); margin-bottom:24px;">
      Use uma senha longa e aleatória para manter sua conta segura.
    </p>

    <form method="POST" action="{{ route('password.update') }}">
      @csrf @method('PUT')
      <div class="form-grid">

        <div class="form-group form-group-full">
          <label class="form-label" for="update_password_current_password">Senha atual</label>
          <input type="password" id="update_password_current_password" name="current_password"
            class="form-control {{ $errors->updatePassword->has('current_password') ? 'is-invalid' : '' }}"
            autocomplete="current-password">
          @if($errors->updatePassword->has('current_password'))
            <span class="form-error">✕ {{ $errors->updatePassword->first('current_password') }}</span>
          @endif
        </div>

        <div class="form-group">
          <label class="form-label" for="update_password_password">Nova senha</label>
          <input type="password" id="update_password_password" name="password"
            class="form-control {{ $errors->updatePassword->has('password') ? 'is-invalid' : '' }}"
            autocomplete="new-password">
          @if($errors->updatePassword->has('password'))
            <span class="form-error">✕ {{ $errors->updatePassword->first('password') }}</span>
          @endif
        </div>

        <div class="form-group">
          <label class="form-label" for="update_password_password_confirmation">Confirmar nova senha</label>
          <input type="password" id="update_password_password_confirmation" name="password_confirmation"
            class="form-control {{ $errors->updatePassword->has('password_confirmation') ? 'is-invalid' : '' }}"
            autocomplete="new-password">
          @if($errors->updatePassword->has('password_confirmation'))
            <span class="form-error">✕ {{ $errors->updatePassword->first('password_confirmation') }}</span>
          @endif
        </div>

      </div>

      <div style="display:flex; align-items:center; gap:14px; margin-top:8px;">
        <button type="submit" class="btn btn-primary">Atualizar senha</button>
        @if(session('status') === 'password-updated')
          <span style="font-size:13px; color:var(--accent-3); animation: fadeIn .4s ease both;">✓ Senha atualizada</span>
        @endif
      </div>
    </form>
  </div>
</div>