<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robotica LMT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --bg: #07111f;
            --bg-soft: #0d1b2a;
            --panel: rgba(17, 24, 39, 0.8);
            --panel-strong: #111827;
            --line: rgba(148, 163, 184, 0.2);
            --text: #edf4ff;
            --muted: #a8b8d8;
            --primary: #3b82f6;
            --primary-strong: #2563eb;
            --success: #22c55e;
            --shadow: rgba(15, 23, 42, 0.55);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(59, 130, 246, 0.18), transparent 30%),
                radial-gradient(circle at bottom right, rgba(34, 197, 94, 0.12), transparent 28%),
                linear-gradient(135deg, var(--bg) 0%, var(--bg-soft) 100%);
            color: var(--text);
            font-family: Inter, Arial, sans-serif;
        }

        .landing-shell {
            width: min(1200px, 92vw);
            margin: 28px auto;
            padding: 24px 26px 36px;
            border: 1px solid var(--line);
            background: rgba(15, 23, 42, 0.7);
            border-radius: 28px;
            box-shadow: 0 24px 80px var(--shadow);
            backdrop-filter: blur(12px);
        }

        .landing-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 40px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(59,130,246,0.25), rgba(37,99,235,0.35));
            border: 1px solid rgba(96,165,250,0.45);
            color: #dbeafe;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .brand-copy strong {
            display: block;
            font-size: 1.05rem;
            letter-spacing: 0.04em;
        }

        .brand-copy small {
            color: var(--muted);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-strong));
            border: none;
            border-radius: 12px;
            padding: 0.85rem 1.6rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 30px rgba(59,130,246,0.35);
            color: white;
        }

        .hero {
            display: grid;
            grid-template-columns: 1.25fr 0.75fr;
            gap: 28px;
            align-items: center;
            min-height: 500px;
        }

        .hero-copy {
            padding: 14px 6px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.5rem 0.8rem;
            border-radius: 999px;
            background: rgba(59,130,246,0.12);
            border: 1px solid rgba(96,165,250,0.4);
            color: #bfdbfe;
            font-size: 0.74rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .eyebrow .dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--success);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        h1 {
            margin: 0 0 18px;
            font-size: clamp(2.6rem, 4vw, 4.8rem);
            line-height: 1.05;
            letter-spacing: -0.05em;
            font-weight: 800;
        }

        .subtitle {
            max-width: 620px;
            color: var(--muted);
            font-size: 1.08rem;
            line-height: 1.75;
            margin-bottom: 28px;
        }

        .cta-row {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .mini-badges {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 24px;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .mini-badges span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.5rem 0.8rem;
            border-radius: 10px;
            background: rgba(148, 163, 184, 0.05);
            border: 1px solid rgba(148, 163, 184, 0.15);
        }

        .hero-panel {
            position: relative;
            padding: 22px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(17,24,39,0.84), rgba(15,23,42,0.9));
            border: 1px solid var(--line);
            box-shadow: 0 20px 45px rgba(2, 6, 23, 0.4);
        }

        .stat-box {
            padding: 18px;
            border-radius: 18px;
            border: 1px solid rgba(148, 163, 184, 0.15);
            background: rgba(148, 163, 184, 0.04);
        }

        .stat-box + .stat-box {
            margin-top: 14px;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .stat-label {
            color: var(--muted);
            font-size: 0.76rem;
            letter-spacing: 0.09em;
            text-transform: uppercase;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.04em;
        }

        .trend {
            color: #9ae6b4;
            font-size: 0.78rem;
            font-weight: 700;
        }

        .bars {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            align-items: end;
            gap: 10px;
            height: 130px;
            margin-top: 12px;
        }

        .bars span {
            display: block;
            border-radius: 12px 12px 0 0;
            background: linear-gradient(180deg, #60a5fa, #2563eb);
            box-shadow: inset 0 -6px 12px rgba(255,255,255,0.08);
        }

        @media (max-width: 840px) {
            .hero {
                grid-template-columns: 1fr;
            }

            .landing-top {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="landing-shell">
        <header class="landing-top">
            <div class="brand">
                <div class="brand-mark">R</div>
                <div class="brand-copy">
                    <strong>Robotica LMT</strong>
                    <small>Asset Control</small>
                </div>
            </div>

            <a class="btn btn-primary" href="{{ route('dashboard') }}">Acessar sistema</a>
        </header>

        <section class="hero">
            <div class="hero-copy">
                <div class="eyebrow"><span class="dot"></span> Sistema operacional</div>
                <h1>Controle de patrimônio e ativos em tempo real.</h1>
                <p class="subtitle">
                    Gestão centralizada de notebooks, carrinhos, retiradas, devoluções e usuários em um único ambiente local.
                    O acesso ao painel está pronto para o domínio do Herd em <strong>http://robotica_lmt.test</strong>.
                </p>

                <div class="cta-row">
                    <a class="btn btn-primary" href="{{ route('dashboard') }}">Entrar no painel</a>
                </div>

                <div class="mini-badges">
                    <span><i class="bi bi-shield-check"></i> Monitorado</span>
                    <span><i class="bi bi-graph-up-arrow"></i> Dashboard em tempo real</span>
                    <span><i class="bi bi-laptop"></i> Equipamentos ativos</span>
                </div>
            </div>

            <div class="hero-panel">
                <div class="stat-box">
                    <div class="stat-top">
                        <div class="stat-label">Disponibilidade</div>
                        <div class="trend">+12.4%</div>
                    </div>
                    <div class="stat-value">96.8%</div>
                    <div class="bars">
                        <span style="height: 36%"></span>
                        <span style="height: 54%"></span>
                        <span style="height: 48%"></span>
                        <span style="height: 72%"></span>
                        <span style="height: 92%"></span>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-top">
                        <div class="stat-label">Ações do dia</div>
                        <div class="trend">Hoje</div>
                    </div>
                    <div class="stat-value">148</div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
