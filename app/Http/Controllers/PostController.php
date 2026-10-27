<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }

    public function index()
    {
        $url = env('URL_SERVER_API');

        $posts = $this->fetchDataFromApi($url . '/posts');

        return view('publication.index', compact('posts'));
    }
}
