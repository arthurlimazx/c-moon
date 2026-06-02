@extends('layouts.app')

@section('title', 'Missões')

@section('content')
<div class="page-header animate-up">
  <div class="page-header-text">
    <div class="eyebrow">Controle de operações</div>
    <h1>Missões</h1>
    <p>{{ $missoes->count() }} {{ $missoes->count() === 1 ? 'missão registrada' : 'missões registradas' }}</p>
  </div>
  <a href="{{ route('missoes.create') }}" class="btn btn-primary">
    + Nova missão
  </a>
</div>

@if($missoes->isEmpty())
  <div class="empty-state">
    <div class="icon">🚀</div>
    <h3>Nenhuma missão cadastrada</h3>
    <p>Planeje a primeira missão de exploração.</p>
  </div>
@else
  <div class="card">
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Missão</th>
            <th>Destino</th>
            <th>Lançamento</th>
            <th>Retorno</th>
            <th>Status</th>
            <th>Tripulação</th>
            <th style="text-align:right;">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($missoes as $m)
          <tr>
            <td>
              <a href="{{ route('missoes.show', $m) }}" style="font-weight:500; transition:color .15s;"
                 onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='inherit'">
                {{ $m->nome }}
              </a>
            </td>
            <td class="td-muted">{{ $m->corpo->nome ?? '—' }}</td>
            <td class="td-muted">{{ \Carbon\Carbon::parse($m->data_lancamento)->format('d/m/Y') }}</td>
            <td class="td-muted">{{ \Carbon\Carbon::parse($m->data_retorno)->format('d/m/Y') }}</td>
            <td>
              @if($m->status === 'concluída')
                <span class="badge badge-green">Concluída</span>
              @elseif($m->status === 'em andamento')
                <span class="badge badge-blue">Em andamento</span>
              @else
                <span class="badge badge-amber">Planejada</span>
              @endif
            </td>
            <td>{{ $m->astronautas->count() }} 🧑‍🚀</td>
            <td>
              <div class="td-actions">
                <a href="{{ route('missoes.show', $m->id) }}" class="btn btn-ghost btn-sm">Ver</a>
                <a href="{{ route('missoes.edit', $m->id) }}" class="btn btn-secondary btn-sm">Editar</a>
                <form method="POST" action="{{ route('missoes.destroy', $m->id) }}" style="display:inline;">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"
                    data-confirm="Excluir a missão {{ $m->nome }}?">
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
@endif
@endsection
