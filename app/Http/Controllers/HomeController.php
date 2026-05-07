<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Service;
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

        return view('pages.home', compact('vehicles', 'services', 'testimonials', 'faqs'));
    }
}
