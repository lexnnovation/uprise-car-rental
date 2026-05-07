<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function index(Request $request)
    {
        $categories = VehicleCategory::active()
            ->ordered()
            ->withCount(['vehicles' => fn ($q) => $q->published()->available()])
            ->having('vehicles_count', '>', 0)
            ->get();

        $query = Vehicle::published()
            ->available()
            ->with('category')
            ->ordered();

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        $vehicles = $query->get();

        $activeCategory = $request->get('category');

        return view('pages.fleet.index', compact('vehicles', 'categories', 'activeCategory'));
    }

    public function show(Vehicle $vehicle)
    {
        abort_unless(
            $vehicle->published_at && $vehicle->published_at->lte(now()),
            404,
        );

        $vehicle->load(['category', 'features']);

        $related = Vehicle::published()
            ->available()
            ->where('vehicle_category_id', $vehicle->vehicle_category_id)
            ->where('id', '!=', $vehicle->id)
            ->with('category')
            ->ordered()
            ->limit(3)
            ->get();

        $whatsappUrl =
            'https://wa.me/' .
            config('uprise.whatsapp.number') .
            '?text=' .
            urlencode('Hi Uprise Travel, I\'d like to enquire about the ' . $vehicle->name . '.');

        return view('pages.fleet.show', compact('vehicle', 'related', 'whatsappUrl'));
    }
}
