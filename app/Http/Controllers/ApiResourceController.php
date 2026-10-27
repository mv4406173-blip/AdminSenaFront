<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class ApiResourceController extends Controller
{
    abstract protected function endpoint(): string;

    abstract protected function resource(): string;

    abstract protected function title(): string;

    abstract protected function fields(): array;

    public function index()
    {
        return view('crud.index', [
            'items' => $this->api('GET', $this->endpoint()),
            'fields' => $this->fields(),
            'resource' => $this->resource(),
            'title' => $this->title(),
        ]);
    }

    public function create()
    {
        return $this->form('create');
    }

    public function store(Request $request)
    {
        $data = $this->formData($request);
        $this->api('POST', $this->endpoint(), $data, $request->file('imagen'));

        return redirect()->route($this->resource().'.index')->with('status', 'Registro creado correctamente.');
    }

    public function show(string $id)
    {
        return view('crud.show', [
            'item' => $this->api('GET', $this->endpoint().'/'.$id),
            'fields' => $this->fields(),
            'resource' => $this->resource(),
            'title' => $this->title(),
        ]);
    }

    public function edit(string $id)
    {
        return $this->form('edit', $this->api('GET', $this->endpoint().'/'.$id));
    }

    public function update(Request $request, string $id)
    {
        $data = $this->formData($request);
        $method = $request->hasFile('imagen') ? 'POST' : 'PUT';
        if ($method === 'POST') {
            $data['_method'] = 'PUT';
        }

        $this->api($method, $this->endpoint().'/'.$id, $data, $request->file('imagen'));

        return redirect()->route($this->resource().'.index')->with('status', 'Registro actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $this->api('DELETE', $this->endpoint().'/'.$id);

        return redirect()->route($this->resource().'.index')->with('status', 'Registro eliminado correctamente.');
    }

    private function form(string $mode, array $item = [])
    {
        return view('crud.form', [
            'item' => $item,
            'fields' => $this->fields(),
            'options' => $this->options(),
            'resource' => $this->resource(),
            'title' => $this->title(),
            'mode' => $mode,
        ]);
    }

    private function options(): array
    {
        $options = [];

        foreach ($this->fields() as $field) {
            if (isset($field['options'])) {
                $options[$field['key']] = $this->api('GET', $field['options']);
            }
        }

        return $options;
    }

    private function formData(Request $request): array
    {
        $data = $request->except(['_token', '_method', 'imagen']);

        foreach ($this->fields() as $field) {
            if (($field['multiple'] ?? false) && ! $request->has($field['key'])) {
                $data[$field['key']] = [];
            }
        }

        return $data;
    }

    private function api(string $method, string $path, array $data = [], ?UploadedFile $file = null): array
    {
        $baseUrl = rtrim((string) config('services.admin_api_url'), '/');
        if ($baseUrl === '') {
            throw new HttpException(500, 'URL_SERVER_API no está configurada en el proyecto frontend.');
        }

        $url = $baseUrl.'/'.ltrim($path, '/');
        $request = Http::acceptJson()->timeout(20);

        if ($file !== null) {
            $request = $request->attach('imagen', file_get_contents($file->getRealPath()), $file->getClientOriginalName());
        }

        $response = match ($method) {
            'GET' => $request->get($url),
            'POST' => $request->post($url, $data),
            'PUT' => $request->put($url, $data),
            'DELETE' => $request->delete($url),
            default => throw new \LogicException('Método de API no soportado.'),
        };

        if ($response->status() === 422) {
            throw ValidationException::withMessages($response->json('errors', [
                'api' => $response->json('message', 'Los datos enviados no son válidos.'),
            ]));
        }

        if (! $response->successful()) {
            throw new HttpException(
                $response->status(),
                $response->json('message', 'No fue posible completar la solicitud al backend.')
            );
        }

        return $response->json() ?? [];
    }
}
