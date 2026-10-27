<?php

namespace App\Http\Controllers;

class CourseController extends ApiResourceController
{
    protected function endpoint(): string
    {
        return 'courses';
    }

    protected function resource(): string
    {
        return 'courses';
    }

    protected function title(): string
    {
        return 'Cursos';
    }

    protected function fields(): array
    {
        return [
            ['key' => 'course_number', 'label' => 'Número del curso', 'type' => 'text', 'required' => true],
            ['key' => 'day', 'label' => 'Día', 'type' => 'text', 'required' => true],
            ['key' => 'area_id', 'label' => 'Área', 'type' => 'select', 'required' => true, 'options' => 'areas', 'option_label' => 'name', 'column' => 'area.name'],
            ['key' => 'training_center_id', 'label' => 'Centro de formación', 'type' => 'select', 'required' => true, 'options' => 'training-centers', 'option_label' => 'name', 'column' => 'trainingCenter.name'],
            ['key' => 'teachers', 'label' => 'Instructores', 'type' => 'select', 'options' => 'teachers', 'option_label' => 'name', 'multiple' => true, 'column' => 'teachers'],
            ['key' => 'imagen', 'label' => 'Imagen', 'type' => 'file', 'required' => true, 'image_field' => 'imagen_url'],
        ];
    }
}
