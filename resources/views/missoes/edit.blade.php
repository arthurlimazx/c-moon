@extends('layouts.app')

@section('title', 'Editar — ' . $missao->nome)

@section('content')
<div class="form-page">
  <div class="page-header animate-up">
    <div class="page-header-text">
      <div class="eyebrow">Editando missão</div>
      <h1>{{ $missao->nome }}</h1>
      <p>Atualize os dados da missão.</p>
    </div>
    <a href="{{ route('missoes.show', $missao) }}" class="btn btn-ghost">← Voltar</a>
  </div>

  <div class="form-card animate-up-delay-1">
    <form method="POST" action="{{ route('missoes.update', $missao) }}" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="form-card-body">
        <div class="form-grid">

          <div class="form-group form-group-full">
            <label class="form-label" for="nome">Nome da missão</label>
            <input type="text" id="nome" name="nome"
              class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}"
              value="{{ old('nome', $missao->nome) }}">
            @error('nome') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="corpo_celeste_id">Corpo celeste de destino</label>
            <select id="corpo_celeste_id" name="corpo_celeste_id"
              class="form-control {{ $errors->has('corpo_celeste_id') ? 'is-invalid' : '' }}">
              <option value="">Selecionar destino</option>
              @foreach($corpos as $c)
                <option value="{{ $c->id }}"
                  {{ old('corpo_celeste_id', $missao->corpo_celeste_id) == $c->id ? 'selected' : '' }}>
                  {{ $c->nome }} — {{ ucfirst($c->tipo) }}
                </option>
              @endforeach
            </select>
            @error('corpo_celeste_id') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="status">Status</label>
            <select id="status" name="status"
              class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
              <option value="planejada"    {{ old('status', $missao->status) === 'planejada'    ? 'selected' : '' }}>Planejada</option>
              <option value="em andamento" {{ old('status', $missao->status) === 'em andamento' ? 'selected' : '' }}>Em andamento</option>
              <option value="concluída"    {{ old('status', $missao->status) === 'concluída'    ? 'selected' : '' }}>Concluída</option>
            </select>
            @error('status') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="data_lancamento">Data de lançamento</label>
            <input type="date" id="data_lancamento" name="data_lancamento"
              class="form-control {{ $errors->has('data_lancamento') ? 'is-invalid' : '' }}"
              value="{{ old('data_lancamento', \Carbon\Carbon::parse($missao->data_lancamento)->format('Y-m-d')) }}">
            @error('data_lancamento') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="data_retorno">Data de retorno</label>
            <input type="date" id="data_retorno" name="data_retorno"
              class="form-control {{ $errors->has('data_retorno') ? 'is-invalid' : '' }}"
              value="{{ old('data_retorno', \Carbon\Carbon::parse($missao->data_retorno)->format('Y-m-d')) }}">
            @error('data_retorno') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          <div class="form-group form-group-full">
            <label class="form-label" for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" rows="3"
              class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}">{{ old('descricao', $missao->descricao) }}</textarea>
            @error('descricao') <span class="form-error">✕ {{ $message }}</span> @enderror
          </div>

          {{-- FOTO UPLOAD --}}
          <div class="form-group form-group-full">
            <label class="form-label">Imagem da missão <span style="color:var(--text-dim); font-weight:400;">(opcional)</span></label>
            <div class="photo-upload-wrap photo-upload-wide" id="photoWrap">
              <div class="photo-upload-preview" id="photoPreview">
                @if($missao->fotos)
                  <img src="{{ asset('storage/' . $missao->fotos) }}" alt="{{ $missao->nome }}" class="photo-preview-img photo-preview-wide">
                  <div class="photo-current-badge">Imagem atual — selecione outra para substituir</div>
                @else
                  <div class="photo-upload-placeholder">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                      <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                      <path d="M2 17l10 5 10-5"/>
                      <path d="M2 12l10 5 10-5"/>
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

          @if($astronautas->isNotEmpty())
          <div class="form-group form-group-full">
            <label class="form-label">Tripulação</label>
            <div class="multi-select-wrap">
              @foreach($astronautas as $a)
              <label class="multi-select-item">
                <input type="checkbox" name="astronautas[]" value="{{ $a->id }}"
                  {{ $missao->astronautas->contains($a->id) ? 'checked' : '' }}
                  {{ is_array(old('astronautas')) && in_array($a->id, old('astronautas')) ? 'checked' : '' }}>
                <span style="font-weight:500;">{{ $a->nome }}</span>
                <span style="color:var(--text-dim); font-size:13px;">{{ $a->especialidade }}</span>
                <span style="margin-left:auto;">
                  @if($a->status === 'ativo')
                    <span class="badge badge-green" style="font-size:11px;">Ativo</span>
                  @else
                    <span class="badge badge-gray" style="font-size:11px;">{{ ucfirst($a->status) }}</span>
                  @endif
                </span>
              </label>
              @endforeach
            </div>
          </div>
          @endif

        </div>
      </div>
      <div class="form-card-footer">
        <a href="{{ route('missoes.show', $missao) }}" class="btn btn-ghost">Cancelar</a>
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
          <path d="M12 2L2 7l10 5 10-5-10-5z"/>
          <path d="M2 17l10 5 10-5"/>
          <path d="M2 12l10 5 10-5"/>
        </svg>
        <span>Clique ou arraste a imagem aqui</span>
        <span style="font-size:12px; color:var(--text-dim);">JPEG, PNG, GIF — máx. 2 MB</span>
      </div>`;
  };
})();
</script>
@endpush
