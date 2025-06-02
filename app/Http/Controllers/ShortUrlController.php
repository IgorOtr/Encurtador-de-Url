<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $shortCode = Str::random(6);
        while (ShortUrl::where('short_code', $shortCode)->exists()) {
            $shortCode = Str::random(6);
        }

        $shortUrl = ShortUrl::create([
            'original_url' => $request->url,
            'short_code' => $shortCode,
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->back()->with('shortened', url($shortCode));
    }

    public function redirect($code)
    {
        $shortUrl = ShortUrl::where('short_code', $code)->firstOrFail();

        if ($shortUrl->expires_at && now()->greaterThan($shortUrl->expires_at)) {
            return response('Este link expirou.', 410); // HTTP 410 Gone
        }

        return redirect($shortUrl->original_url);
    }
}
