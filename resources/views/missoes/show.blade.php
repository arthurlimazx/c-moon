@extends('layouts.app')

@section('title', $missao->nome)

@section('content')

<div class="card animate-up" style="margin-top: 24px; margin-bottom: 32px; background: var(--bg-2);">
  <div class="card-body show-hero-body">

    <div class="show-hero-left">
      <div class="show-hero-avatar">
        @if($missao->fotos)
          <img src="{{ Storage::url($missao->fotos) }}" alt="{{ $missao->nome }}">
        @else
          <div class="show-hero-fallback">🚀</div>
        @endif
      </div>
      <div class="show-hero-info">
        <div class="section-label">MISSÃO</div>
        <h1>{{ $missao->nome }}</h1>
        @if($missao->corpo)
          <p class="show-hero-sub"><span class="text-accent">{{ $missao->corpo->nome }}</span></p>
        @endif
      </div>
    </div>

    <div class="show-hero-right">

      <div class="hero-actions">
        <a href="{{ route('missoes.index') }}" class="btn btn-hero">← Voltar</a>
        <a href="{{ route('missoes.edit', $missao) }}" class="btn btn-hero">Editar</a>
      </div>

      <div class="section-label" style="margin-bottom: 16px;">Dados da missão</div>
      <div class="form-grid" style="margin-bottom: 28px;">
        <div class="detail-field">
          <div class="label">Nome da missão</div>
          <div class="value">{{ $missao->nome }}</div>
        </div>
        <div class="detail-field">
          <div class="label">Status</div>
          <div class="value">{{ ucfirst($missao->status) }}</div>
        </div>
        <div class="detail-field">
          <div class="label">Corpo celeste de destino</div>
          <div class="value">
            @if($missao->corpo)
              <a href="{{ route('corpos.show', $missao->corpo) }}" style="transition:color .15s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='inherit'">{{ $missao->corpo->nome }}</a>
            @else —
            @endif
          </div>
        </div>
        <div class="detail-field">
          <div class="label">Duração</div>
          <div class="value" style="font-family:'Bebas Neue',sans-serif; font-size:28px; color:var(--accent);">
            @php $dias = \Carbon\Carbon::parse($missao->data_lancamento)->diffInDays(\Carbon\Carbon::parse($missao->data_retorno)); @endphp
            {{ $dias }}<span style="font-size:14px; color:var(--text-muted); font-weight:400; font-family:'Outfit',sans-serif;"> dias</span>
          </div>
        </div>
        <div class="detail-field">
          <div class="label">Data de lançamento</div>
          <div class="value">{{ \Carbon\Carbon::parse($missao->data_lancamento)->format('d \d\e F \d\e Y') }}</div>
        </div>
        <div class="detail-field">
          <div class="label">Data de retorno</div>
          <div class="value">{{ \Carbon\Carbon::parse($missao->data_retorno)->format('d \d\e F \d\e Y') }}</div>
        </div>
      </div>

      @if($missao->descricao)
      <div class="show-divider"></div>
      <div class="section-label" style="margin-bottom: 12px;">Descrição</div>
      <p class="detail-desc" style="margin-bottom: 28px;">{{ $missao->descricao }}</p>
      @endif

      @if($missao->astronautas->isNotEmpty())
      <div class="show-divider"></div>
      <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
        <div class="section-label">Tripulação</div>
        <span class="badge badge-gray">{{ $missao->astronautas->count() }} membros</span>
      </div>
      <div class="astronaut-list">
        @foreach($missao->astronautas as $a)
        <a href="{{ route('astronautas.show', $a) }}" class="astronaut-pill">
          @if($a->fotos)
            <img src="{{ asset('storage/' . $a->fotos) }}" alt="{{ $a->nome }}" style="width:36px; height:36px; border-radius:50%; object-fit:cover; border:1.5px solid var(--border-active); flex-shrink:0;">
          @else
            <div class="astronaut-avatar">{{ strtoupper(substr($a->nome, 0, 2)) }}</div>
          @endif
          <div>
            <div style="font-size:14px; font-weight:500;">{{ $a->nome }}</div>
            <div style="font-size:12px; color:var(--text-muted);">{{ $a->especialidade }}</div>
          </div>
        </a>
        @endforeach
      </div>
      @endif

      <div style="margin-top:36px; padding-top:24px; border-top:1px solid var(--border);">
        <form method="POST" action="{{ route('missoes.destroy', $missao) }}">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-danger" data-confirm="Excluir a missão {{ $missao->nome }}?">Excluir missão</button>
        </form>
      </div>

    </div>
  </div>
</div>

@endsection