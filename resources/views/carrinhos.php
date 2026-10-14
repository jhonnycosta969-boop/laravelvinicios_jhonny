<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Retiradas | TechControl</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #0a0f1c; --panel: #0f1626; --card: #111a2e; --line: #1c2740;
    --text: #e6ebf5; --muted: #7b8aa8;
    --blue: #3b82f6; --green: #10b981; --orange: #f59e0b; --red: #ef4444;
  }
  body { background: var(--bg); color: var(--text); font-family: 'Inter', system-ui, sans-serif; }
  .mono { font-family: 'JetBrains Mono', monospace; }
  .text-muted-tc { color: var(--muted) !important; }

  /* Sidebar */
  .sidebar { width: 260px; background: var(--panel); border-right: 1px solid var(--line); position: fixed; inset: 0 auto 0 0; display: flex; flex-direction: column; padding: 18px 14px; }
  .brand-icon { width: 40px; height: 40px; border-radius: 10px; background: rgba(59,130,246,.15); border: 1px solid rgba(59,130,246,.4); color: var(--blue); display: grid; place-items: center; font-size: 18px; }
  .brand small { font-size: 10px; color: var(--blue); letter-spacing: .08em; }
  .nav-tc .nav-link { color: #a9b6d0; border-radius: 8px; padding: 10px 12px; font-size: 14px; display: flex; gap: 12px; align-items: center; border-left: 3px solid transparent; }
  .nav-tc .nav-link:hover { background: rgba(255,255,255,.04); color: #fff; }
  .nav-tc .nav-link.active { background: #17233d; color: #fff; border-left-color: var(--blue); }
  .nav-tc .nav-link.active i { color: var(--blue); }
  .gateway { font-size: 10px; color: var(--muted); border-top: 1px solid var(--line); padding-top: 12px; }
  .dot { width: 7px; height: 7px; border-radius: 50%; display: inline-block; }

  /* Conteúdo */
  .main { margin-left: 260px; }
  .topbar { height: 64px; border-bottom: 1px solid var(--line); display: flex; align-items: center; justify-content: space-between; padding: 0 28px; }
  .chip-live { font-size: 10px; color: var(--green); border: 1px solid rgba(16,185,129,.4); background: rgba(16,185,129,.08); padding: 4px 10px; border-radius: 6px; }
  .tc-card { background: var(--card); border: 1px solid var(--line); border-radius: 12px; }

  /* Filtros */
  .form-control, .form-select { background: var(--panel); border: 1px solid var(--line); color: var(--text); font-size: 14px; }
  .form-control:focus, .form-select:focus { background: var(--panel); color: var(--text); border-color: var(--blue); box-shadow: 0 0 0 3px rgba(59,130,246,.2); }
  .form-control::placeholder { color: var(--muted); }
  .input-group-text { background: var(--panel); border: 1px solid var(--line); color: var(--muted); }
  .btn-tc { background: var(--blue); border: 0; color: #fff; font-weight: 500; font-size: 14px; }
  .btn-tc:hover { background: #2f6fe0; color: #fff; }

  /* Tabela */
  .table-tc { --bs-table-bg: transparent; --bs-table-color: var(--text); --bs-table-border-color: var(--line); --bs-table-hover-bg: rgba(255,255,255,.03); --bs-table-hover-color: var(--text); margin: 0; font-size: 14px; }
  .table-tc thead th { color: var(--muted); font-weight: 500; font-size: 12px; text-transform: uppercase; letter-spacing: .04em; border-bottom: 1px solid var(--line); padding: 14px 16px; white-space: nowrap; }
  .table-tc td { padding: 14px 16px; vertical-align: middle; }
  .badge-status { font-size: 12px; font-weight: 500; padding: 4px 10px; border-radius: 6px; display: inline-flex; align-items: center; gap: 6px; border: 1px solid; }
  .st-uso { color: var(--blue); background: rgba(59,130,246,.1); border-color: rgba(59,130,246,.5); }
  .st-devolvido { color: var(--green); background: rgba(16,185,129,.1); border-color: rgba(16,185,129,.5); }
  .st-atrasado { color: var(--red); background: rgba(239,68,68,.1); border-color: rgba(239,68,68,.5); }
  .btn-soft { background: #1a2438; border: 0; color: var(--text); font-size: 12px; font-weight: 500; padding: 5px 12px; }
  .btn-soft:hover { background: #24304a; color: #fff; }
  .btn-blue { background: var(--blue); border: 0; color: #fff; font-size: 12px; font-weight: 500; padding: 5px 12px; }
  .btn-blue:hover { background: #2f6fe0; color: #fff; }
  .btn-warn { background: var(--orange); border: 0; color: #1a1200; font-size: 12px; font-weight: 600; padding: 5px 12px; }
  .btn-warn:hover { background: #e08f00; color: #1a1200; }

  @media (max-width: 991.98px) { .sidebar { display: none; } .main { margin-left: 0; } }
</style>
</head>
<body>

<aside class="sidebar">
  <div class="brand d-flex align-items-center gap-2 mb-4 px-1">
    <div class="brand-icon"><i class="bi bi-x-circle"></i></div>
    <div>
      <div class="fw-bold">TechControl</div>
      <small class="mono">RFID ASSET OPS</small>
    </div>
  </div>

  <nav class="nav nav-tc flex-column gap-1">
    <a class="nav-link" href="/dashboard"><i class="bi bi-grid"></i> Dashboard</a>
    <a class="nav-link active" href="/carrinhos"><i class="bi bi-truck"></i> Carrinhos</a>
    <a class="nav-link" href="/notebooks"><i class="bi bi-laptop"></i> Notebooks</a>
    <a class="nav-link" href="/retiradas"><i class="bi bi-box-arrow-up-right"></i> Retiradas</a>
    <a class="nav-link" href="/devolucoes"><i class="bi bi-box-arrow-in-down-left"></i> Devoluções</a>
    <a class="nav-link" href="/usuarios"><i class="bi bi-people"></i> Usuários</a>
    <a class="nav-link" href="/relatorios"><i class="bi bi-file-earmark-text"></i> Relatórios</a>
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

<div class="main">
  <header class="topbar">
    <h1 class="h5 fw-bold m-0">Registro de Retiradas</h1>
    <div class="d-flex align-items-center gap-3">
      <span class="chip-live mono">RFID READERS ACTIVE</span>
      <button class="btn btn-sm rounded-circle border" style="width:38px;height:38px;border-color:var(--line)!important;color:var(--text)" aria-label="Notificações"><i class="bi bi-bell"></i></button>
    </div>
  </header>

  <main class="p-4">
    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
      <div class="d-flex flex-wrap gap-2">
        <div class="input-group" style="width:280px">
          <span class="input-group-text"><i class="bi bi-search"></i></span>
          <input id="busca" type="search" class="form-control" placeholder="Buscar por usuário ou notebook...">
        </div>
        <select id="filtro" class="form-select" style="width:170px" aria-label="Filtrar por status">
          <option value="">Status: Todos</option>
          <option value="Em uso">Em uso</option>
          <option value="Devolvido">Devolvido</option>
          <option value="Atrasado">Atrasado</option>
        </select>
      </div>
      <button class="btn btn-tc"><i class="bi bi-plus-lg me-1"></i> Nova Retirada</button>
    </div>

    <div class="tc-card overflow-hidden">
      <div class="table-responsive">
        <table class="table table-tc table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Usuário</th>
              <th>Notebook</th>
              <th>Carrinho</th>
              <th>Retirada</th>
              <th>Prazo</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody id="lista"></tbody>
        </table>
      </div>
    </div>
    <div class="small text-muted-tc mt-2" id="contagem"></div>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Dados de exemplo. No projeto real, troque por dados do banco (Controller).
  const retiradas = [
    { id: 'RET-0231', usuario: 'Prof. Marcos Lima', nb: 'UF-2023', car: 'CAR-01', saida: 'Hoje, 08:10', prazo: 'Hoje, 12:00', status: 'Em uso' },
    { id: 'RET-0230', usuario: 'Profa. Ana Souza', nb: 'UF-8822', car: 'CAR-02', saida: 'Hoje, 07:45', prazo: 'Hoje, 11:30', status: 'Em uso' },
    { id: 'RET-0229', usuario: 'Carlos Pereira', nb: 'UF-1987', car: 'CAR-02', saida: 'Ontem, 14:20', prazo: 'Ontem, 18:00', status: 'Atrasado' },
    { id: 'RET-0228', usuario: 'Prof. Rafael Costa', nb: 'UF-2031', car: 'CAR-01', saida: 'Ontem, 09:00', prazo: 'Ontem, 11:00', status: 'Devolvido' },
    { id: 'RET-0227', usuario: 'Juliana Martins', nb: 'UF-3015', car: 'CAR-05', saida: 'Ontem, 08:30', prazo: 'Ontem, 10:30', status: 'Devolvido' },
    { id: 'RET-0226', usuario: 'Prof. Lucas Alves', nb: 'UF-3022', car: 'CAR-04', saida: 'Hoje, 09:15', prazo: 'Hoje, 13:00', status: 'Em uso' },
    { id: 'RET-0225', usuario: 'Fernanda Rocha', nb: 'UF-2044', car: 'CAR-06', saida: '28/09, 15:00', prazo: '28/09, 17:00', status: 'Devolvido' },
  ];

  const cls = { 'Em uso': 'st-uso', 'Devolvido': 'st-devolvido', 'Atrasado': 'st-atrasado' };
  const tbody = document.getElementById('lista');
  const busca = document.getElementById('busca');
  const filtro = document.getElementById('filtro');

  function acoes(r) {
    let extra = '';
    if (r.status === 'Em uso') extra = '<button class="btn btn-blue">Registrar devolução</button>';
    if (r.status === 'Atrasado') extra = '<button class="btn btn-warn">Notificar</button>';
    return `<div class="d-flex gap-1 flex-nowrap"><button class="btn btn-soft">Ver</button>${extra}</div>`;
  }

  function desenhar() {
    const q = busca.value.trim().toLowerCase();
    const f = filtro.value;
    const itens = retiradas.filter(r =>
      (!f || r.status === f) &&
      (!q || r.usuario.toLowerCase().includes(q) || r.nb.toLowerCase().includes(q) || r.id.toLowerCase().includes(q))
    );
    tbody.innerHTML = itens.length ? itens.map(r => `
      <tr>
        <td class="mono fw-semibold">${r.id}</td>
        <td class="fw-semibold">${r.usuario}</td>
        <td class="mono">${r.nb}</td>
        <td class="mono text-muted-tc">${r.car}</td>
        <td class="text-muted-tc">${r.saida}</td>
        <td class="text-muted-tc">${r.prazo}</td>
        <td><span class="badge-status ${cls[r.status]}"><span class="dot" style="background:currentColor"></span>${r.status}</span></td>
        <td>${acoes(r)}</td>
      </tr>`).join('')
      : '<tr><td colspan="8" class="text-center text-muted-tc py-4">Nenhuma retirada encontrada. Tente outro termo ou status.</td></tr>';
    document.getElementById('contagem').textContent = `Mostrando ${itens.length} de ${retiradas.length} retiradas`;
  }

  busca.addEventListener('input', desenhar);
  filtro.addEventListener('change', desenhar);
  desenhar();
</script>
</body>
</html>