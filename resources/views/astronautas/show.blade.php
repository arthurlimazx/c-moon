@extends('layouts.app')

@section('title', $astronauta->nome)

@section('content')

{{-- Escapa do container padrão para layout full-width --}}
<div class="cmv2-page">

  {{-- ═══════════════ HERO ═══════════════ --}}
  <section class="cmv2-hero">

    {{-- NAV overlay --}}
    <nav class="cmv2-nav">
      <a href="{{ route('astronautas.index') }}" class="cmv2-nav-logo">C·Moon</a>
      <a href="{{ route('astronautas.index') }}" class="cmv2-nav-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 18l-6-6 6-6"/></svg>
        Voltar
      </a>
    </nav>

    {{-- LEFT: texto --}}
    <div class="cmv2-hero-left">
      <div class="cmv2-overline">
        <div class="cmv2-overline-line"></div>
        <span class="cmv2-overline-text">Astronauta</span>
      </div>

      <h1 class="cmv2-title">
        @php $parts = explode(' ', $astronauta->nome, 2); @endphp
        @if(count($parts) > 1)
          <span class="cmv2-title-sub">{{ $parts[0] }}</span>{{ $parts[1] }}
        @else
          {{ $astronauta->nome }}
        @endif
      </h1>

      <p class="cmv2-subtitle">{{ $astronauta->especialidade }} &nbsp;·&nbsp; {{ $astronauta->nacionalidade }}</p>

      {{-- Métrica destaque --}}
      <div class="cmv2-metric-row">
        <div>
          <span class="cmv2-metric-num">{{ $astronauta->num_missoes }}</span>
          <span class="cmv2-metric-unit"> miss.</span>
        </div>
        <div class="cmv2-metric-info">
          <div style="font-family:'Outfit',sans-serif; font-style:italic; font-size:16px; color:rgba(221,228,245,0.7);">missões realizadas</div>
          <span class="cmv2-metric-lbl">ao longo da carreira</span>
        </div>
      </div>

      {{-- Meta pills --}}
      <div class="cmv2-meta-row">
        <div class="cmv2-meta-block">
          <div class="cmv2-meta-lbl">Especialidade</div>
          <div class="cmv2-meta-val">{{ $astronauta->especialidade }}</div>
        </div>
        <div class="cmv2-meta-block">
          <div class="cmv2-meta-lbl">Missões</div>
          <div class="cmv2-meta-val">{{ $astronauta->num_missoes }}</div>
        </div>
        <div class="cmv2-meta-block">
          <div class="cmv2-meta-lbl">Nac.</div>
          <div class="cmv2-meta-val">{{ $astronauta->nacionalidade }}</div>
        </div>
      </div>

      {{-- Status chip --}}
      <div class="cmv2-chip">
        @if($astronauta->status === 'ativo')
          <div class="cmv2-chip-dot cmv2-chip-dot-green"></div>Ativo
        @elseif($astronauta->status === 'em missão')
          <div class="cmv2-chip-dot cmv2-chip-dot-blue"></div>Em missão
        @else
          <div class="cmv2-chip-dot cmv2-chip-dot-amber"></div>{{ ucfirst($astronauta->status) }}
        @endif
      </div>

      {{-- CTAs --}}
      <div class="cmv2-cta-row">
        @if (Auth::user()->isAdmin())
          <a href="{{ route('astronautas.edit', $astronauta) }}" class="cmv2-btn cmv2-btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Editar
          </a>
        @endif
        <a href="{{ route('astronautas.index') }}" class="cmv2-btn cmv2-btn-outline">← Voltar à lista</a>
      </div>
    </div>

    {{-- RIGHT: foto --}}
    <div class="cmv2-hero-right">
      @if($astronauta->fotos)
        <div class="cmv2-hero-photo" style="background-image: url('{{ Storage::url($astronauta->fotos) }}');"></div>
      @else
        <div class="cmv2-hero-emoji">🧑‍🚀</div>
      @endif
      <div class="cmv2-hero-overlay"></div>
    </div>

  </section>

  {{-- ═══════════════ BODY ═══════════════ --}}
  <div class="cmv2-body">

    {{-- INFORMAÇÕES PESSOAIS --}}
    <div class="cmv2-review-wrap">
      <div class="cmv2-bg-num">01</div>
      <div class="cmv2-inner">
        <div class="cmv2-review-grid">
          <div>
            <div class="cmv2-review-eyebrow">Dados pessoais</div>
            <div class="cmv2-review-col-title">Perfil<br>completo</div>
          </div>
          <div class="cmv2-quote">
            {{ $astronauta->nome }} — {{ $astronauta->especialidade }}. Nacionalidade {{ $astronauta->nacionalidade }}.
            {{ $astronauta->num_missoes }} {{ $astronauta->num_missoes == 1 ? 'missão realizada' : 'missões realizadas' }}
            ao longo da carreira. Status atual: {{ ucfirst($astronauta->status) }}.
          </div>
        </div>
      </div>
    </div>

    {{-- META STRIP --}}
    <div class="cmv2-inner">
      <div class="cmv2-strip">
        <div class="cmv2-strip-item">
          <div class="cmv2-strip-lbl">Nome completo</div>
          <div class="cmv2-strip-val">{{ $astronauta->nome }}</div>
        </div>
        <div class="cmv2-strip-item">
          <div class="cmv2-strip-lbl">Especialidade</div>
          <div class="cmv2-strip-val">{{ $astronauta->especialidade }}</div>
        </div>
        <div class="cmv2-strip-item">
          <div class="cmv2-strip-lbl">Missões</div>
          <div class="cmv2-strip-val">{{ $astronauta->num_missoes }}</div>
        </div>
        <div class="cmv2-strip-item">
          <div class="cmv2-strip-lbl">Status</div>
          <div class="cmv2-strip-val">{{ ucfirst($astronauta->status) }}</div>
        </div>
      </div>
    </div>

    {{-- MISSÕES VINCULADAS --}}
    @if($astronauta->missoes->isNotEmpty())
    <div class="cmv2-tl-section">
      <div class="cmv2-inner">
        <div class="cmv2-tl-layout">
          <div class="cmv2-tl-sec-lbl">Missões<br>vinculadas<br>({{ $astronauta->missoes->count() }})</div>
          <div class="cmv2-tl-list">
            @foreach($astronauta->missoes as $m)
            <div class="cmv2-tl-item">
              <div class="cmv2-tl-dot {{ $m->status === 'concluída' ? 'cmv2-tl-dot-on' : '' }}"></div>
              <div class="cmv2-tl-date">
                {{ \Carbon\Carbon::parse($m->data_lancamento)->format('M Y') }}
              </div>
              <div class="cmv2-tl-text">
                <a href="{{ route('missoes.show', $m) }}" style="color:inherit; transition:color .15s;" onmouseover="this.style.color='#B8C9E8'" onmouseout="this.style.color='inherit'">
                  {{ $m->nome }}
                </a>
                @if($m->corpo)
                  <span style="color:rgba(221,228,245,0.4)"> → {{ $m->corpo->nome }}</span>
                @endif
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
        <form method="POST" action="{{ route('astronautas.destroy', $astronauta) }}">
          @csrf @method('DELETE')
          <button type="submit" class="cmv2-btn cmv2-btn-ghost" style="border:1px solid rgba(224,92,110,0.2); color:rgba(224,92,110,0.7);"
            data-confirm="Excluir {{ $astronauta->nome }}? Esta ação não pode ser desfeita.">
            Excluir astronauta
          </button>
        </form>
      </div>
    </div>
    @endif

  </div>{{-- /cmv2-body --}}
</div>{{-- /cmv2-page --}}

@endsection