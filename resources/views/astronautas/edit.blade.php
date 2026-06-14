@extends('layouts.app')

@section('title', 'Editar — ' . $astronauta->nome)

@section('content')
<div class="form-page">
  <div class="page-header animate-up">
    <div class="page-header-text">
      <div class="eyebrow">Editando astronauta</div>
      <h1>{{ $astronauta->nome }}</h1>
      <p>Atualize os dados do astronauta abaixo.</p>
    </div>
    <a href="{{ route('astronautas.show', $astronauta) }}" class="btn btn-ghost">← Voltar</a>
  </div>

  <div class="form-card animate-up-delay-1">
    <form method="POST" action="{{ route('astronautas.update', $astronauta) }}" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="form-card-body">
        <div class="form-grid">

          {{-- FOTO UPLOAD --}}
          <div class="form-group form-group-full">
            <label class="form-label">Foto do astronauta <span style="color:var(--text-dim); font-weight:400;">(opcional)</span></label>
            <div class="photo-upload-wrap" id="photoWrap">
              <div class="photo-upload-preview" id="photoPreview">
                @if($astronauta->fotos)
                  <img src="{{ asset('storage/' . $astronauta->fotos) }}" alt="{{ $astronauta->nome }}" class="photo-preview-img">
                  <div class="photo-current-badge">Foto atual — selecione outra para substituir</div>
                @else
                  <div class="photo-upload-placeholder">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                      <circle cx="12" cy="7" r="4"/>
                    </svg>
                    <span>Clique ou arraste a foto aqui</span>
                    <span style="font-size:12px; color:var(--text-dim);">JPEG, PNG, GIF — máx. 2 MB</span>
                  </div>
                @endif
              </div>
              <input type="file" id="fotos" name="fotos" accept="image/jpeg,image/png,image/jpg,image/gif"
                class="photo-upload-input {{ $errors->has('fotos') ? 'is-invalid' : '' }}">
            </div>
            @error('fotos') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="nome">Nome completo</label>
            <input type="text" id="nome" name="nome"
              class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}"
              value="{{ old('nome', $astronauta->nome) }}">
            @error('nome') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="nacionalidade">Nacionalidade</label>
            <input type="text" id="nacionalidade" name="nacionalidade"
              class="form-control {{ $errors->has('nacionalidade') ? 'is-invalid' : '' }}"
              value="{{ old('nacionalidade', $astronauta->nacionalidade) }}">
            @error('nacionalidade') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="especialidade">Especialidade</label>
            <input type="text" id="especialidade" name="especialidade"
              class="form-control {{ $errors->has('especialidade') ? 'is-invalid' : '' }}"
              value="{{ old('especialidade', $astronauta->especialidade) }}">
            @error('especialidade') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="num_missoes">Número de missões</label>
            <input type="number" id="num_missoes" name="num_missoes" min="0"
              class="form-control {{ $errors->has('num_missoes') ? 'is-invalid' : '' }}"
              value="{{ old('num_missoes', $astronauta->num_missoes) }}">
            @error('num_missoes') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="status">Status</label>
            <select id="status" name="status"
              class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
              <option value="ativo"      {{ old('status', $astronauta->status) === 'ativo'      ? 'selected' : '' }}>Ativo</option>
              <option value="inativo"    {{ old('status', $astronauta->status) === 'inativo'    ? 'selected' : '' }}>Inativo</option>
              <option value="aposentado" {{ old('status', $astronauta->status) === 'aposentado' ? 'selected' : '' }}>Aposentado</option>
            </select>
            @error('status') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          @if($missoes->isNotEmpty())
          <div class="form-group form-group-full">
            <label class="form-label">Missões vinculadas</label>
            <div class="multi-select-wrap">
              @foreach($missoes as $m)
              <label class="multi-select-item">
                <input type="checkbox" name="missoes[]" value="{{ $m->id }}"
                  {{ $astronauta->missoes->contains($m->id) ? 'checked' : '' }}
                  {{ is_array(old('missoes')) && in_array($m->id, old('missoes')) ? 'checked' : '' }}>
                <span>{{ $m->nome }}</span>
                <span style="margin-left:auto; font-size:12px; color:var(--text-dim);">
                  {{ $m->corpo->nome ?? '—' }}
                </span>
              </label>
              @endforeach
            </div>
          </div>
          @endif

        </div>
      </div>
      <div class="form-card-footer">
        <a href="{{ route('astronautas.show', $astronauta) }}" class="btn btn-ghost">Cancelar</a>
        <button type="submit" class="btn btn-primary">Salvar alterações</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
  const input = document.getElementById('fotos');
  const preview = document.getElementById('photoPreview');
  if (!input || !preview) return;

  function showPreview(file) {
    const reader = new FileReader();
    reader.onload = e => {
      preview.innerHTML = `
        <img src="${e.target.result}" alt="Preview" class="photo-preview-img">
        <button type="button" class="photo-remove-btn" onclick="clearPhoto()">✕ Remover</button>
      `;
    };
    reader.readAsDataURL(file);
  }

  input.addEventListener('change', () => {
    if (input.files[0]) showPreview(input.files[0]);
  });

  const wrap = document.getElementById('photoWrap');
  wrap.addEventListener('dragover', e => { e.preventDefault(); wrap.classList.add('drag-over'); });
  wrap.addEventListener('dragleave', () => wrap.classList.remove('drag-over'));
  wrap.addEventListener('drop', e => {
    e.preventDefault();
    wrap.classList.remove('drag-over');
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
      const dt = new DataTransfer();
      dt.items.add(file);
      input.files = dt.files;
      showPreview(file);
    }
  });

  window.clearPhoto = function () {
    input.value = '';
    preview.innerHTML = `
      <div class="photo-upload-placeholder">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
          <circle cx="12" cy="7" r="4"/>
        </svg>
        <span>Clique ou arraste a foto aqui</span>
        <span style="font-size:12px; color:var(--text-dim);">JPEG, PNG, GIF — máx. 2 MB</span>
      </div>`;
  };
})();
</script>
@endpush
