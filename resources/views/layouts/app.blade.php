<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Administración SENA' }} | adminSena</title>
    <style>
        :root { color-scheme: light; font-family: Inter, "Segoe UI", sans-serif; color: #17211b; background: #f3f6f3; }
        * { box-sizing: border-box; }
        body { margin: 0; }
        a { color: #147d45; text-decoration: none; }
        a:hover { color: #0c5830; }
        header { background: #14532d; color: #fff; }
        .topbar { max-width: 1180px; margin: auto; padding: 18px 24px; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .brand { color: white; font-size: 19px; font-weight: 750; letter-spacing: .2px; white-space: nowrap; }
        nav { display: flex; gap: 16px; flex-wrap: wrap; }
        nav a { color: #e4f2e8; font-size: 14px; }
        nav a:hover { color: #fff; }
        main { max-width: 1180px; margin: 36px auto; padding: 0 24px 48px; }
        h1 { margin: 0 0 8px; font-size: 30px; }
        h2 { margin-top: 0; }
        .muted { color: #68756c; }
        .toolbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin: 24px 0 16px; }
        .button { display: inline-flex; align-items: center; justify-content: center; border: 0; border-radius: 7px; padding: 10px 15px; background: #16834a; color: #fff; font: inherit; font-weight: 650; cursor: pointer; }
        .button:hover { background: #10683a; color: #fff; }
        .button.secondary { background: #e7eee9; color: #263a2d; }
        .button.danger { background: #b42332; }
        .card, .table-wrap { background: white; border: 1px solid #e1e9e3; border-radius: 12px; box-shadow: 0 4px 16px #163a2010; }
        .card { padding: 24px; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 14px 16px; text-align: left; border-bottom: 1px solid #edf1ed; vertical-align: middle; }
        th { color: #526056; font-size: 12px; text-transform: uppercase; letter-spacing: .06em; background: #f8faf8; }
        tr:last-child td { border-bottom: 0; }
        .actions { display: flex; gap: 12px; align-items: center; white-space: nowrap; }
        .actions form { margin: 0; }
        .field { margin-bottom: 18px; }
        label { display: block; margin-bottom: 7px; font-weight: 650; }
        input, select { width: 100%; border: 1px solid #cbd6ce; border-radius: 7px; padding: 10px 12px; color: inherit; background: #fff; font: inherit; }
        select[multiple] { min-height: 130px; }
        input[type=file] { padding: 8px; }
        .field-error { color: #b42332; font-size: 13px; margin-top: 5px; }
        .alert { padding: 12px 15px; border-radius: 8px; margin-bottom: 18px; background: #e7f6ec; color: #14532d; }
        .alert.error { background: #fff0ef; color: #9c2025; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 18px; }
        .tile { display: block; padding: 22px; background: white; border: 1px solid #e1e9e3; border-radius: 12px; }
        .tile h2 { margin: 0 0 8px; font-size: 18px; }
        .preview { display: block; max-width: 240px; max-height: 180px; object-fit: cover; border-radius: 8px; margin-top: 10px; }
        .table-image { width: 60px; height: 44px; object-fit: cover; border-radius: 6px; }
        @media (max-width: 760px) { .topbar { align-items: flex-start; flex-direction: column; } main { margin-top: 25px; padding-right: 16px; padding-left: 16px; } .toolbar { align-items: flex-start; flex-direction: column; } }
    </style>
</head>
<body>
<header>
    <div class="topbar">
        <a class="brand" href="{{ route('home') }}">adminSena Front</a>
        <nav aria-label="Navegación principal">
            <a href="{{ route('training-centers.index') }}">Centros</a>
            <a href="{{ route('areas.index') }}">Áreas</a>
            <a href="{{ route('computers.index') }}">Computadores</a>
            <a href="{{ route('courses.index') }}">Cursos</a>
            <a href="{{ route('apprentices.index') }}">Aprendices</a>
            <a href="{{ route('teachers.index') }}">Instructores</a>
        </nav>
    </div>
</header>
<main>
    @if (session('status'))
        <div class="alert" role="status">{{ session('status') }}</div>
    @endif
    @if ($errors->has('api'))
        <div class="alert error" role="alert">{{ $errors->first('api') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
