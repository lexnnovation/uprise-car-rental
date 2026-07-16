<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Services\FleetPhotoScanner;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function index(Request $request)
    {
        $activeCategory = $request->get('category');
        $entries = FleetPhotoScanner::entries();

        $categories = VehicleCategory::active()->ordered()->get(['id', 'name', 'slug'])->filter(
            fn($cat) => $entries->where('category_slug', $cat->slug)->isNotEmpty()
        );

        if ($activeCategory) {
            $entries = $entries->filter(fn($e) => $e['category_slug'] === $activeCategory)->values();
        }

        return view('pages.fleet.index', compact('entries', 'categories', 'activeCategory'));
    }

    public function showGroup(string $category, string $item)
    {
        $categoryModel = VehicleCategory::active()->where('slug', $category)->firstOrFail();

        $catPath = public_path("images/fleet/{$category}");
        abort_unless(is_dir($catPath), 404);

        $subfolderPath = "{$catPath}/{$item}";

        if (is_dir($subfolderPath)) {
            $images = collect(glob("{$subfolderPath}/*.{jpg,jpeg,JPG,JPEG,png,webp,avif}", GLOB_BRACE))
                ->sort()
                ->values()
                ->map(fn ($path) => asset("images/fleet/{$category}/{$item}/" . rawurlencode(basename($path))));
        } else {
            $matches = collect(glob("{$catPath}/{$item}.*"))->sort()->values();
            abort_if($matches->isEmpty(), 404);
            $images = $matches->map(fn ($path) => asset("images/fleet/{$category}/" . rawurlencode(basename($path))));
        }

        abort_if($images->isEmpty(), 404);

        $whatsappUrl =
            'https://wa.me/' .
            config('uprise.whatsapp.number') .
            '?text=' .
            urlencode('Hi Uprise Travel, I\'d like to enquire about the ' . $categoryModel->name . '.');

        return view('pages.fleet.group', [
            'category' => $categoryModel,
            'item' => $item,
            'images' => $images,
            'whatsappUrl' => $whatsappUrl,
        ]);
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
