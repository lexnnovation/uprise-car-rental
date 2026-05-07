<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\Vehicle;

class HomeController extends Controller
{
    public function __invoke()
    {
        $vehicles = Vehicle::published()
            ->available()
            ->featured()
            ->with('category')
            ->ordered()
            ->limit(6)
            ->get();

        $services = Service::active()->ordered()->get();

        $testimonials = Testimonial::featured()->active()->ordered()->limit(4)->get();

        $faqs = Faq::active()->inCategory('General')->ordered()->limit(6)->get();

        $heroBg = Setting::get(
            'home_hero_bg_url',
            'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1920&auto=format&fit=crop&q=80',
        );

        return view('pages.home', compact('vehicles', 'services', 'testimonials', 'faqs', 'heroBg'));
    }
}
