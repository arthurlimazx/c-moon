<div class="starfield">
  <canvas id="stars"></canvas>
</div>

<nav class="navbar">
  <a href="{{ route('welcome') }}" class="navbar-brand">
    <span class="dot"></span>
    C-Moon
  </a>

  <ul class="navbar-links">
    @auth
      <li><a href="{{ route('astronautas.index') }}" class="{{ request()->routeIs('astronautas.*') ? 'active' : '' }}">Astronautas</a></li>
      <li><a href="{{ route('corpos.index') }}"      class="{{ request()->routeIs('corpos.*')     ? 'active' : '' }}">Corpos Celestes</a></li>
      <li><a href="{{ route('missoes.index') }}"     class="{{ request()->routeIs('missoes.*')    ? 'active' : '' }}">Missões</a></li>
    @endauth
  </ul>

  <div class="navbar-actions">
    @auth
      <div class="navbar-user" id="userMenu">
        <button class="navbar-user-btn" onclick="toggleUserDropdown()">
          <span class="navbar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
          {{ explode(' ', Auth::user()->name)[0] }}
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M3 4.5l3 3 3-3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
        </button>

        <div class="navbar-dropdown" id="userDropdown">
          <div class="navbar-dropdown-header">
            <div class="navbar-dropdown-name">{{ Auth::user()->name }}</div>
            <div class="navbar-dropdown-email">{{ Auth::user()->email }}</div>
          </div>

          <a href="{{ route('profile.edit') }}" class="navbar-dropdown-item">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M8 8a3 3 0 100-6 3 3 0 000 6z"/>
              <path d="M2 14s.5-4 6-4 6 4 6 4" stroke-linecap="round"/>
            </svg>
            Meu perfil
          </a>

          <a href="{{ route('welcome') }}" class="navbar-dropdown-item">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
              <rect x="1" y="3" width="14" height="10" rx="1.5"/>
              <path d="M5 7h6M5 10h4" stroke-linecap="round"/>
            </svg>
            Início
          </a>

          <div class="navbar-dropdown-divider"></div>

          <a href="{{ route('logout') }}" class="navbar-dropdown-item danger"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
    <path d="M10 3h3a1 1 0 011 1v8a1 1 0 01-1 1h-3" stroke-linecap="round"/>
    <path d="M7 11l3-3-3-3M10 8H2" stroke-linecap="round"/>
  </svg>
  Sair
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>
        </div>
      </div>
    @else
      <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Entrar</a>
      @if(Route::has('register'))
        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Criar conta</a>
      @endif
    @endauth
  </div>
</nav>