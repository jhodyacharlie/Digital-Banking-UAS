<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Digeboy Digital Banking')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #071a3d;
            --navy-soft: #102a5c;
            --blue: #2563eb;
            --cyan: #38bdf8;
            --white: #ffffff;
            --muted: #64748b;
            --line: #e2e8f0;
            --bg: #f6f9ff;
            --success: #16a34a;
            --danger: #dc2626;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            color: #0f172a;
            background: var(--bg);
        }

        .topbar {
            background: var(--navy);
            color: var(--white);
            padding: 18px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .brand {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .brand span {
            color: var(--cyan);
        }

        .nav {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .nav a {
            color: #dbeafe;
            text-decoration: none;
            font-weight: 700;
            padding: 9px 14px;
            border-radius: 8px;
        }

        .nav a:hover {
            background: rgba(255, 255, 255, .12);
            color: var(--white);
        }

        .hero {
            background: linear-gradient(135deg, var(--navy), var(--navy-soft));
            color: var(--white);
            padding: 44px 32px 84px;
        }

        .hero-inner, .page {
            width: min(1120px, 100%);
            margin: 0 auto;
        }

        .eyebrow {
            margin: 0 0 10px;
            color: #bfdbfe;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1.8px;
        }

        h1 {
            margin: 0;
            font-size: clamp(32px, 5vw, 52px);
            line-height: 1.05;
        }

        .subtitle {
            margin: 14px 0 0;
            color: #dbeafe;
            max-width: 680px;
            line-height: 1.7;
        }

        .page {
            margin-top: -48px;
            padding: 0 24px 48px;
        }

        .panel {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 8px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .10);
            overflow: hidden;
        }

        .panel-header {
            padding: 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            border-bottom: 1px solid var(--line);
        }

        .panel-title {
            margin: 0;
            color: var(--navy);
            font-size: 20px;
        }

        .panel-caption {
            margin: 6px 0 0;
            color: var(--muted);
        }

        .btn {
            border: 0;
            border-radius: 8px;
            padding: 11px 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            min-height: 42px;
        }

        .btn-primary {
            background: var(--blue);
            color: var(--white);
        }

        .btn-secondary {
            background: #e0f2fe;
            color: var(--navy);
        }

        .btn-danger {
            background: #fee2e2;
            color: var(--danger);
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 16px 22px;
            text-align: left;
            border-bottom: 1px solid var(--line);
            white-space: nowrap;
        }

        th {
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .8px;
            background: #f8fafc;
        }

        tr:last-child td {
            border-bottom: 0;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 800;
            background: #e0f2fe;
            color: var(--navy);
        }

        .badge-active {
            background: #dcfce7;
            color: var(--success);
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .form {
            padding: 24px;
            display: grid;
            gap: 18px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        label {
            display: grid;
            gap: 8px;
            font-weight: 800;
            color: var(--navy);
        }

        input, select {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 13px 14px;
            font: inherit;
            color: #0f172a;
            background: var(--white);
        }

        input:focus, select:focus {
            outline: 3px solid #bfdbfe;
            border-color: var(--blue);
        }

        .error {
            color: var(--danger);
            font-size: 13px;
            font-weight: 700;
        }

        .empty {
            padding: 32px 22px;
            color: var(--muted);
            text-align: center;
        }

        @media (max-width: 720px) {
            .topbar, .panel-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .hero {
                padding-inline: 24px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            th, td {
                padding: 14px;
            }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="brand">dige<span>boy</span></div>
        <nav class="nav" aria-label="Navigasi utama">
            <a href="{{ route('accounts.index') }}">Account</a>
            <a href="{{ route('balances.index') }}">Balance</a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-inner">
            <p class="eyebrow">Digital Banking Dashboard</p>
            <h1>@yield('heading')</h1>
            <p class="subtitle">@yield('subtitle')</p>
        </div>
    </section>

    <main class="page">
        @yield('content')
    </main>
</body>
</html>
