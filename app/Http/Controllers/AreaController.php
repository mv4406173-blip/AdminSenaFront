<?php

namespace App\Http\Controllers;

class AreaController extends ApiResourceController
{
    protected function endpoint(): string
    {
        return 'areas';
    }

    protected function resource(): string
    {
        return 'areas';
    }

    protected function title(): string
    {
        return 'Áreas';
    }

    protected function fields(): array
    {
        return [
            ['key' => 'name', 'label' => 'Nombre', 'type' => 'text', 'required' => true],
        ];
    }
}
