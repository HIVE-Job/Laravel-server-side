<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function show(Filesystem $filesystem, Request $request, $path)
    {
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory($request),
            'source' => $filesystem->getDriver(),
            'source_path_prefix' => 'images/slideimages',
            'cache' => storage_path('glide_cache'),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
        ]);

        return $server->getImageResponse($path, $request->all());
    }

    public function getImages()
    {
        $images = Storage::files('public/images/slideimages');
        return view('frontend.index', compact('images'));
    }
}

