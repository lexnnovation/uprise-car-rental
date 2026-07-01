<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->get();

        return view('pages.services.index', compact('services'));
    }

    public function show(Service $service)
    {
        abort_unless($service->is_active, 404);

        $related = Service::active()
            ->where('id', '!=', $service->id)
            ->ordered()
            ->limit(3)
            ->get();

        $whatsappUrl =
            'https://wa.me/' .
            config('uprise.whatsapp.number') .
            '?text=' .
            urlencode('Hi Uprise Travel, I\'d like to enquire about your ' . $service->name . ' service.');

        $photos = collect(glob(public_path('images/lifestyle/*.{jpg,jpeg,png,webp}'), GLOB_BRACE))
            ->map(fn ($path) => asset('images/lifestyle/' . basename($path)))
            ->values()
            ->take(4);

        return view('pages.services.show', compact('service', 'related', 'whatsappUrl', 'photos'));
    }
}
