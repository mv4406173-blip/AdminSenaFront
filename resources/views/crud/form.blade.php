@extends('layouts.app', ['title' => ($mode === 'create' ? 'Crear' : 'Editar').' '.$title])

@section('content')
    <h1>{{ $mode === 'create' ? 'Crear' : 'Editar' }} {{ $title }}</h1>
    <p class="muted">Los datos se guardan en el backend de adminSena.</p>

    <form class="card" style="max-width: 760px; margin-top: 22px" method="post"
          action="{{ $mode === 'create' ? route($resource.'.store') : route($resource.'.update', $item['id']) }}"
          enctype="multipart/form-data">
        @csrf
        @if ($mode === 'edit')
            @method('PUT')
        @endif

        @foreach ($fields as $field)
            @php
                $key = $field['key'];
                $selectedValues = ($field['multiple'] ?? false)
                    ? collect($item[$key] ?? [])->pluck('id')->all()
                    : [];
                $value = old($key, ($field['multiple'] ?? false) ? $selectedValues : ($item[$key] ?? ''));
            @endphp
            <div class="field">
                <label for="{{ $key }}">{{ $field['label'] }} @if ($field['required'] ?? false)<span aria-hidden="true">*</span>@endif</label>

                @if ($field['type'] === 'file')
                    <input id="{{ $key }}" name="{{ $key }}" type="file" accept="image/*"
                           @if (($field['required'] ?? false) && $mode === 'create') required @endif>
                    @if (! empty($field['image_field']) && ! empty($item[$field['image_field'] ?? '']))
                        <img class="preview" src="{{ $item[$field['image_field']] }}" alt="Imagen actual">
                    @endif
                    @if ($mode === 'edit')
                        <div class="muted">Deja vacío para conservar la imagen actual.</div>
                    @endif
                @elseif ($field['type'] === 'select')
                    <select id="{{ $key }}" name="{{ $key }}{{ ($field['multiple'] ?? false) ? '[]' : '' }}"
                            @if ($field['multiple'] ?? false) multiple @endif
                            @if (($field['required'] ?? false) && ! ($field['multiple'] ?? false)) required @endif>
                        @unless ($field['multiple'] ?? false)
                            <option value="">Selecciona una opción</option>
                        @endunless
                        @foreach ($options[$key] ?? [] as $option)
                            <option value="{{ $option['id'] }}"
                                @if (($field['multiple'] ?? false) ? in_array($option['id'], $value) : (string) $option['id'] === (string) $value) selected @endif>
                                {{ data_get($option, $field['option_label'] ?? 'name') }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <input id="{{ $key }}" name="{{ $key }}" type="{{ $field['type'] }}"
                           value="{{ $value }}" @if ($field['required'] ?? false) required @endif>
                @endif

                @error($key)<div class="field-error">{{ $message }}</div>@enderror
            </div>
        @endforeach

        <div class="actions">
            <button class="button" type="submit">{{ $mode === 'create' ? 'Crear registro' : 'Guardar cambios' }}</button>
            <a class="button secondary" href="{{ route($resource.'.index') }}">Cancelar</a>
        </div>
    </form>
@endsection
