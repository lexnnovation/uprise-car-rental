<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use App\Models\Vehicle;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function __invoke()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/fleet')->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/services')->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/blog')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/about')->setPriority(0.6)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/faq')->setPriority(0.5)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/contact')->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));

        Vehicle::published()->available()->ordered()->each(function ($vehicle) use ($sitemap) {
            $sitemap->add(
                Url::create(route('fleet.show', $vehicle))
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setLastModificationDate($vehicle->updated_at)
            );
        });

        // Priority location pages we actively push for search/AI discovery.
        $priorityServiceSlugs = ['accra-car-rentals', 'tamale-car-rentals', 'mole-national-park'];

        Service::active()->ordered()->each(function ($service) use ($sitemap, $priorityServiceSlugs) {
            $sitemap->add(
                Url::create(route('services.show', $service))
                    ->setPriority(in_array($service->slug, $priorityServiceSlugs, true) ? 0.9 : 0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setLastModificationDate($service->updated_at)
            );
        });

        Post::published()->ordered()->each(function ($post) use ($sitemap) {
            $sitemap->add(
                Url::create(route('blog.show', $post))
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setLastModificationDate($post->updated_at)
            );
        });

        return response($sitemap->render(), 200)
            ->header('Content-Type', 'application/xml');
    }
}
