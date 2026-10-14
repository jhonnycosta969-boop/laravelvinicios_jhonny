<aside class="sidebar">
  <div class="brand d-flex align-items-center gap-2 mb-4 px-1">
    <div class="brand-icon"><i class="bi bi-x-circle"></i></div>
    <div>
      <div class="fw-bold">TechControl</div>
      <small class="mono">RFID ASSET OPS</small>
    </div>
  </div>

  <nav class="nav nav-tc flex-column gap-1">
    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-grid"></i> Dashboard</a>
    <a class="nav-link {{ request()->routeIs('carrinhos') ? 'active' : '' }}" href="{{ route('carrinhos') }}"><i class="bi bi-truck"></i> Carrinhos</a>
    <a class="nav-link {{ request()->routeIs('notebooks') ? 'active' : '' }}" href="{{ route('notebooks') }}"><i class="bi bi-laptop"></i> Notebooks</a>
    <a class="nav-link {{ request()->routeIs('retiradas') ? 'active' : '' }}" href="{{ route('retiradas') }}"><i class="bi bi-box-arrow-up-right"></i> Retiradas</a>
    <a class="nav-link {{ request()->routeIs('movimentacoes.pagina') ? 'active' : '' }}" href="{{ route('movimentacoes.pagina') }}"><i class="bi bi-arrow-left-right"></i> Movimentações</a>
    <a class="nav-link {{ request()->routeIs('devolucoes') ? 'active' : '' }}" href="{{ route('devolucoes') }}"><i class="bi bi-box-arrow-in-down-left"></i> Devoluções</a>
    <a class="nav-link {{ request()->routeIs('usuarios') ? 'active' : '' }}" href="{{ route('usuarios') }}"><i class="bi bi-people"></i> Usuários</a>
    <a class="nav-link {{ request()->routeIs('relatorios') ? 'active' : '' }}" href="{{ route('relatorios') }}"><i class="bi bi-file-earmark-text"></i> Relatórios</a>
  </nav>

  <div class="mt-auto gateway">
    <div class="mono mb-3"><span class="dot bg-success me-1"></span> ESP32 GATEWAY: ON</div>
    <div class="d-flex align-items-center gap-2">
      <div class="brand-icon" style="width:36px;height:36px;border-radius:50%"><i class="bi bi-person"></i></div>
      <div>
        <div class="fw-semibold" style="font-size:13px;color:var(--text)">Op. Central</div>
        <div class="mono" style="font-size:10px">ID: #4092</div>
      </div>
    </div>
  </div>
</aside>
