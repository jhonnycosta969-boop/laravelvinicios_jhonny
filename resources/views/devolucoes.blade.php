<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Devoluções</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
  <style>
    :root { --bg: #0a0f1c; --panel: #0f1626; --card: #111a2e; --line: #1c2740; --text: #e6ebf5; --muted: #7b8aa8; --blue: #3b82f6; --green: #10b981; --orange: #f59e0b; --red: #ef4444; }
    body { background: var(--bg); color: var(--text); font-family: 'Inter', sans-serif; }
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
    .main { margin-left: 260px; }

    /* Topo e conteúdo */
    .topbar { height: 64px; border-bottom: 1px solid var(--line); display: flex; align-items: center; justify-content: space-between; padding: 0 28px; }
    .chip-live { font-size: 10px; color: var(--green); border: 1px solid rgba(16,185,129,.4); background: rgba(16,185,129,.08); padding: 4px 10px; border-radius: 6px; }
    .content { padding: 24px 28px; }
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
    .badge-status { font-size: 12px; font-weight: 500; padding: 4px 10px; border-radius: 6px; display: inline-flex; align-items: center; gap: 6px; border: 1px solid; white-space: nowrap; }
    .st-prazo { color: var(--green); background: rgba(16,185,129,.1); border-color: rgba(16,185,129,.5); }
    .st-conferencia { color: var(--blue); background: rgba(59,130,246,.1); border-color: rgba(59,130,246,.5); }
    .st-atrasada { color: var(--orange); background: rgba(245,158,11,.1); border-color: rgba(245,158,11,.5); }
    .st-forcada { color: var(--red); background: rgba(239,68,68,.1); border-color: rgba(239,68,68,.5); }
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
  @include('partials.sidebar')

  @php
    // Dados de exemplo. Quando tiver banco, envie $devolucoes pelo Controller
    // e esta lista de exemplo deixa de ser usada.
    $devolucoes = $devolucoes ?? [
      ['id' => 'DEV-0118', 'usuario' => 'Prof. Rafael Costa', 'notebook' => 'UF-2031', 'carrinho' => 'CAR-01', 'devolucao' => 'Hoje, 10:52',   'prazo' => 'Hoje, 11:00',   'status' => 'No prazo'],
      ['id' => 'DEV-0117', 'usuario' => 'Juliana Martins',    'notebook' => 'UF-3015', 'carrinho' => 'CAR-05', 'devolucao' => 'Hoje, 10:40',   'prazo' => 'Hoje, 10:30',   'status' => 'Atrasada'],
      ['id' => 'DEV-0116', 'usuario' => 'Carlos Pereira',     'notebook' => 'UF-1987', 'carrinho' => 'CAR-02', 'devolucao' => 'Hoje, 09:48',   'prazo' => 'Ontem, 18:00',  'status' => 'Forçada'],
      ['id' => 'DEV-0115', 'usuario' => 'Fernanda Rocha',     'notebook' => 'UF-2044', 'carrinho' => 'CAR-06', 'devolucao' => 'Hoje, 09:20',   'prazo' => 'Hoje, 09:30',   'status' => 'Aguardando conferência'],
      ['id' => 'DEV-0114', 'usuario' => 'Prof. Lucas Alves',  'notebook' => 'UF-3022', 'carrinho' => 'CAR-04', 'devolucao' => 'Ontem, 16:55',  'prazo' => 'Ontem, 17:00',  'status' => 'No prazo'],
      ['id' => 'DEV-0113', 'usuario' => 'Profa. Ana Souza',   'notebook' => 'UF-8822', 'carrinho' => 'CAR-02', 'devolucao' => 'Ontem, 11:40',  'prazo' => 'Ontem, 11:30',  'status' => 'Atrasada'],
      ['id' => 'DEV-0112', 'usuario' => 'Prof. Marcos Lima',  'notebook' => 'UF-2023', 'carrinho' => 'CAR-01', 'devolucao' => '28/09, 12:00',  'prazo' => '28/09, 12:30',  'status' => 'No prazo'],
    ];

    $classes = [
      'No prazo'               => 'st-prazo',
      'Aguardando conferência' => 'st-conferencia',
      'Atrasada'               => 'st-atrasada',
      'Forçada'                => 'st-forcada',
    ];
  @endphp

  <div class="main">
    <header class="topbar">
      <h1 class="h5 fw-bold m-0">Registro de Devoluções</h1>
      <div class="d-flex align-items-center gap-3">
        <span class="chip-live mono">RFID READERS ACTIVE</span>
        <button class="btn btn-sm rounded-circle border" style="width:38px;height:38px;border-color:var(--line)!important;color:var(--text)" aria-label="Notificações"><i class="bi bi-bell"></i></button>
      </div>
    </header>

    <main class="content">
      <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
        <div class="d-flex flex-wrap gap-2">
          <div class="input-group" style="width:290px">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input id="busca" type="search" class="form-control" placeholder="Buscar por usuário ou notebook...">
          </div>
          <select id="filtro" class="form-select" style="width:230px" aria-label="Filtrar por status">
            <option value="">Status: Todos</option>
            <option value="No prazo">No prazo</option>
            <option value="Aguardando conferência">Aguardando conferência</option>
            <option value="Atrasada">Atrasada</option>
            <option value="Forçada">Forçada</option>
          </select>
        </div>
        <button class="btn btn-tc"><i class="bi bi-plus-lg me-1"></i> Nova Devolução</button>
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
                <th>Devolução</th>
                <th>Prazo</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody id="lista">
              @foreach ($devolucoes as $d)
                <tr data-status="{{ $d['status'] }}">
                  <td class="mono fw-semibold">{{ $d['id'] }}</td>
                  <td class="fw-semibold">{{ $d['usuario'] }}</td>
                  <td class="mono">{{ $d['notebook'] }}</td>
                  <td class="mono text-muted-tc">{{ $d['carrinho'] }}</td>
                  <td class="text-muted-tc">{{ $d['devolucao'] }}</td>
                  <td class="text-muted-tc">{{ $d['prazo'] }}</td>
                  <td>
                    <span class="badge-status {{ $classes[$d['status']] ?? 'st-prazo' }}">
                      <span class="dot" style="background:currentColor"></span>{{ $d['status'] }}
                    </span>
                  </td>
                  <td>
                    <div class="d-flex gap-1 flex-nowrap">
                      <button class="btn btn-soft">Ver</button>
                      @if ($d['status'] === 'Aguardando conferência')
                        <button class="btn btn-blue">Confirmar</button>
                      @elseif ($d['status'] === 'Forçada')
                        <button class="btn btn-warn">Ver ocorrência</button>
                      @endif
                    </div>
                  </td>
                </tr>
              @endforeach
              <tr id="vazio" class="d-none">
                <td colspan="8" class="text-center text-muted-tc py-4">Nenhuma devolução encontrada. Tente outro termo ou status.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="small text-muted-tc mt-2" id="contagem"></div>
    </main>
  </div>

  <script>
    const busca = document.getElementById('busca');
    const filtro = document.getElementById('filtro');
    const linhas = document.querySelectorAll('#lista tr[data-status]');
    const vazio = document.getElementById('vazio');
    const contagem = document.getElementById('contagem');

    function filtrar() {
      const q = busca.value.trim().toLowerCase();
      const f = filtro.value;
      let visiveis = 0;
      linhas.forEach(function (tr) {
        const ok = (!f || tr.dataset.status === f) && (!q || tr.textContent.toLowerCase().includes(q));
        tr.classList.toggle('d-none', !ok);
        if (ok) visiveis++;
      });
      vazio.classList.toggle('d-none', visiveis > 0);
      contagem.textContent = 'Mostrando ' + visiveis + ' de ' + linhas.length + ' devoluções';
    }

    busca.addEventListener('input', filtrar);
    filtro.addEventListener('change', filtrar);
    filtrar();
  </script>
</body>
</html>