<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relatórios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    :root { --bg: #0a0f1c; --panel: #0f1626; --line: #1c2740; --text: #e6ebf5; --muted: #7b8aa8; --blue: #3b82f6; }
    body { background: var(--bg); color: var(--text); font-family: 'Inter', sans-serif; }
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
    .content { padding: 32px; }
    @media (max-width: 991.98px) { .sidebar { display: none; } .main { margin-left: 0; } }
  </style>
</head>
<body>
  @include('partials.sidebar')
  <div class="main">
    <div class="content">
      <h1>Relatórios</h1>
      <p class="text-muted">Página de relatórios.</p>
    </div>
  </div>
</body>
</html>
