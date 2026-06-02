@extends('layouts.app')

@section('title', $astronauta->nome)

@section('content')

<div class="card animate-up" style="margin-top: 24px; margin-bottom: 32px; background: var(--bg-2);">
  <div class="card-body show-hero-body">

    <div class="show-hero-left">
      <div class="show-hero-avatar">
        @if($astronauta->fotos)
          <img src="{{ Storage::url($astronauta->fotos) }}" alt="{{ $astronauta->nome }}">
        @else
          <div class="show-hero-fallback">🧑‍🚀</div>
        @endif
      </div>
      <div class="show-hero-info">
        <div class="section-label">ASTRONAUTA</div>
        <h1>{{ $astronauta->nome }}</h1>
        <p class="show-hero-sub"><span class="text-accent">{{ $astronauta->nacionalidade }}</span></p>
      </div>
    </div>

    <div class="show-hero-right">
     
      <div class="hero-actions">
        <a href="{{ route('astronautas.index') }}" class="btn btn-hero">← Voltar</a>
        @if (Auth::user()->isAdmin())
        <a href="{{ route('astronautas.edit', $astronauta) }}" class="btn btn-hero">Editar</a>
         @endif
        </div>
       
      <div class="section-label" style="margin-bottom: 16px;">Informações pessoais</div>
      <div class="form-grid" style="margin-bottom: 28px;">
        <div class="detail-field">
          <div class="label">Nome completo</div>
          <div class="value">{{ $astronauta->nome }}</div>
        </div>
        <div class="detail-field">
          <div class="label">Nacionalidade</div>
          <div class="value">{{ $astronauta->nacionalidade }}</div>
        </div>
        <div class="detail-field">
          <div class="label">Especialidade</div>
          <div class="value">{{ $astronauta->especialidade }}</div>
        </div>
        <div class="detail-field">
          <div class="label">Status</div>
          <div class="value">{{ ucfirst($astronauta->status) }}</div>
        </div>
        <div class="detail-field">
          <div class="label">Missões realizadas</div>
          <div class="value" style="font-family:'Bebas Neue',sans-serif; font-size:28px; color:var(--accent);">{{ $astronauta->num_missoes }}</div>
        </div>
      </div>

      @if($astronauta->missoes->isNotEmpty())
      <div class="show-divider"></div>
      <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
        <div class="section-label">Missões vinculadas</div>
        <span class="badge badge-gray">{{ $astronauta->missoes->count() }}</span>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Nome</th><th>Destino</th><th>Lançamento</th><th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($astronauta->missoes as $m)
            <tr>
              <td><a href="{{ route('missoes.show', $m) }}" style="font-weight:500; transition:color .15s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='inherit'">{{ $m->nome }}</a></td>
              <td class="td-muted">{{ $m->corpo->nome ?? '—' }}</td>
              <td class="td-muted">{{ \Carbon\Carbon::parse($m->data_lancamento)->format('d/m/Y') }}</td>
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
        @if (Auth::user()->isAdmin())
        <form method="POST" action="{{ route('astronautas.destroy', $astronauta) }}">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-danger" data-confirm="Excluir {{ $astronauta->nome }}? Esta ação não pode ser desfeita.">Excluir astronauta</button>
        </form>
        @endif
      </div>

    </div>
  </div>
</div>

@endsection