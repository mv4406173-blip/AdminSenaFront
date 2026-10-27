<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FrontendApiProxyTest extends TestCase
{
    public function test_area_pages_and_actions_proxy_to_the_backend_api(): void
    {
        $baseUrl = rtrim(config('services.admin_api_url'), '/');

        Http::fake([
            $baseUrl.'/areas' => Http::sequence()
                ->push([['id' => 1, 'name' => 'Área de prueba']])
                ->push(['data' => ['id' => 2, 'name' => 'Nueva área']], 201)
                ->push(['data' => ['id' => 1, 'name' => 'Área actualizada']])
                ->push(['message' => 'Registro eliminado correctamente.']),
            $baseUrl.'/areas/1' => Http::response(['id' => 1, 'name' => 'Área de prueba']),
        ]);

        $this->get('/areas')
            ->assertOk()
            ->assertSee('Área de prueba');
        $this->get('/areas/1')
            ->assertOk()
            ->assertSee('Área de prueba');
        $this->get('/areas/1/edit')
            ->assertOk()
            ->assertSee('Área de prueba');
        $this->post('/areas', ['name' => 'Nueva área'])
            ->assertRedirect(route('areas.index'));
        $this->put('/areas/1', ['name' => 'Área actualizada'])
            ->assertRedirect(route('areas.index'));
        $this->delete('/areas/1')
            ->assertRedirect(route('areas.index'));

        Http::assertSent(fn ($request) => $request->method() === 'POST'
            && $request->url() === $baseUrl.'/areas'
            && $request['name'] === 'Nueva área');
        Http::assertSent(fn ($request) => $request->method() === 'PUT'
            && $request->url() === $baseUrl.'/areas/1'
            && $request['name'] === 'Área actualizada');
        Http::assertSent(fn ($request) => $request->method() === 'DELETE'
            && $request->url() === $baseUrl.'/areas/1');
    }

    public function test_course_form_loads_related_options_from_the_backend(): void
    {
        Http::fake([
            rtrim(config('services.admin_api_url'), '/').'/*' => Http::response([]),
        ]);

        $this->get('/courses/create')
            ->assertOk()
            ->assertSee('Número del curso')
            ->assertSee('Instructores');
    }
}
