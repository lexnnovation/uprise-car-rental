<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use League\Flysystem\PathTraversalDetected;

class MediaController extends Controller
{
    /**
     * Serve files from the "public" storage disk directly through PHP.
     *
     * Some hosts (e.g. certain shared hosting configs) disable following
     * the public/storage symlink at the webserver level, which causes
     * 403s even when file permissions are correct. This bypasses that
     * entirely while still setting long-lived cache headers, since Spatie
     * conversion filenames are unique per upload and safe to cache hard.
     */
    public function show(string $path)
    {
        try {
            abort_unless(Storage::disk('public')->exists($path), 404);

            return Storage::disk('public')->response($path, null, [
                'Cache-Control' => 'public, max-age=31536000, immutable',
            ]);
        } catch (PathTraversalDetected $e) {
            abort(404);
        }
    }
}
