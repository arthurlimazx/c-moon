@extends('layouts.app')

@section('title', 'Astronautas')

@section('content')
<div class="page-header animate-up">
  <div class="page-header-text">
    <div class="eyebrow">Equipe de voo</div>
    <h1>Astronautas</h1>
    <p>{{ $astronautas->count() }} {{ $astronautas->count() === 1 ? 'astronauta registrado' : 'astronautas registrados' }}</p>
  </div>
  <a href="{{ route('astronautas.create') }}" class="btn btn-primary">
    + Novo astronauta
  </a>
</div>

@if($astronautas->isEmpty())
  <div class="empty-state">
    <div class="icon">🧑‍🚀</div>
    <h3>Nenhum astronauta cadastrado</h3>
    <p>Comece registrando o primeiro membro da equipe.</p>
  </div>
@else
  <div class="card">
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>Nacionalidade</th>
            <th>Especialidade</th>
            <th>Missões</th>
            <th>Status</th>
            <th style="text-align:right;">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($astronautas as $a)
          <tr>
            <td>
              <a href="{{ route('astronautas.show', $a) }}" style="font-weight:500; transition:color .15s;" 
                 onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='inherit'">
                {{ $a->nome }}
              </a>
            </td>
            <td class="td-muted">{{ $a->nacionalidade }}</td>
            <td class="td-muted">{{ $a->especialidade }}</td>
            <td>{{ $a->num_missoes }}</td>
            <td>
              @if($a->status === 'ativo')
                <span class="badge badge-green">Ativo</span>
              @elseif($a->status === 'inativo')
                <span class="badge badge-amber">Inativo</span>
              @else
                <span class="badge badge-gray">Aposentado</span>
              @endif
            </td>
            <td>
              <div class="td-actions">
                <a href="{{ route('astronautas.show', $a) }}" class="btn btn-ghost btn-sm">Ver</a>
                @if (Auth::user()->isAdmin())
                <a href="{{ route('astronautas.edit', $a) }}" class="btn btn-secondary btn-sm">Editar</a>
                <form method="POST" action="{{ route('astronautas.destroy', $a) }}" style="display:inline;">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"
                    data-confirm="Excluir {{ $a->nome }}? Esta ação não pode ser desfeita.">
                    Excluir
                  </button>
                </form>
                @endif
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
