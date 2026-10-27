<?php

namespace App\Http\Controllers;

class TeacherController extends ApiResourceController
{
    protected function endpoint(): string
    {
        return 'teachers';
    }

    protected function resource(): string
    {
        return 'teachers';
    }

    protected function title(): string
    {
        return 'Instructores';
    }

    protected function fields(): array
    {
        return [
            ['key' => 'name', 'label' => 'Nombre', 'type' => 'text', 'required' => true],
            ['key' => 'email', 'label' => 'Correo electrónico', 'type' => 'email', 'required' => true],
            ['key' => 'area_id', 'label' => 'Área', 'type' => 'select', 'required' => true, 'options' => 'areas', 'option_label' => 'name', 'column' => 'area.name'],
            ['key' => 'trainingcenter_id', 'label' => 'Centro de formación', 'type' => 'select', 'required' => true, 'options' => 'training-centers', 'option_label' => 'name', 'column' => 'trainingCenter.name'],
            ['key' => 'imagen', 'label' => 'Imagen', 'type' => 'file', 'required' => true, 'image_field' => 'imagen_url'],
        ];
    }
}
