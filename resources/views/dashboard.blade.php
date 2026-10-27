@extends('layouts.app', ['title' => 'Panel de administración'])

@section('content')
    <h1>Panel de administración</h1>
    <p class="muted">Administra la información de centros, cursos, instructores y recursos de formación.</p>
    <div class="grid" style="margin-top: 26px">
        @foreach ([
            ['Centros de formación', 'Gestiona los centros y su ubicación.', 'training-centers.index'],
            ['Áreas', 'Organiza las áreas de formación.', 'areas.index'],
            ['Computadores', 'Administra los equipos disponibles.', 'computers.index'],
            ['Cursos', 'Gestiona cursos e instructores asociados.', 'courses.index'],
            ['Aprendices', 'Administra matrículas y asignaciones.', 'apprentices.index'],
            ['Instructores', 'Gestiona los perfiles de instructores.', 'teachers.index'],
        ] as [$name, $description, $route])
            <a class="tile" href="{{ route($route) }}">
                <h2>{{ $name }}</h2>
                <span class="muted">{{ $description }}</span>
            </a>
        @endforeach
    </div>
@endsection
