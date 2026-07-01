<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function index(Request $request)
    {
        $allCategories = VehicleCategory::active()->ordered()->get(['id', 'name', 'slug']);
        $activeCategory = $request->get('category');

        $entries = collect();

        foreach ($allCategories as $cat) {
            $catPath = public_path("images/fleet/{$cat->slug}");
            if (! is_dir($catPath)) {
                continue;
            }

            $subfolders = collect(glob("{$catPath}/*/", GLOB_ONLYDIR))->sort()->values();

            if ($subfolders->isNotEmpty()) {
                // Each subfolder = one vehicle card (e.g. SUV groups)
                foreach ($subfolders as $subfolder) {
                    $images = collect(glob("{$subfolder}*.{jpg,jpeg,JPG,JPEG,png,webp,avif}", GLOB_BRACE))->sort()->values();
                    if ($images->isEmpty()) {
                        continue;
                    }
                    $group = basename(rtrim($subfolder, '/'));
                    $entries->push([
                        'category_slug' => $cat->slug,
                        'category_name' => $cat->name,
                        'cover'         => asset("images/fleet/{$cat->slug}/{$group}/" . basename($images->first())),
                    ]);
                }
            } else {
                // Each image = one vehicle card
                $images = collect(glob("{$catPath}/*.{jpg,jpeg,JPG,JPEG,png,webp,avif}", GLOB_BRACE))->sort()->values();
                foreach ($images as $image) {
                    $entries->push([
                        'category_slug' => $cat->slug,
                        'category_name' => $cat->name,
                        'cover'         => asset("images/fleet/{$cat->slug}/" . basename($image)),
                    ]);
                }
            }
        }

        $categories = $allCategories->filter(
            fn($cat) => $entries->where('category_slug', $cat->slug)->isNotEmpty()
        );

        if ($activeCategory) {
            $entries = $entries->filter(fn($e) => $e['category_slug'] === $activeCategory)->values();
        }

        return view('pages.fleet.index', compact('entries', 'categories', 'activeCategory'));
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
