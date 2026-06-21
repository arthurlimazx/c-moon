@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="page-header animate-up">
  <div class="page-header-text">
    <div class="eyebrow">Painel administrativo</div>
    <h1>Olá, {{ explode(' ', $admin->name)[0] }}</h1>
    <p>Aqui está a visão geral da operação C-Moon hoje, {{ \Carbon\Carbon::now()->locale('pt_BR')->isoFormat('D [de] MMMM [de] YYYY') }}.</p>
  </div>
  <div style="display:flex; gap:10px; flex-wrap:wrap;">
    <a href="{{ route('astronautas.create') }}" class="btn btn-secondary btn-sm">+ Astronauta</a>
    <a href="{{ route('corpos.create') }}" class="btn btn-secondary btn-sm">+ Corpo celeste</a>
    <a href="{{ route('missoes.create') }}" class="btn btn-primary btn-sm">+ Missão</a>
  </div>
</div>

{{-- ── STATS GERAIS ── --}}
<div class="stats-strip" style="grid-template-columns: repeat(4, 1fr);">
  <div class="stat-card">
    <span class="stat-label">Astronautas registrados</span>
    <span class="stat-value">{{ $totalAstronautas }}</span>
    <span class="stat-sub">{{ $astronautasPorStatus->get('ativo', 0) }} em atividade</span>
  </div>
  <div class="stat-card">
    <span class="stat-label">Corpos celestes</span>
    <span class="stat-value">{{ $totalCorpos }}</span>
    <span class="stat-sub">{{ $corposPorTipo->count() }} tipos catalogados</span>
  </div>
  <div class="stat-card">
    <span class="stat-label">Missões cadastradas</span>
    <span class="stat-value">{{ $totalMissoes }}</span>
    <span class="stat-sub">{{ $missoesPorStatus->get('em andamento', 0) }} em andamento</span>
  </div>
  <div class="stat-card">
    <span class="stat-label">Usuários da plataforma</span>
    <span class="stat-value">{{ $totalUsuarios }}</span>
    <span class="stat-sub">Contas registradas</span>
  </div>
</div>

{{-- ── STATUS DAS MISSÕES E ASTRONAUTAS ── --}}
<div class="dash-section-label">Status operacional</div>

<div style="display:grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 16px;">

  <div class="dash-card">
    <h3 style="font-size:13px; text-transform:uppercase; letter-spacing:.1em; color:var(--text-muted); margin-bottom:20px;">Missões por status</h3>
    @php
      $statusMissaoLabels = [
        'planejada'     => ['Planejada', 'badge-amber'],
        'em andamento'  => ['Em andamento', 'badge-blue'],
        'concluida'     => ['Concluída', 'badge-green'],
        'concluída'     => ['Concluída', 'badge-green'],
        'cancelada'     => ['Cancelada', 'badge-red'],
      ];
    @endphp
    @if($missoesPorStatus->isEmpty())
      <p class="td-muted" style="font-size:14px;">Nenhuma missão cadastrada ainda.</p>
    @else
      <div style="display:flex; flex-direction:column; gap:14px;">
        @foreach($missoesPorStatus as $status => $total)
          @php [$label, $class] = $statusMissaoLabels[$status] ?? [ucfirst($status), 'badge-gray']; @endphp
          <div style="display:flex; align-items:center; justify-content:space-between;">
            <span class="badge {{ $class }}">{{ $label }}</span>
            <span style="font-family:'Bebas Neue',sans-serif; font-size:22px; color:var(--text);">{{ $total }}</span>
          </div>
        @endforeach
      </div>
    @endif
  </div>

  <div class="dash-card">
    <h3 style="font-size:13px; text-transform:uppercase; letter-spacing:.1em; color:var(--text-muted); margin-bottom:20px;">Astronautas por status</h3>
    @php
      $statusAstroLabels = [
        'ativo'      => ['Ativo', 'badge-green'],
        'inativo'    => ['Inativo', 'badge-amber'],
        'aposentado' => ['Aposentado', 'badge-gray'],
      ];
    @endphp
    @if($astronautasPorStatus->isEmpty())
      <p class="td-muted" style="font-size:14px;">Nenhum astronauta cadastrado ainda.</p>
    @else
      <div style="display:flex; flex-direction:column; gap:14px;">
        @foreach($astronautasPorStatus as $status => $total)
          @php [$label, $class] = $statusAstroLabels[$status] ?? [ucfirst($status), 'badge-gray']; @endphp
          <div style="display:flex; align-items:center; justify-content:space-between;">
            <span class="badge {{ $class }}">{{ $label }}</span>
            <span style="font-family:'Bebas Neue',sans-serif; font-size:22px; color:var(--text);">{{ $total }}</span>
          </div>
        @endforeach
      </div>
    @endif
  </div>

</div>

{{-- ── MISSÕES RECENTES ── --}}
<div class="dash-section-label">Missões recentes</div>

@if($missoesRecentes->isEmpty())
  <div class="empty-state">
    <div class="icon">🚀</div>
    <h3>Nenhuma missão cadastrada</h3>
    <p>Planeje a primeira missão de exploração.</p>
  </div>
@else
  <div class="card" style="margin-bottom: 16px;">
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Missão</th>
            <th>Destino</th>
            <th>Lançamento</th>
            <th>Status</th>
            <th>Tripulação</th>
            <th style="text-align:right;">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($missoesRecentes as $m)
          <tr>
            <td>
              <a href="{{ route('missoes.show', $m) }}" style="font-weight:500;">{{ $m->nome }}</a>
            </td>
            <td class="td-muted">{{ $m->corpo->nome ?? '—' }}</td>
            <td class="td-muted">{{ \Carbon\Carbon::parse($m->data_lancamento)->format('d/m/Y') }}</td>
            <td>
              @php [$label, $class] = $statusMissaoLabels[$m->status] ?? [ucfirst($m->status), 'badge-gray']; @endphp
              <span class="badge {{ $class }}">{{ $label }}</span>
            </td>
            <td>{{ $m->astronautas->count() }} 🧑‍🚀</td>
            <td>
              <div class="td-actions">
                <a href="{{ route('missoes.show', $m) }}" class="btn btn-ghost btn-sm">Ver</a>
                <a href="{{ route('missoes.edit', $m) }}" class="btn btn-secondary btn-sm">Editar</a>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endif

{{-- ── ASTRONAUTAS E USUÁRIOS RECENTES ── --}}
<div class="dash-section-label">Atividade recente</div>

<div style="display:grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 40px;">

  <div class="dash-card">
    <h3 style="font-size:13px; text-transform:uppercase; letter-spacing:.1em; color:var(--text-muted); margin-bottom:20px;">Últimos astronautas</h3>
    @if($astronautasRecentes->isEmpty())
      <p class="td-muted" style="font-size:14px;">Nenhum astronauta cadastrado ainda.</p>
    @else
      <div class="astronaut-list">
        @foreach($astronautasRecentes as $a)
          <a href="{{ route('astronautas.show', $a) }}" class="astronaut-pill">
            <span class="astronaut-avatar">{{ strtoupper(substr($a->nome, 0, 2)) }}</span>
            <span style="flex:1;">{{ $a->nome }}</span>
            <span class="td-muted" style="font-size:12px;">{{ $a->especialidade }}</span>
          </a>
        @endforeach
      </div>
    @endif
  </div>

  <div class="dash-card">
    <h3 style="font-size:13px; text-transform:uppercase; letter-spacing:.1em; color:var(--text-muted); margin-bottom:20px;">Últimos usuários</h3>
    @if($usuariosRecentes->isEmpty())
      <p class="td-muted" style="font-size:14px;">Nenhum usuário registrado ainda.</p>
    @else
      <div class="astronaut-list">
        @foreach($usuariosRecentes as $u)
          <div class="astronaut-pill" style="cursor:default;">
            <span class="astronaut-avatar">{{ strtoupper(substr($u->name, 0, 2)) }}</span>
            <span style="flex:1;">{{ $u->name }}</span>
            <span class="badge {{ $u->isAdmin() ? 'badge-blue' : 'badge-gray' }}">{{ $u->isAdmin() ? 'Admin' : 'Usuário' }}</span>
          </div>
        @endforeach
      </div>
    @endif
  </div>

</div>

@endsection
