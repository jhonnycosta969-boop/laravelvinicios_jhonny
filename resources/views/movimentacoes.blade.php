<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimentações | TechControl</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --bg: #07111f;
            --panel: rgba(17, 24, 39, 0.85);
            --line: rgba(148, 163, 184, 0.18);
            --text: #edf4ff;
            --muted: #9fb0d0;
            --blue: #3b82f6;
        }

        * { box-sizing: border-box; }
        body { min-height: 100vh; background: linear-gradient(135deg, #07111f, #0b1628 55%, #0f172a); color: var(--text); font-family: Inter, system-ui, sans-serif; }
        .main { margin-left: 260px; }
        .topbar { min-height: 64px; border-bottom: 1px solid var(--line); display: flex; align-items: center; justify-content: space-between; padding: 12px 28px; }
        .content { padding: 28px; }
        .panel { background: var(--panel); border: 1px solid var(--line); border-radius: 18px; box-shadow: 0 18px 35px rgba(2, 6, 23, 0.35); }
        .muted { color: var(--muted); }
        .table { --bs-table-bg: transparent; --bs-table-color: var(--text); --bs-table-border-color: var(--line); }
        .table thead th { color: var(--muted); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.06em; white-space: nowrap; }
        .table td { vertical-align: middle; }
        .type-badge { background: rgba(59, 130, 246, 0.14); border: 1px solid rgba(59, 130, 246, 0.28); color: #bfdbfe; }
        .empty-state { min-height: 240px; display: grid; place-content: center; text-align: center; }

        @media (max-width: 991.98px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
        }

        @media (max-width: 575.98px) {
            .topbar, .content { padding: 18px; }
        }
    </style>
</head>
<body>
    @include('partials.sidebar')

    <div class="main">
        <header class="topbar">
            <div>
                <h1 class="h5 fw-bold mb-1">Movimentações</h1>
                <p class="small muted mb-0">Histórico de entradas, saídas e ajustes de materiais</p>
            </div>
            <span class="badge rounded-pill text-bg-primary"><i class="bi bi-arrow-left-right me-1"></i> Estoque</span>
        </header>

        <main class="content">
            @if (! $tabelaDisponivel)
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-database-exclamation me-2"></i>
                    A tabela de movimentações ainda não existe no banco. Execute as migrations depois de corrigir a ordem de criação das tabelas.
                </div>
            @else
                <section class="panel p-3 p-lg-4">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                        <div>
                            <h2 class="h6 fw-bold mb-1">Histórico registrado</h2>
                            <p class="small muted mb-0">{{ $movimentacoes->total() }} registro(s)</p>
                        </div>
                        <span class="small muted"><i class="bi bi-clock-history me-1"></i> Mais recentes primeiro</span>
                    </div>

                    @if ($movimentacoes->isEmpty())
                        <div class="empty-state">
                            <div>
                                <i class="bi bi-inbox fs-1 muted"></i>
                                <h3 class="h6 mt-3">Nenhuma movimentação registrada</h3>
                                <p class="small muted mb-0">Quando houver registros, eles aparecerão nesta lista.</p>
                            </div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Data e hora</th>
                                        <th scope="col">Material</th>
                                        <th scope="col">Usuário</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col" class="text-end">Quantidade</th>
                                        <th scope="col">Observação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movimentacoes as $movimentacao)
                                        <tr>
                                            <td class="text-nowrap">{{ $movimentacao->data_hora?->format('d/m/Y H:i') }}</td>
                                            <td>#{{ $movimentacao->id_material }}</td>
                                            <td>#{{ $movimentacao->id_usuario }}</td>
                                            <td><span class="badge rounded-pill type-badge">{{ ucfirst(str_replace('_', ' ', $movimentacao->tipo)) }}</span></td>
                                            <td class="text-end">{{ number_format($movimentacao->quantidade, 0, ',', '.') }}</td>
                                            <td class="muted">{{ $movimentacao->observacao ?: '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="pt-3">
                            {{ $movimentacoes->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </section>
            @endif
        </main>
    </div>
</body>
</html>
