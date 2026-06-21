@extends('layouts.app')

@section('title', $corpo->nome)

@push('scripts')
<script>
  document.querySelectorAll('[data-confirm]').forEach(btn => {
    btn.addEventListener('click', e => {
      if (!confirm(btn.dataset.confirm)) e.preventDefault();
    });
  });
</script>
@endpush

@section('content')

<div class="cmv2-page">

  {{-- ═══════════════ HERO ═══════════════ --}}
  <section class="cmv2-hero">

    <nav class="cmv2-nav">
      <a href="{{ route('corpos.index') }}" class="cmv2-nav-logo">C·Moon</a>
      <a href="{{ route('corpos.index') }}" class="cmv2-nav-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 18l-6-6 6-6"/></svg>
        Voltar
      </a>
    </nav>

    <div class="cmv2-hero-left">
      <div class="cmv2-overline">
        <div class="cmv2-overline-line"></div>
        <span class="cmv2-overline-text">Corpo Celeste</span>
      </div>

      <h1 class="cmv2-title">
        @php $parts = explode(' ', $corpo->nome, 2); @endphp
        @if(count($parts) > 1)
          <span class="cmv2-title-sub">{{ $parts[0] }}</span>{{ $parts[1] }}
        @else
          {{ $corpo->nome }}
        @endif
      </h1>

      <p class="cmv2-subtitle">{{ ucfirst($corpo->tipo) }} &nbsp;·&nbsp; {{ $corpo->distancia_terra }} da Terra</p>

      {{-- Métrica destaque: diâmetro --}}
      <div class="cmv2-metric-row">
        <div>
          <span class="cmv2-metric-num" style="font-size:48px;">{{ number_format($corpo->diametro_km, 0, ',', '.') }}</span>
          <span class="cmv2-metric-unit"> km</span>
        </div>
        <div class="cmv2-metric-info">
          <div style="font-family:'Outfit',sans-serif; font-style:italic; font-size:16px; color:rgba(221,228,245,0.7);">diâmetro equatorial</div>
          <span class="cmv2-metric-lbl">{{ $corpo->missoes->count() }} {{ $corpo->missoes->count() == 1 ? 'missão registrada' : 'missões registradas' }}</span>
        </div>
      </div>

      <div class="cmv2-meta-row">
        <div class="cmv2-meta-block">
          <div class="cmv2-meta-lbl">Tipo</div>
          <div class="cmv2-meta-val">{{ ucfirst($corpo->tipo) }}</div>
        </div>
        <div class="cmv2-meta-block">
          <div class="cmv2-meta-lbl">Distância</div>
          <div class="cmv2-meta-val">{{ $corpo->distancia_terra }}</div>
        </div>
        <div class="cmv2-meta-block">
          <div class="cmv2-meta-lbl">Missões</div>
          <div class="cmv2-meta-val">{{ $corpo->missoes->count() }}</div>
        </div>
      </div>

      <div class="cmv2-chip">
        <div class="cmv2-chip-dot cmv2-chip-dot-blue"></div>
        {{ ucfirst($corpo->tipo) }}
      </div>

      <div class="cmv2-cta-row">
        @if (Auth::user()->isAdmin())
          <a href="{{ route('corpos.edit', $corpo) }}" class="cmv2-btn cmv2-btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Editar
          </a>
        @endif
        <a href="{{ route('corpos.index') }}" class="cmv2-btn cmv2-btn-outline">← Voltar à lista</a>

      </div>
    </div>

    <div class="cmv2-hero-right">
      @if($corpo->fotos)
        <div class="cmv2-hero-photo" style="background-image: url('{{ Storage::url($corpo->fotos) }}');"></div>
      @else
        <div class="cmv2-hero-emoji">🌑</div>
      @endif
      <div class="cmv2-hero-overlay"></div>
    </div>

  </section>

  {{-- ═══════════════ BODY ═══════════════ --}}
  <div class="cmv2-body">

    {{-- DESCRIÇÃO --}}
    @if($corpo->descricao)
    <div class="cmv2-review-wrap">
      <div class="cmv2-bg-num">01</div>
      <div class="cmv2-inner">
        <div class="cmv2-review-grid">
          <div>
            <div class="cmv2-review-eyebrow">Sobre</div>
            <div class="cmv2-review-col-title">Descrição<br>científica</div>
          </div>
          <div class="cmv2-quote">"{{ $corpo->descricao }}"</div>
        </div>
      </div>
    </div>
    @endif

    {{-- META STRIP --}}
    <div class="cmv2-inner">
      <div class="cmv2-strip">
        <div class="cmv2-strip-item">
          <div class="cmv2-strip-lbl">Nome</div>
          <div class="cmv2-strip-val">{{ $corpo->nome }}</div>
        </div>
        <div class="cmv2-strip-item">
          <div class="cmv2-strip-lbl">Classificação</div>
          <div class="cmv2-strip-val">{{ ucfirst($corpo->tipo) }}</div>
        </div>
        <div class="cmv2-strip-item">
          <div class="cmv2-strip-lbl">Diâmetro</div>
          <div class="cmv2-strip-val">{{ number_format($corpo->diametro_km, 0, ',', '.') }} km</div>
        </div>
        <div class="cmv2-strip-item">
          <div class="cmv2-strip-lbl">Distância da Terra</div>
          <div class="cmv2-strip-val">{{ $corpo->distancia_terra }}</div>
        </div>
      </div>
    </div>

    {{-- MISSÕES --}}
    @if($corpo->missoes->isNotEmpty())
    <div class="cmv2-tl-section">
      <div class="cmv2-inner">
        <div class="cmv2-tl-layout">
          <div class="cmv2-tl-sec-lbl">Missões com<br>destino a<br>{{ $corpo->nome }}<br>({{ $corpo->missoes->count() }})</div>
          <div class="cmv2-tl-list">
            @foreach($corpo->missoes as $m)
            <div class="cmv2-tl-item">
              <div class="cmv2-tl-dot {{ $m->status === 'concluída' ? 'cmv2-tl-dot-on' : '' }}"></div>
              <div class="cmv2-tl-date">
                {{ \Carbon\Carbon::parse($m->data_lancamento)->format('M Y') }}
              </div>
              <div class="cmv2-tl-text">
                <a href="{{ route('missoes.show', $m) }}" style="color:inherit; transition:color .15s;" onmouseover="this.style.color='#B8C9E8'" onmouseout="this.style.color='inherit'">
                  {{ $m->nome }}
                </a>
                <span style="color:rgba(221,228,245,0.4)"> → retorno {{ \Carbon\Carbon::parse($m->data_retorno)->format('M Y') }}</span>
                &nbsp;
                @if($m->status === 'concluída')
                  <span class="cmv2-badge cmv2-badge-green">Concluída</span>
                @elseif($m->status === 'em andamento')
                  <span class="cmv2-badge cmv2-badge-blue">Em andamento</span>
                @else
                  <span class="cmv2-badge cmv2-badge-amber">Planejada</span>
                @endif
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @endif

    {{-- DANGER --}}
    @if (Auth::user()->isAdmin())
    <div class="cmv2-inner">
      <div class="cmv2-danger-wrap">
        <span class="cmv2-danger-lbl">Zona de exclusão permanente</span>
        <form method="POST" action="{{ route('corpos.destroy', $corpo) }}">
          @csrf @method('DELETE')
          <button type="submit" class="cmv2-btn cmv2-btn-ghost" style="border:1px solid rgba(224,92,110,0.2); color:rgba(224,92,110,0.7);"
            data-confirm="Excluir {{ $corpo->nome }}?">
            Excluir corpo celeste
          </button>
        </form>
      </div>
    </div>
    @endif

  </div>
</div>

@endsection