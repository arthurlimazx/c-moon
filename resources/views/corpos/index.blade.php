@extends('layouts.app')

@section('title', 'Corpos Celestes')

@section('content')
<div class="page-header animate-up">
  <div class="page-header-text">
    <div class="eyebrow">Cartografia espacial</div>
    <h1>Corpos Celestes</h1>
    <p>{{ $corpos->count() }} {{ $corpos->count() === 1 ? 'corpo cadastrado' : 'corpos cadastrados' }}</p>
  </div>
  @if (Auth::user()->isAdmin())
  <a href="{{ route('corpos.create') }}" class="btn btn-primary">
    + Novo corpo celeste
  </a>
  @endif
</div>

@if($corpos->isEmpty())
  <div class="empty-state">
    <div class="icon">🪐</div>
    <h3>Nenhum corpo celeste cadastrado</h3>
    <p>Adicione planetas, luas, asteroides e outros objetos ao mapa.</p>
  </div>

@elseif(Auth::user()->isAdmin())
  <div class="card">
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Distância da Terra</th>
            <th>Diâmetro (km)</th>
            <th>Missões</th>
            <th style="text-align:right;">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($corpos as $c)
          <tr>
            <td>
              <a href="{{ route('corpos.show', $c) }}" style="font-weight:500; transition:color .15s;"
                 onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='inherit'">
                {{ $c->nome }}
              </a>
            </td>
            <td>
              @php
                $tipoBadge = [
                  'planeta'   => 'badge-blue',
                  'lua'       => 'badge-gray',
                  'asteroide' => 'badge-amber',
                  'cometa'    => 'badge-blue',
                  'estrela'   => 'badge-amber',
                  'nebulosa'  => 'badge-green',
                ][strtolower($c->tipo)] ?? 'badge-gray';
              @endphp
              <span class="badge {{ $tipoBadge }}">{{ ucfirst($c->tipo) }}</span>
            </td>
            <td class="td-muted">{{ $c->distancia_terra }}</td>
            <td class="td-muted">{{ number_format($c->diametro_km, 0, ',', '.') }}</td>
            <td>{{ $c->missoes->count() }}</td>
            <td>
              <div class="td-actions">
                <a href="{{ route('corpos.show', $c) }}" class="btn btn-ghost btn-sm">Ver</a>
                <a href="{{ route('corpos.edit', $c) }}" class="btn btn-secondary btn-sm">Editar</a>
                <form method="POST" action="{{ route('corpos.destroy', $c) }}" style="display:inline;">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"
                    data-confirm="Excluir {{ $c->nome }}?">
                    Excluir
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@else
  <div class="cards-grid">
    @foreach($corpos as $c)
    <div class="card card-astronauta">
      @if($c->fotos)
        <img src="{{ asset('storage/' . $c->fotos) }}" alt="{{ $c->nome }}">
      @else
        <div class="card-astronauta-avatar">🪐</div>
      @endif
      <div class="card-body">
        <h3>{{ $c->nome }}</h3>
       
       
        <p class="td-muted">{{ $c->distancia_terra }} km</p>
        <a href="{{ route('corpos.show', $c) }}" class="btn btn-ghost btn-sm" style="margin-top:4px;">Ver</a>
      </div>
    </div>
    @endforeach
  </div>
@endif

@endsection