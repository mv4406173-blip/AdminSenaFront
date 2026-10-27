@extends('layouts.app', ['title' => $title])

@section('content')
    <div class="toolbar">
        <div>
            <h1>{{ $title }}</h1>
            <div class="muted">Registros conectados con la API de adminSena.</div>
        </div>
        <a class="button" href="{{ route($resource.'.create') }}">Crear registro</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                @foreach ($fields as $field)
                    @if ($field['type'] !== 'file')
                        <th>{{ $field['label'] }}</th>
                    @else
                        <th>{{ $field['label'] }}</th>
                    @endif
                @endforeach
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($items as $item)
                <tr>
                    @foreach ($fields as $field)
                        <td>
                            @if ($field['type'] === 'file')
                                @if (data_get($item, $field['image_field']))
                                    <img class="table-image" src="{{ data_get($item, $field['image_field']) }}" alt="{{ $field['label'] }}">
                                @else
                                    <span class="muted">Sin imagen</span>
                                @endif
                            @elseif ($field['multiple'] ?? false)
                                {{ collect(data_get($item, $field['key'], []))->pluck($field['option_label'])->join(', ') ?: '—' }}
                            @else
                                {{ data_get($item, $field['column'] ?? $field['key']) ?? '—' }}
                            @endif
                        </td>
                    @endforeach
                    <td>
                        <div class="actions">
                            <a href="{{ route($resource.'.show', $item['id']) }}">Ver</a>
                            <a href="{{ route($resource.'.edit', $item['id']) }}">Editar</a>
                            <form method="post" action="{{ route($resource.'.destroy', $item['id']) }}" onsubmit="return confirm('¿Eliminar este registro?')">
                                @csrf
                                @method('DELETE')
                                <button class="button danger" type="submit">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="{{ count($fields) + 1 }}" class="muted">Todavía no hay registros.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
