@extends('layouts.app')

@section('title', 'Editar — ' . $corpo->nome)

@section('content')
<div class="form-page">
  <div class="page-header animate-up">
    <div class="page-header-text">
      <div class="eyebrow">Editando corpo celeste</div>
      <h1>{{ $corpo->nome }}</h1>
      <p>Atualize os dados do objeto espacial.</p>
    </div>
    <a href="{{ route('corpos.show', $corpo) }}" class="btn btn-ghost">← Voltar</a>
  </div>

  <div class="form-card animate-up-delay-1">
    <form method="POST" action="{{ route('corpos.update', $corpo) }}" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="form-card-body">
        <div class="form-grid">

          <div class="form-group form-group-full">
            <label class="form-label">Imagem do corpo celeste <span style="color:var(--text-dim); font-weight:400;">(opcional)</span></label>
            <div class="photo-upload-wrap photo-upload-wide" id="photoWrap">
              <div class="photo-upload-preview" id="photoPreview">
                @if($corpo->fotos)
                  <img src="{{ asset('storage/' . $corpo->fotos) }}" alt="{{ $corpo->nome }}" class="photo-preview-img photo-preview-wide">
                  <div class="photo-current-badge">Imagem atual — selecione outra para substituir</div>
                @else
                  <div class="photo-upload-placeholder">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                      <circle cx="12" cy="12" r="10"/>
                      <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/>
                      <path d="M2 12h20"/>
                    </svg>
                    <span>Clique ou arraste a imagem aqui</span>
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
            <label class="form-label" for="nome">Nome</label>
            <input type="text" id="nome" name="nome"
              class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}"
              value="{{ old('nome', $corpo->nome) }}">
            @error('nome') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="tipo">Tipo</label>
            <select id="tipo" name="tipo"
              class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}">
              @foreach(['planeta','Lua','asteroide','cometa','estrela','nebulosa'] as $tipo)
                <option value="{{ $tipo }}" {{ old('tipo', $corpo->tipo) === $tipo ? 'selected' : '' }}>
                  {{ ucfirst($tipo) }}
                </option>
              @endforeach
            </select>
            @error('tipo') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="distancia_terra">Distância da Terra</label>
            <input type="text" id="distancia_terra" name="distancia_terra"
              class="form-control {{ $errors->has('distancia_terra') ? 'is-invalid' : '' }}"
              value="{{ old('distancia_terra', $corpo->distancia_terra) }}">
            @error('distancia_terra') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="diametro_km">Diâmetro (km)</label>
            <input type="number" id="diametro_km" name="diametro_km" min="0" step="any"
              class="form-control {{ $errors->has('diametro_km') ? 'is-invalid' : '' }}"
              value="{{ old('diametro_km', $corpo->diametro_km) }}">
            @error('diametro_km') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group form-group-full">
            <label class="form-label" for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" rows="4"
              class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}">{{ old('descricao', $corpo->descricao) }}</textarea>
            @error('descricao') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

        </div>
      </div>
      <div class="form-card-footer">
        <a href="{{ route('corpos.show', $corpo) }}" class="btn btn-ghost">Cancelar</a>
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
        <img src="${e.target.result}" alt="Preview" class="photo-preview-img photo-preview-wide">
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
          <circle cx="12" cy="12" r="10"/>
          <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/>
          <path d="M2 12h20"/>
        </svg>
        <span>Clique ou arraste a imagem aqui</span>
        <span style="font-size:12px; color:var(--text-dim);">JPEG, PNG, GIF — máx. 2 MB</span>
      </div>`;
  };
})();
</script>
@endpush
