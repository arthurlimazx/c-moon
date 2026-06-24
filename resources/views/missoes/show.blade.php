@extends('layouts.app')

@section('title', $missao->nome)

@section('content')

@php
  $dias = \Carbon\Carbon::parse($missao->data_lancamento)->diffInDays(\Carbon\Carbon::parse($missao->data_retorno));
@endphp

<div class="cmv2-page">

  {{-- ═══════════════ HERO ═══════════════ --}}
  <section class="cmv2-hero">

    <nav class="cmv2-nav">
      <a href="{{ route('missoes.index') }}" class="cmv2-nav-logo">C·Moon</a>
      <a href="{{ route('missoes.index') }}" class="cmv2-nav-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 18l-6-6 6-6"/></svg>
        Voltar
      </a>
    </nav>

    <div class="cmv2-hero-left">
      <div class="cmv2-overline">
        <div class="cmv2-overline-line"></div>
        <span class="cmv2-overline-text">Missão</span>
      </div>

      <h1 class="cmv2-title">
        @php $parts = explode(' ', $missao->nome, 2); @endphp
        @if(count($parts) > 1)
          <span class="cmv2-title-sub">{{ $parts[0] }}</span>{{ $parts[1] }}
        @else
          {{ $missao->nome }}
        @endif
      </h1>

      <p class="cmv2-subtitle">
        @if($missao->corpo)→ {{ $missao->corpo->nome }} &nbsp;·&nbsp; @endif
        {{ \Carbon\Carbon::parse($missao->data_lancamento)->format('Y') }}
      </p>

      {{-- Métrica destaque: duração --}}
      <div class="cmv2-metric-row">
        <div>
          <span class="cmv2-metric-num">{{ $dias }}</span>
          <span class="cmv2-metric-unit"> dias</span>
        </div>
        <div class="cmv2-metric-info">
          <div style="font-family:'Outfit',sans-serif; font-style:italic; font-size:16px; color:rgba(221,228,245,0.7);">duração total</div>
          <span class="cmv2-metric-lbl">{{ $missao->astronautas->count() }} {{ $missao->astronautas->count() == 1 ? 'membro na tripulação' : 'membros na tripulação' }}</span>
        </div>
      </div>

      <div class="cmv2-meta-row">
        <div class="cmv2-meta-block">
          <div class="cmv2-meta-lbl">Lançamento</div>
          <div class="cmv2-meta-val">{{ \Carbon\Carbon::parse($missao->data_lancamento)->format('d/m/Y') }}</div>
        </div>
        <div class="cmv2-meta-block">
          <div class="cmv2-meta-lbl">Retorno</div>
          <div class="cmv2-meta-val">{{ \Carbon\Carbon::parse($missao->data_retorno)->format('d/m/Y') }}</div>
        </div>
        <div class="cmv2-meta-block">
          <div class="cmv2-meta-lbl">Tripulação</div>
          <div class="cmv2-meta-val">{{ $missao->astronautas->count() }}</div>
        </div>
      </div>

      <div class="cmv2-chip">
        @if($missao->status === 'concluída')
          <div class="cmv2-chip-dot cmv2-chip-dot-green"></div>Concluída
        @elseif($missao->status === 'em andamento')
          <div class="cmv2-chip-dot cmv2-chip-dot-blue"></div>Em andamento
        @else
          <div class="cmv2-chip-dot cmv2-chip-dot-amber"></div>Planejada
        @endif
      </div>

      <div class="cmv2-cta-row">
        @if (Auth::user()->isAdmin())
          <a href="{{ route('missoes.edit', $missao) }}" class="cmv2-btn cmv2-btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Editar
          </a>
        @endif
        <a href="{{ route('missoes.index') }}" class="cmv2-btn cmv2-btn-outline">← Voltar à lista</a>
      </div>
    </div>

    <div class="cmv2-hero-right">
      @if($missao->fotos)
        <div class="cmv2-hero-photo" style="background-image: url('{{ Storage::url($missao->fotos) }}');"></div>
      @else
        <div class="cmv2-hero-emoji">🚀</div>
      @endif
      <div class="cmv2-hero-overlay"></div>
    </div>

  </section>

  {{-- ═══════════════ BODY ═══════════════ --}}
  <div class="cmv2-body">

    {{-- DESCRIÇÃO --}}
    @if($missao->descricao)
    <div class="cmv2-review-wrap">
      <div class="cmv2-bg-num">01</div>
      <div class="cmv2-inner">
        <div class="cmv2-review-grid">
          <div>
            <div class="cmv2-review-eyebrow">Sobre a missão</div>
            <div class="cmv2-review-col-title">Resumo<br>operacional</div>
          </div>
          <div class="cmv2-quote">{{ $missao->descricao }}</div>
        </div>
      </div>
    </div>
    @endif

    {{-- META STRIP --}}
    <div class="cmv2-inner">
      <div class="cmv2-strip">
        <div class="cmv2-strip-item">
          <div class="cmv2-strip-lbl">Destino</div>
          <div class="cmv2-strip-val">
            @if($missao->corpo)
              <a href="{{ route('corpos.show', $missao->corpo) }}" style="color:#B8C9E8; text-decoration:none;">{{ $missao->corpo->nome }}</a>
            @else —
            @endif
          </div>
        </div>
        <div class="cmv2-strip-item">
          <div class="cmv2-strip-lbl">Lançamento</div>
          <div class="cmv2-strip-val">{{ \Carbon\Carbon::parse($missao->data_lancamento)->format('d M Y') }}</div>
        </div>
        <div class="cmv2-strip-item">
          <div class="cmv2-strip-lbl">Retorno</div>
          <div class="cmv2-strip-val">{{ \Carbon\Carbon::parse($missao->data_retorno)->format('d M Y') }}</div>
        </div>
        <div class="cmv2-strip-item">
          <div class="cmv2-strip-lbl">Status</div>
          <div class="cmv2-strip-val">{{ ucfirst($missao->status) }}</div>
        </div>
      </div>
    </div>

    {{-- TRIPULAÇÃO --}}
    @if($missao->astronautas->isNotEmpty())
    <div class="cmv2-tl-section">
      <div class="cmv2-inner">
        <div class="cmv2-tl-layout">
          <div class="cmv2-tl-sec-lbl">Tripulação<br>({{ $missao->astronautas->count() }} membros)</div>
          <div>
            <div class="cmv2-sim-grid" style="margin-bottom: 0;">
              @foreach($missao->astronautas as $a)
              <a href="{{ route('astronautas.show', $a) }}" class="cmv2-sim-card">
                @if($a->fotos)
                  <div style="width:40px; height:40px; border-radius:50%; background: url('{{ asset('storage/' . $a->fotos) }}') center/cover no-repeat; border: 1px solid rgba(120,145,210,0.2); margin-bottom:6px; flex-shrink:0;"></div>
                @else
                  <div style="width:40px; height:40px; border-radius:50%; background: #111828; border: 1px solid rgba(120,145,210,0.2); display:flex; align-items:center; justify-content:center; font-family:'Outfit',sans-serif; font-size:13px; font-weight:700; color:#B8C9E8; margin-bottom:6px; flex-shrink:0;">
                    {{ strtoupper(substr($a->nome, 0, 2)) }}
                  </div>
                @endif
                <span class="cmv2-sim-type">Astronauta</span>
                <span class="cmv2-sim-title">{{ $a->nome }}</span>
                <span class="cmv2-sim-status">{{ $a->especialidade }}</span>
              </a>
              @endforeach
            </div>
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
        <form method="POST" action="{{ route('missoes.destroy', $missao) }}">
          @csrf @method('DELETE')
          <button type="submit" class="cmv2-btn cmv2-btn-ghost" style="border:1px solid rgba(224,92,110,0.2); color:rgba(224,92,110,0.7);"
            data-confirm="Excluir a missão {{ $missao->nome }}?">
            Excluir missão
          </button>
        </form>
      </div>
    </div>
    @endif

  </div>
</div>

@endsection