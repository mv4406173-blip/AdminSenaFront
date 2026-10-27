@extends('layouts.app', ['title' => $title])

@section('content')
    <div class="toolbar">
        <div>
            <h1>{{ $title }}</h1>
            <p class="muted">Detalle del registro #{{ $item['id'] }}</p>
        </div>
        <a class="button" href="{{ route($resource.'.edit', $item['id']) }}">Editar</a>
    </div>

    <section class="card" style="max-width: 760px">
        @foreach ($fields as $field)
            <div class="field">
                <label>{{ $field['label'] }}</label>
                @if ($field['type'] === 'file')
                    @if (data_get($item, $field['image_field']))
                        <img class="preview" src="{{ data_get($item, $field['image_field']) }}" alt="{{ $field['label'] }}">
                    @else
                        <span class="muted">Sin imagen</span>
                    @endif
                @elseif ($field['multiple'] ?? false)
                    <div>{{ collect(data_get($item, $field['key'], []))->pluck($field['option_label'])->join(', ') ?: '—' }}</div>
                @else
                    <div>{{ data_get($item, $field['column'] ?? $field['key']) ?? '—' }}</div>
                @endif
            </div>
        @endforeach
        <a class="button secondary" href="{{ route($resource.'.index') }}">Volver al listado</a>
    </section>
@endsection
