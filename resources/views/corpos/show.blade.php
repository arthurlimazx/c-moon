@extends('layouts.app')
 
@section('title', $corpo->nome)
 
@section('content')
 
<div class="card animate-up" style="margin-top: 24px; margin-bottom: 32px; background: var(--bg-2);">
  <div class="card-body show-hero-body">
 
    <div class="show-hero-left">
      <div class="show-hero-avatar">
        @if($corpo->fotos)
          <img src="{{ Storage::url($corpo->fotos) }}" alt="{{ $corpo->nome }}">
        @else
          <div class="show-hero-fallback">🌑</div>
        @endif
      </div>
      <div class="show-hero-info">
        <div class="section-label">CORPO CELESTE</div>
        <h1>{{ $corpo->nome }}</h1>
        <p class="show-hero-sub"><span class="text-accent">{{ $corpo->tipo }}</span></p>
      </div>
    </div>
 
    <div class="show-hero-right">
 
      <div class="hero-actions">
        <a href="{{ route('corpos.index') }}" class="btn btn-hero">← Voltar</a>
        <a href="{{ route('corpos.edit', $corpo) }}" class="btn btn-hero">Editar</a>
      </div>
 
      <div class="section-label" style="margin-bottom: 16px;">Dados técnicos</div>
      <div class="form-grid" style="margin-bottom: 28px;">
        <div class="detail-field">
          <div class="label">Nome</div>
          <div class="value">{{ $corpo->nome }}</div>
        </div>
        <div class="detail-field">
          <div class="label">Classificação</div>
          <div class="value">{{ ucfirst($corpo->tipo) }}</div>
        </div>
        <div class="detail-field">
          <div class="label">Distância da Terra</div>
          <div class="value">{{ $corpo->distancia_terra }}</div>
        </div>
        <div class="detail-field">
          <div class="label">Diâmetro</div>
          <div class="value">{{ number_format($corpo->diametro_km, 0, ',', '.') }} km</div>
        </div>
      </div>
 
      @if($corpo->descricao)
      <div class="show-divider"></div>
      <div class="section-label" style="margin-bottom: 12px;">Descrição</div>
      <p class="detail-desc" style="margin-bottom: 28px;">{{ $corpo->descricao }}</p>
      @endif
 
      @if($corpo->missoes->isNotEmpty())
      <div class="show-divider"></div>
      <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
        <div class="section-label">Missões com destino a {{ $corpo->nome }}</div>
        <span class="badge badge-gray">{{ $corpo->missoes->count() }}</span>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Missão</th><th>Lançamento</th><th>Retorno</th><th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($corpo->missoes as $m)
            <tr>
              <td><a href="{{ route('missoes.show', $m) }}" style="font-weight:500; transition:color .15s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='inherit'">{{ $m->nome }}</a></td>
              <td class="td-muted">{{ \Carbon\Carbon::parse($m->data_lancamento)->format('d/m/Y') }}</td>
              <td class="td-muted">{{ \Carbon\Carbon::parse($m->data_retorno)->format('d/m/Y') }}</td>
              <td>
                @if($m->status === 'concluída') <span class="badge badge-green">Concluída</span>
                @elseif($m->status === 'em andamento') <span class="badge badge-blue">Em andamento</span>
                @else <span class="badge badge-amber">Planejada</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
 
      <div style="margin-top:36px; padding-top:24px; border-top:1px solid var(--border);">
        <form method="POST" action="{{ route('corpos.destroy', $corpo) }}">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-danger" data-confirm="Excluir {{ $corpo->nome }}?">Excluir corpo celeste</button>
        </form>
      </div>
 
    </div>
  </div>
</div>
 
@endsection
 