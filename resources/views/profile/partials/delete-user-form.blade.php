<div class="form-card" style="border-color: rgba(224,92,110,0.2);">
  <div class="form-card-body">
    <div class="section-label" style="margin-bottom:6px; color:var(--danger);">Zona de perigo</div>
    
    <p style="font-size:13px; color:var(--text-muted); margin-bottom:16px;">
      Uma vez que você excluir sua conta, todos os seus recursos e dados serão apagados permanentemente.
    </p>


    

<div class="cmoon-modal-backdrop" id="deleteAccountModal"
     data-open="{{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }}">
  <div class="cmoon-modal">
    <div class="cmoon-modal-header">
      
      <h2 style="font-size:28px; letter-spacing:.06em; color:var(--danger); margin-bottom:8px;">
        Excluir conta?
      </h2>
      <p style="font-size:13px; color:var(--text-muted); line-height:1.7;">
        Todos os seus dados serão apagados permanentemente.<br>
        Digite sua senha para confirmar.
      </p>
    </div>

    <form method="POST" action="{{ route('profile.destroy') }}" style="margin-top:24px;">
      @csrf @method('DELETE')

      <div class="form-group">
        <label class="form-label" for="delete_password">Sua senha</label>
        <input type="password" id="delete_password" name="password"
          class="form-control {{ $errors->userDeletion->has('password') ? 'is-invalid' : '' }}"
          placeholder="••••••••" autocomplete="current-password">
        @if($errors->userDeletion->has('password'))
          <span class="form-error">✕ {{ $errors->userDeletion->first('password') }}</span>
        @endif
      </div>

      <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:24px;">
     
        <button type="button" class="btn btn-ghost"
          onclick="document.getElementById('deleteAccountModal').classList.remove('open')">
          Cancelar
        </button>
        <button type="submit" class="btn btn-danger">Sim, excluir conta</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
(function () {
  const modal = document.getElementById('deleteAccountModal');
  if (!modal) return;

  // Reabre se houver erro de validação (lido via data attribute, sem Blade no JS)
  if (modal.dataset.open === 'true') modal.classList.add('open');

  // Fecha ao clicar no backdrop
  modal.addEventListener('click', function (e) {
    if (e.target === modal) modal.classList.remove('open');
  });

  // Fecha com Escape
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') modal.classList.remove('open');
  });
})();
</script>
@endpush