<?php

namespace App\Http\Controllers;

class ComputerController extends ApiResourceController
{
    protected function endpoint(): string
    {
        return 'computers';
    }

    protected function resource(): string
    {
        return 'computers';
    }

    protected function title(): string
    {
        return 'Computadores';
    }

    protected function fields(): array
    {
        return [
            ['key' => 'number', 'label' => 'Número', 'type' => 'text', 'required' => true],
            ['key' => 'brand', 'label' => 'Marca', 'type' => 'text', 'required' => true],
        ];
    }
}
