<?php

namespace App\Http\Controllers;

class TrainingCenterController extends ApiResourceController
{
    protected function endpoint(): string
    {
        return 'training-centers';
    }

    protected function resource(): string
    {
        return 'training-centers';
    }

    protected function title(): string
    {
        return 'Centros de formación';
    }

    protected function fields(): array
    {
        return [
            ['key' => 'name', 'label' => 'Nombre', 'type' => 'text', 'required' => true],
            ['key' => 'location', 'label' => 'Ubicación', 'type' => 'text', 'required' => true],
            ['key' => 'imagen', 'label' => 'Imagen', 'type' => 'file', 'required' => true, 'image_field' => 'imagen_url'],
        ];
    }
}
