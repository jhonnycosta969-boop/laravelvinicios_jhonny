<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    :root {
      --bg: #07111f; --panel: #0d1b2a; --panel-2: #111827; --card: rgba(17,24,39,0.85);
      --line: rgba(148,163,184,0.18); --text: #edf4ff; --muted: #9fb0d0; --blue: #3b82f6;
      --green: #22c55e; --orange: #f59e0b; --red: #ef4444; --shadow: rgba(2,6,23,0.45);
    }

    * { box-sizing: border-box; }
    body { background: linear-gradient(135deg, #07111f 0%, #0b1628 50%, #0f172a 100%); color: var(--text); font-family: 'Inter', system-ui, sans-serif; }
    .mono { font-family: 'JetBrains Mono', monospace; }
    .sidebar { width: 260px; background: rgba(13,27,42,0.9); border-right: 1px solid var(--line); position: fixed; inset: 0 auto 0 0; display: flex; flex-direction: column; padding: 18px 14px; }
    .brand-icon { width: 40px; height: 40px; border-radius: 12px; background: rgba(59,130,246,.15); border: 1px solid rgba(59,130,246,.4); color: var(--blue); display: grid; place-items: center; font-size: 18px; }
    .brand small { font-size: 10px; color: #8ab4ff; letter-spacing: .08em; }
    .nav-tc .nav-link { color: #b9c6e3; border-radius: 10px; padding: 10px 12px; font-size: 14px; display: flex; gap: 12px; align-items: center; border-left: 3px solid transparent; }
    .nav-tc .nav-link:hover { background: rgba(255,255,255,.03); color: #fff; }
    .nav-tc .nav-link.active { background: rgba(59,130,246,.12); color: #fff; border-left-color: var(--blue); }
    .nav-tc .nav-link.active i { color: var(--blue); }
    .gateway { font-size: 10px; color: var(--muted); border-top: 1px solid var(--line); padding-top: 12px; }
    .dot { width: 7px; height: 7px; border-radius: 50%; display: inline-block; }
    .main { margin-left: 260px; }
    .topbar { height: 64px; border-bottom: 1px solid var(--line); display: flex; align-items: center; justify-content: space-between; padding: 0 28px; }
    .chip-live { font-size: 10px; color: var(--green); border: 1px solid rgba(34,197,94,.4); background: rgba(34,197,94,.08); padding: 4px 10px; border-radius: 8px; }
    .content { padding: 28px; }
    .stats { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 18px; margin-bottom: 22px; }
    .card { background: var(--card); border: 1px solid var(--line); border-radius: 18px; padding: 18px; box-shadow: 0 18px 35px var(--shadow); }
    .stat-label { color: var(--muted); font-size: 12px; text-transform: uppercase; letter-spacing: .08em; }
    .stat-value { font-size: 2rem; font-weight: 800; letter-spacing: -.04em; margin-top: 12px; }
    .stat-change { display: inline-block; margin-top: 10px; font-size: 12px; color: #a7f3d0; }
    .panel-grid { display: grid; grid-template-columns: 1.5fr .9fr; gap: 18px; }
    .list-group .list-group-item { background: rgba(148,163,184,.03); border-color: var(--line); color: var(--text); }
    .progress { height: 10px; background: rgba(148,163,184,.08); }
    .progress-bar { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
    @media (max-width: 991.98px) { .sidebar { display: none; } .main { margin-left: 0; } .stats, .panel-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 640px) { .stats, .panel-grid { grid-template-columns: 1fr; } }
  </style>
</head>
<body>
  @include('partials.sidebar')

  <div class="main">
    <header class="topbar">
      <h1 class="h5 fw-bold m-0">Dashboard</h1>
      <span class="chip-live mono">RFID READERS ACTIVE</span>
    </header>

    <main class="content">
      <div class="stats">
        <div class="card">
          <div class="stat-label">Ativos</div>
          <div class="stat-value">1.284</div>
          <div class="stat-change">+8,2% este mês</div>
        </div>
        <div class="card">
          <div class="stat-label">Em uso</div>
          <div class="stat-value">742</div>
          <div class="stat-change">+4,6% hoje</div>
        </div>
        <div class="card">
          <div class="stat-label">Retiradas</div>
          <div class="stat-value">96</div>
          <div class="stat-change">12 pendentes</div>
        </div>
        <div class="card">
          <div class="stat-label">Devoluções</div>
          <div class="stat-value">63</div>
          <div class="stat-change">9 em análise</div>
        </div>
      </div>

      <div class="panel-grid">
        <div class="card">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">Fluxo de ativos</h2>
            <span class="badge bg-primary-subtle text-primary">Semanal</span>
          </div>
          <div class="list-group list-group-flush">
            <div class="list-group-item mb-2 px-0">
              <div class="d-flex justify-content-between mb-1"><span>Notebooks</span><span>76%</span></div>
              <div class="progress"><div class="progress-bar" style="width: 76%"></div></div>
            </div>
            <div class="list-group-item mb-2 px-0">
              <div class="d-flex justify-content-between mb-1"><span>Carrinhos</span><span>63%</span></div>
              <div class="progress"><div class="progress-bar" style="width: 63%"></div></div>
            </div>
            <div class="list-group-item mb-2 px-0">
              <div class="d-flex justify-content-between mb-1"><span>Retiradas</span><span>84%</span></div>
              <div class="progress"><div class="progress-bar" style="width: 84%"></div></div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">Ações rápidas</h2>
            <i class="bi bi-lightning-charge-fill text-warning"></i>
          </div>
          <div class="d-grid gap-2">
            <a href="{{ route('carrinhos') }}" class="btn btn-outline-light text-start">Carrinhos</a>
            <a href="{{ route('notebooks') }}" class="btn btn-outline-light text-start">Notebooks</a>
            <a href="{{ route('retiradas') }}" class="btn btn-outline-light text-start">Retiradas</a>
            <a href="{{ route('relatorios') }}" class="btn btn-outline-light text-start">Relatórios</a>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
