<?php

namespace App\Services;

use App\Models\VehicleCategory;
use Illuminate\Support\Collection;

/**
 * Scans public/images/fleet/<category-slug>/ to build the folder-driven
 * fleet listing. Each subfolder (or, if none, each loose image) becomes
 * one "vehicle card" entry — no Eloquent Vehicle records involved.
 */
class FleetPhotoScanner
{
    public static function entries(): Collection
    {
        $entries = collect();

        foreach (VehicleCategory::active()->ordered()->get(['id', 'name', 'slug']) as $cat) {
            $catPath = public_path("images/fleet/{$cat->slug}");
            if (! is_dir($catPath)) {
                continue;
            }

            $subfolders = collect(glob("{$catPath}/*/", GLOB_ONLYDIR))->sort()->values();

            if ($subfolders->isNotEmpty()) {
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
                        'item'          => $group,
                        'photo_count'   => $images->count(),
                    ]);
                }
            } else {
                $images = collect(glob("{$catPath}/*.{jpg,jpeg,JPG,JPEG,png,webp,avif}", GLOB_BRACE))->sort()->values();
                foreach ($images as $image) {
                    $entries->push([
                        'category_slug' => $cat->slug,
                        'category_name' => $cat->name,
                        'cover'         => asset("images/fleet/{$cat->slug}/" . basename($image)),
                        'item'          => pathinfo($image, PATHINFO_FILENAME),
                        'photo_count'   => 1,
                    ]);
                }
            }
        }

        return $entries;
    }
}
