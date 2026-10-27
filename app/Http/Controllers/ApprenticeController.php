<?php

namespace App\Http\Controllers;

class ApprenticeController extends ApiResourceController
{
    protected function endpoint(): string
    {
        return 'apprentices';
    }

    protected function resource(): string
    {
        return 'apprentices';
    }

    protected function title(): string
    {
        return 'Aprendices';
    }

    protected function fields(): array
    {
        return [
            ['key' => 'name', 'label' => 'Nombre', 'type' => 'text', 'required' => true],
            ['key' => 'email', 'label' => 'Correo electrónico', 'type' => 'email', 'required' => true],
            ['key' => 'phone', 'label' => 'Teléfono', 'type' => 'text', 'required' => true],
            ['key' => 'course_id', 'label' => 'Curso', 'type' => 'select', 'required' => true, 'options' => 'courses', 'option_label' => 'course_number', 'column' => 'course.course_number'],
            ['key' => 'computer_id', 'label' => 'Computador', 'type' => 'select', 'required' => true, 'options' => 'computers', 'option_label' => 'number', 'column' => 'computer.number'],
        ];
    }
}
